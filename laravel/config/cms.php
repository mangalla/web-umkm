<?php

/*
|--------------------------------------------------------------------------
| Skema konten situs
|--------------------------------------------------------------------------
| Satu-satunya tempat yang menentukan teks apa saja yang bisa diedit admin,
| koleksi kartu apa saja yang ada, dan kolom form kartu per situs.
|
| Format field teks: [kunci, label, opsi]
|   opsi: type  => 'text' (default) | 'long'
|         wide  => true  (lebar penuh di form)
|         hint  => teks bantuan
|         rule  => 'phone' (hanya angka 8–15 digit)
*/

$features = fn (string $prefix, string $name) => collect([1, 2, 3, 4])->flatMap(fn ($n) => [
    ["{$prefix}{$n}Title", "{$name} {$n} — judul"],
    ["{$prefix}{$n}Desc", "{$name} {$n} — deskripsi", ['type' => 'long']],
])->all();

return [

    'sites' => [

        'web1' => [
            'name' => 'Web 1 · CentrinOnline',
            'route' => 'web1',
            'faq' => false,

            'collections' => [
                'plans' => ['title' => 'Paket Koneksi+', 'icon' => 'i-card', 'desc' => 'Kartu harga di bagian "Paket Koneksi+".'],
                'bundles' => ['title' => 'Promo Bundling', 'icon' => 'i-gift', 'desc' => 'Kartu di carousel "Promo Bundling".'],
            ],

            // Kolom form kartu yang dipakai situs ini (lihat CardRequest).
            'card_fields' => ['title', 'is_popular', 'badge', 'speed', 'unit', 'price', 'price_suffix', 'pill', 'promo', 'features', 'cta_label', 'wa_text', 'is_visible'],
            'card_labels' => ['title' => 'Nama / label atas'],

            'groups' => [
                ['title' => 'Kontak & WhatsApp', 'desc' => 'Dipakai oleh semua tombol WhatsApp & telepon di Web1.', 'fields' => [
                    ['contact.waNumber', 'Nomor WhatsApp', ['hint' => 'Format internasional tanpa + / spasi, mis. 6287778333933', 'rule' => 'phone']],
                    ['contact.phone', 'Nomor telepon', ['hint' => 'Mis. +6287778333933']],
                    ['contact.waMessage', 'Pesan WhatsApp umum', ['type' => 'long', 'wide' => true]],
                ]],
                ['title' => 'Judul tab & SEO', 'fields' => [
                    ['meta.title', 'Judul tab browser', ['wide' => true]],
                    ['meta.description', 'Deskripsi untuk mesin pencari', ['type' => 'long', 'wide' => true]],
                ]],
                ['title' => 'Menu navigasi', 'fields' => [
                    ['nav.home', 'Menu 1'], ['nav.paket', 'Menu 2'], ['nav.bundling', 'Menu 3'], ['nav.kontak', 'Menu 4'],
                ]],
                ['title' => 'Hero (bagian atas)', 'fields' => [
                    ['hero.eyebrow', 'Label kecil', ['wide' => true]],
                    ['hero.line1', 'Judul baris 1'], ['hero.line2', 'Judul baris 2'],
                    ['hero.lede', 'Paragraf pembuka', ['type' => 'long', 'wide' => true]],
                    ['hero.ctaPrimary', 'Tombol WhatsApp'], ['hero.ctaSecondary', 'Tombol lihat paket'],
                    ['hero.mapTag', 'Label peta'],
                ]],
                ['title' => 'Bagian Paket Koneksi+', 'fields' => [
                    ['plans.eyebrow', 'Label kecil'], ['plans.title', 'Judul'],
                    ['plans.sub', 'Subjudul', ['type' => 'long', 'wide' => true]],
                ]],
                ['title' => 'Strip syarat', 'fields' => [
                    ['terms.chip1', 'Chip 1'], ['terms.chip2', 'Chip 2'], ['terms.chip3', 'Chip 3'], ['terms.fineprint', 'Catatan kecil'],
                ]],
                ['title' => 'Bagian Promo Bundling', 'fields' => [
                    ['bundling.eyebrow', 'Label kecil'], ['bundling.title', 'Judul'],
                    ['bundling.sub', 'Subjudul', ['type' => 'long', 'wide' => true]],
                    ['bundling.foot', 'Catatan di bawah carousel', ['type' => 'long', 'wide' => true]],
                ]],
                ['title' => 'Bagian Kontak', 'fields' => [
                    ['contact.eyebrow', 'Label kecil'], ['contact.title', 'Judul'],
                    ['contact.btnWa', 'Tombol WhatsApp'], ['contact.btnPhone', 'Tombol telepon'],
                    ['contact.note', 'Catatan area', ['wide' => true]],
                ]],
                ['title' => 'Footer', 'fields' => [
                    ['footer.copy', 'Teks hak cipta', ['wide' => true]],
                    ['footer.linkText', 'Teks tautan'], ['footer.linkUrl', 'Alamat tautan (URL)'],
                ]],
            ],
        ],

        'web2' => [
            'name' => 'Web 2 · M3 Internet',
            'route' => 'web2',
            'faq' => true,

            'collections' => [
                'rumah' => ['title' => 'Paket Rumah', 'icon' => 'i-home', 'desc' => 'Kartu paket pada tab "Rumah".'],
                'bisnis' => ['title' => 'Paket Bisnis', 'icon' => 'i-building', 'desc' => 'Kartu paket pada tab "Bisnis".'],
            ],

            'card_fields' => ['title', 'is_popular', 'badge', 'speed', 'unit', 'price', 'price_suffix', 'features', 'cta_label', 'is_visible'],
            'card_labels' => ['title' => 'Nama paket'],

            'groups' => [
                ['title' => 'Kontak & WhatsApp', 'desc' => 'Dipakai oleh semua tombol WhatsApp di Web2.', 'fields' => [
                    ['contact.waNumber', 'Nomor WhatsApp', ['hint' => 'Format internasional tanpa + / spasi, mis. 6287844690552', 'rule' => 'phone']],
                    ['contact.waDisplay', 'Nomor yang ditampilkan', ['hint' => 'Mis. 0878-4469-0552']],
                    ['contact.waCtaMessage', 'Pesan tombol "Chat WhatsApp"', ['type' => 'long']],
                    ['contact.waFabMessage', 'Pesan tombol WhatsApp melayang', ['type' => 'long']],
                ]],
                ['title' => 'Judul tab & SEO', 'fields' => [
                    ['meta.title', 'Judul tab browser', ['wide' => true]],
                    ['meta.description', 'Deskripsi untuk mesin pencari', ['type' => 'long', 'wide' => true]],
                ]],
                ['title' => 'Menu navigasi', 'fields' => [
                    ['nav.beranda', 'Menu 1'], ['nav.paket', 'Menu 2'], ['nav.jangkauan', 'Menu 3'],
                    ['nav.bantuan', 'Menu 4'], ['nav.kontak', 'Menu 5'], ['nav.cta', 'Tombol oranye'],
                ]],
                ['title' => 'Hero (bagian atas)', 'fields' => [
                    ['hero.pill', 'Label promo', ['wide' => true]],
                    ['hero.line1', 'Judul baris 1'], ['hero.line2', 'Judul baris 2'],
                    ['hero.sub', 'Paragraf pembuka', ['type' => 'long']], ['hero.subStrong', 'Teks tebal oranye di akhir paragraf'],
                    ['hero.ctaPaket', 'Tombol lihat paket'], ['hero.ctaJangkauan', 'Tombol cek jangkauan'],
                    ['hero.badge1', 'Badge 1'], ['hero.badge2', 'Badge 2'], ['hero.badge3', 'Badge 3'],
                    ['hero.chip1Title', 'Chip 1 — judul'], ['hero.chip1Sub', 'Chip 1 — keterangan'],
                    ['hero.chip2Title', 'Chip 2 — judul'], ['hero.chip2Sub', 'Chip 2 — keterangan'],
                ]],
                ['title' => 'Keunggulan', 'fields' => [
                    ['features.eyebrow', 'Label kecil'], ['features.title', 'Judul'],
                    ['features.sub', 'Subjudul', ['type' => 'long', 'wide' => true]],
                    ...$features('features.f', 'Keunggulan'),
                ]],
                ['title' => 'Bagian Paket', 'fields' => [
                    ['paket.eyebrow', 'Label kecil'], ['paket.title', 'Judul'],
                    ['paket.sub', 'Subjudul', ['type' => 'long', 'wide' => true]],
                    ['paket.toggleRumah', 'Tab 1'], ['paket.toggleBisnis', 'Tab 2'],
                    ['paket.swipeHint', 'Petunjuk geser (mobile)', ['wide' => true]],
                ]],
                ['title' => 'Cek Jangkauan', 'fields' => [
                    ['coverage.eyebrow', 'Label kecil'], ['coverage.title', 'Judul'],
                    ['coverage.sub', 'Subjudul', ['type' => 'long', 'wide' => true]],
                    ['coverage.formTitle', 'Judul form'], ['coverage.formSub', 'Subjudul form'],
                    ['coverage.btn', 'Tombol cek'],
                ]],
                ['title' => 'Cara Berlangganan', 'fields' => [
                    ['steps.eyebrow', 'Label kecil'], ['steps.title', 'Judul'],
                    ['steps.sub', 'Subjudul', ['type' => 'long', 'wide' => true]],
                    ...$features('steps.s', 'Langkah'),
                ]],
                ['title' => 'Bagian FAQ', 'desc' => 'Isi pertanyaan diatur di menu FAQ.', 'fields' => [
                    ['faq.eyebrow', 'Label kecil'], ['faq.title', 'Judul'],
                    ['faq.sub', 'Subjudul', ['type' => 'long']], ['faq.helpTitle', 'Judul kotak bantuan'],
                ]],
                ['title' => 'Ajakan penutup (CTA)', 'fields' => [
                    ['cta.title', 'Judul', ['wide' => true]],
                    ['cta.sub', 'Subjudul', ['type' => 'long', 'wide' => true]],
                    ['cta.btnDaftar', 'Tombol daftar'], ['cta.btnWa', 'Tombol WhatsApp'],
                ]],
                ['title' => 'Footer', 'fields' => [
                    ['footer.about', 'Deskripsi singkat', ['type' => 'long', 'wide' => true]],
                    ['footer.col1Title', 'Kolom 1 — judul'], ['footer.col1L1', 'Kolom 1 — tautan 1'],
                    ['footer.col1L2', 'Kolom 1 — tautan 2'], ['footer.col1L3', 'Kolom 1 — tautan 3'], ['footer.col1L4', 'Kolom 1 — tautan 4'],
                    ['footer.col2Title', 'Kolom 2 — judul'], ['footer.col2L1', 'Kolom 2 — tautan 1'],
                    ['footer.col2L2', 'Kolom 2 — tautan 2'], ['footer.col2L3', 'Kolom 2 — tautan 3'], ['footer.col2L4', 'Kolom 2 — tautan 4'],
                    ['footer.col3Title', 'Kolom 3 — judul'],
                    ['footer.copy', 'Teks hak cipta', ['wide' => true]],
                    ['footer.taglineBefore', 'Tagline sebelum ♥'], ['footer.taglineAfter', 'Tagline sesudah ♥'],
                ]],
            ],
        ],
    ],

    // Label & bantuan default untuk kolom kartu (bisa ditimpa per situs lewat card_labels).
    'card_field_meta' => [
        'title' => ['label' => 'Nama', 'required' => true],
        'is_popular' => ['label' => 'Tandai sebagai paket populer (disorot)', 'type' => 'check'],
        'badge' => ['label' => 'Teks badge populer', 'hint' => 'Mis. "Paling Populer". Tampil hanya bila kartu ditandai populer.'],
        'speed' => ['label' => 'Kecepatan', 'required' => true],
        'unit' => ['label' => 'Satuan kecepatan'],
        'price' => ['label' => 'Harga', 'required' => true, 'hint' => 'Mis. Rp209.000'],
        'price_suffix' => ['label' => 'Keterangan harga', 'hint' => 'Mis. /bulan'],
        'pill' => ['label' => 'Label promo (pill)', 'hint' => 'Mis. "Bayar 3 · Free 1" — kosongkan bila tidak perlu'],
        'promo' => ['label' => 'Catatan promo', 'hint' => 'Teks kecil di bawah harga'],
        'features' => ['label' => 'Daftar keunggulan', 'type' => 'list', 'hint' => 'Satu baris = satu poin'],
        'cta_label' => ['label' => 'Teks tombol'],
        'wa_text' => ['label' => 'Pesan WhatsApp saat tombol diklik', 'type' => 'long'],
        'is_visible' => ['label' => 'Tampilkan kartu ini di halaman', 'type' => 'check'],
    ],
];
