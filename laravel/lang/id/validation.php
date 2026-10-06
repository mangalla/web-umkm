<?php

// Pesan validasi Bahasa Indonesia untuk aturan yang dipakai aplikasi ini.
// Aturan lain otomatis memakai pesan bahasa Inggris (fallback_locale).
return [
    'array' => ':attribute harus berupa daftar.',
    'boolean' => ':attribute harus bernilai ya atau tidak.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'current_password' => 'Password saat ini salah.',
    'email' => ':attribute harus berupa alamat email yang valid.',
    'max' => [
        'array' => ':attribute maksimal berisi :max item.',
        'string' => ':attribute maksimal :max karakter.',
    ],
    'min' => [
        'string' => ':attribute minimal :min karakter.',
    ],
    'regex' => 'Format :attribute tidak valid.',
    'required' => ':attribute wajib diisi.',
    'string' => ':attribute harus berupa teks.',

    'attributes' => [
        'email' => 'email',
        'password' => 'password',
    ],
];
