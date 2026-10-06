# KoneksiKu — Laravel

Website perbandingan provider (KoneksiKu), halaman CentrinOnline (Web1), M3 Internet (Web2),
dan panel admin untuk mengatur semua teks serta kartu paket/promo.

## Menjalankan

```bash
composer install
cp .env.example .env        # lalu isi ADMIN_PASSWORD
php artisan key:generate
php artisan migrate --seed  # membuat tabel + mengimpor konten awal
php artisan serve
```

| Halaman | URL |
|---|---|
| Beranda KoneksiKu | http://localhost:8000/ |
| Web 1 · CentrinOnline | http://localhost:8000/centrin |
| Web 2 · M3 Internet | http://localhost:8000/m3 |
| Panel admin | http://localhost:8000/admin |

Login awal: `admin@koneksiku.test` / `admin123` (dari `.env`), segera ganti di menu **Keamanan**.

## Struktur

| Bagian | Lokasi |
|---|---|
| Skema teks & kolom kartu yang bisa diedit | `config/cms.php` |
| Model | `app/Models/{Text,Card,Faq}.php`, urutan manual: `app/Models/Concerns/Sortable.php` |
| Halaman publik | `PageController` → `resources/views/{home,sites/web1,sites/web2}.blade.php` |
| Panel admin | `app/Http/Controllers/Admin/*` → `resources/views/admin/*` |
| Aset statis | `public/web1`, `public/web2`, `public/admin-assets` |
| Konten awal | `database/seeders/data/content.json` (`ContentSeeder`) |

## Menambah teks baru yang bisa diedit

1. Di Blade, tulis `{{ $t('bagian.kunci') }}` di tempat teks itu.
2. Daftarkan `['bagian.kunci', 'Label']` di grup yang sesuai pada `config/cms.php`.
3. Isi nilainya lewat panel admin (menu Teks Halaman).

## Pindah ke MySQL

Ubah `.env`: `DB_CONNECTION=mysql`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, lalu `php artisan migrate --seed`.

## Test

```bash
php artisan test
```
