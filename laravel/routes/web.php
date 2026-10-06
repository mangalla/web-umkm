<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TextController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
| Halaman publik
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/centrin', [PageController::class, 'web1'])->name('web1');
Route::get('/m3', [PageController::class, 'web2'])->name('web2');

// Alamat lama versi statis tetap berfungsi.
Route::redirect('/Web1/index.html', '/centrin', 301);
Route::redirect('/Web2/index.html', '/m3', 301);

/*
| Login admin
*/
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [LoginController::class, 'create'])->name('login');
    Route::post('/admin/login', [LoginController::class, 'store'])->middleware('throttle:5,1');
});

/*
| Panel admin
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/akun', [AccountController::class, 'edit'])->name('account');
    Route::put('/akun/password', [AccountController::class, 'updatePassword'])->name('account.password');

    $sites = implode('|', array_keys(config('cms.sites')));

    // Teks halaman per situs
    Route::get('/{site}/teks', [TextController::class, 'edit'])->name('texts.edit')->where('site', $sites);
    Route::put('/{site}/teks', [TextController::class, 'update'])->name('texts.update')->where('site', $sites);

    // FAQ
    Route::get('/{site}/faq', [FaqController::class, 'index'])->name('faqs.index')->where('site', $sites);
    Route::get('/{site}/faq/baru', [FaqController::class, 'create'])->name('faqs.create')->where('site', $sites);
    Route::post('/{site}/faq', [FaqController::class, 'store'])->name('faqs.store')->where('site', $sites);
    Route::get('/faq/{faq}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
    Route::put('/faq/{faq}', [FaqController::class, 'update'])->name('faqs.update');
    Route::delete('/faq/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');
    Route::post('/faq/{faq}/toggle', [FaqController::class, 'toggle'])->name('faqs.toggle');
    Route::post('/faq/{faq}/move/{direction}', [FaqController::class, 'move'])->name('faqs.move')->whereIn('direction', ['up', 'down']);

    // Kartu: daftar & tambah per koleksi, aksi lain per kartu
    Route::get('/{site}/{collection}', [CardController::class, 'index'])->name('cards.index')->where('site', $sites);
    Route::get('/{site}/{collection}/baru', [CardController::class, 'create'])->name('cards.create')->where('site', $sites);
    Route::post('/{site}/{collection}', [CardController::class, 'store'])->name('cards.store')->where('site', $sites);
    Route::get('/kartu/{card}/edit', [CardController::class, 'edit'])->name('cards.edit');
    Route::put('/kartu/{card}', [CardController::class, 'update'])->name('cards.update');
    Route::delete('/kartu/{card}', [CardController::class, 'destroy'])->name('cards.destroy');
    Route::post('/kartu/{card}/duplikat', [CardController::class, 'duplicate'])->name('cards.duplicate');
    Route::post('/kartu/{card}/toggle', [CardController::class, 'toggle'])->name('cards.toggle');
    Route::post('/kartu/{card}/move/{direction}', [CardController::class, 'move'])->name('cards.move')->whereIn('direction', ['up', 'down']);
});
