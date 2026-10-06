# Panel Admin Web1 & Web2

Panel untuk mengatur **semua teks** dan **kartu promosi** (CRUD) di `Web1` (CentrinOnline) dan `Web2` (M3 Internet).

## Cara menjalankan (lokal)

Klik dua kali `start-server.bat` di folder `D:\website`, atau jalankan:

```
php -S localhost:8000 -t D:\website
```

Lalu buka:

| Halaman | URL |
|---|---|
| Panel admin | http://localhost:8000/admin/ |
| Web 1 | http://localhost:8000/Web1/ |
| Web 2 | http://localhost:8000/Web2/ |

Password awal: **`admin123`**. Ganti lewat menu **Keamanan** sebelum online.

## Apa yang bisa diatur

| Menu | Isi |
|---|---|
| Web1 › Teks Halaman | Menu, hero, judul bagian, strip syarat, kontak, footer, nomor WhatsApp, SEO |
| Web1 › Paket Koneksi+ | Tambah/edit/hapus/duplikat/sembunyikan/urutkan kartu paket |
| Web1 › Promo Bundling | Sama seperti di atas, untuk kartu carousel bundling |
| Web2 › Teks Halaman | Semua teks dari hero sampai footer, nomor WhatsApp, SEO |
| Web2 › Paket Rumah / Bisnis | CRUD kartu paket untuk masing-masing tab |
| Web2 › FAQ | CRUD pertanyaan & jawaban |

## Cara kerja

```
admin/index.html ──(login, simpan)──▶ admin/api.php ──▶ admin/data/content.json
                                                              │
Web1/index.html ◀──── admin/cms.js membaca JSON ──────────────┤
Web2/index.html ◀─────────────────────────────────────────────┘
```

- **Data tersimpan di** `admin/data/content.json`. Tiap simpan, versi lama dicadangkan ke `admin/data/backups/` (15 terakhir).
- Di HTML, elemen bertanda `data-cms="kunci"` diganti oleh `cms.js` dengan teks dari JSON.
- Kalau JSON gagal dimuat (mis. file HTML dibuka langsung tanpa server), teks bawaan HTML tetap tampil.
- Password disimpan sebagai hash di `admin/auth.php` (dibuat otomatis saat ganti password). Hapus file itu untuk kembali ke `admin123`.

## Menambah teks baru yang bisa diedit

1. Beri atribut di HTML: `<p data-cms="hero.tagline">Teks bawaan</p>`
2. Tambahkan kunci `"hero.tagline"` ke `texts` situs terkait di `data/content.json`.
3. Daftarkan di `SITES.<web>.groups` pada `admin.js` agar muncul di form.

## Hosting

Unggah seluruh folder ke hosting yang mendukung PHP 8+. Pastikan folder `admin/data/` dan `admin/` bisa ditulis oleh PHP.
