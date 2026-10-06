<?php
/**
 * API Panel Admin — menyimpan konten Web1 & Web2 ke data/content.json.
 *
 * Endpoint (semua POST memakai body JSON):
 *   GET  api.php?action=me        → status login
 *   POST api.php?action=login     {password}
 *   POST api.php?action=logout
 *   POST api.php?action=save      {content}            (wajib login)
 *   POST api.php?action=password  {current, next}      (wajib login)
 *
 * Halaman publik TIDAK memakai file ini: mereka membaca data/content.json langsung.
 */

declare(strict_types=1);

const DATA_FILE    = __DIR__ . '/data/content.json';
const BACKUP_DIR   = __DIR__ . '/data/backups';
const AUTH_FILE    = __DIR__ . '/auth.php';   // berisi hash password (dibuat otomatis saat ganti password)
const DEFAULT_PASS = 'admin123';
const MAX_BACKUPS  = 15;

session_set_cookie_params(['httponly' => true, 'samesite' => 'Strict']);
session_start();
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

function respond(int $code, array $body): void {
    http_response_code($code);
    echo json_encode($body, JSON_UNESCAPED_UNICODE);
    exit;
}

function body(): array {
    // Hanya terima JSON: form lintas situs tidak bisa mengirim application/json tanpa preflight CORS.
    if (stripos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== 0) {
        respond(415, ['error' => 'Content-Type harus application/json']);
    }
    $data = json_decode(file_get_contents('php://input') ?: '', true);
    return is_array($data) ? $data : [];
}

function passwordHash(): ?string {
    if (!is_file(AUTH_FILE)) return null;
    $cfg = include AUTH_FILE;
    return is_array($cfg) ? ($cfg['hash'] ?? null) : null;
}

function checkPassword(string $input): bool {
    $hash = passwordHash();
    return $hash === null ? hash_equals(DEFAULT_PASS, $input) : password_verify($input, $hash);
}

function requireLogin(): void {
    if (empty($_SESSION['admin'])) respond(401, ['error' => 'Sesi berakhir, silakan login lagi.']);
}

/** Validasi bentuk data supaya file JSON tidak rusak oleh kiriman yang salah. */
function validateContent($c): ?string {
    if (!is_array($c)) return 'Konten tidak valid.';
    $lists = ['web1' => ['plans', 'bundles'], 'web2' => ['plansRumah', 'plansBisnis', 'faq']];
    foreach ($lists as $site => $keys) {
        if (!isset($c[$site]['texts']) || !is_array($c[$site]['texts'])) return "Teks $site hilang.";
        foreach ($c[$site]['texts'] as $k => $v) {
            if (!is_string($v)) return "Teks $site.$k harus berupa string.";
        }
        foreach ($keys as $key) {
            if (!isset($c[$site][$key]) || !array_is_list($c[$site][$key])) return "Daftar $site.$key tidak valid.";
            foreach ($c[$site][$key] as $item) {
                if (!is_array($item) || empty($item['id'])) return "Item di $site.$key tidak memiliki id.";
            }
        }
    }
    return null;
}

function writeAtomic(string $file, string $data): bool {
    $tmp = $file . '.tmp';
    return file_put_contents($tmp, $data, LOCK_EX) !== false && rename($tmp, $file);
}

function backupCurrent(): void {
    if (!is_file(DATA_FILE)) return;
    if (!is_dir(BACKUP_DIR)) mkdir(BACKUP_DIR, 0755, true);
    copy(DATA_FILE, BACKUP_DIR . '/content-' . date('Ymd-His') . '.json');
    $files = glob(BACKUP_DIR . '/content-*.json') ?: [];
    sort($files);
    foreach (array_slice($files, 0, max(0, count($files) - MAX_BACKUPS)) as $old) unlink($old);
}

$action = $_GET['action'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

if ($action === 'me' && $method === 'GET') {
    respond(200, ['loggedIn' => !empty($_SESSION['admin']), 'defaultPassword' => passwordHash() === null]);
}

if ($method !== 'POST') respond(405, ['error' => 'Metode tidak didukung.']);

switch ($action) {
    case 'login':
        $in = body();
        // Jeda kecil memperlambat tebak-tebakan password.
        usleep(300000);
        if (!checkPassword((string)($in['password'] ?? ''))) respond(401, ['error' => 'Password salah.']);
        session_regenerate_id(true);
        $_SESSION['admin'] = true;
        respond(200, ['ok' => true, 'defaultPassword' => passwordHash() === null]);

    case 'logout':
        $_SESSION = [];
        session_destroy();
        respond(200, ['ok' => true]);

    case 'save':
        requireLogin();
        $content = body()['content'] ?? null;
        if ($err = validateContent($content)) respond(422, ['error' => $err]);
        $content['updatedAt'] = date('c');
        backupCurrent();
        $json = json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if (!writeAtomic(DATA_FILE, $json)) respond(500, ['error' => 'Gagal menulis file data. Periksa izin folder admin/data.']);
        respond(200, ['ok' => true, 'updatedAt' => $content['updatedAt']]);

    case 'password':
        requireLogin();
        $in = body();
        $next = (string)($in['next'] ?? '');
        if (!checkPassword((string)($in['current'] ?? ''))) respond(401, ['error' => 'Password lama salah.']);
        if (strlen($next) < 8) respond(422, ['error' => 'Password baru minimal 8 karakter.']);
        $php = "<?php\n// Dibuat otomatis oleh panel admin. Hapus file ini untuk kembali ke password default.\nreturn " .
            var_export(['hash' => password_hash($next, PASSWORD_DEFAULT)], true) . ";\n";
        if (!writeAtomic(AUTH_FILE, $php)) respond(500, ['error' => 'Gagal menyimpan password.']);
        respond(200, ['ok' => true]);

    default:
        respond(404, ['error' => 'Aksi tidak dikenal.']);
}
