<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel konten untuk halaman Web1 (CentrinOnline) & Web2 (M3 Internet).
 * Kolom `site` berisi kunci situs dari config/cms.php ("web1" / "web2").
 */
return new class extends Migration
{
    public function up(): void
    {
        // Semua teks halaman dalam bentuk pasangan kunci → nilai, mis. "hero.line1".
        Schema::create('texts', function (Blueprint $table) {
            $table->id();
            $table->string('site', 20);
            $table->string('key', 100);
            $table->text('value')->nullable();
            $table->timestamps();
            $table->unique(['site', 'key']);
        });

        // Kartu paket / promo. `collection` = plans, bundles (Web1) atau rumah, bisnis (Web2).
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('site', 20);
            $table->string('collection', 30);
            $table->string('title');
            $table->string('speed', 20);
            $table->string('unit', 20)->default('Mbps');
            $table->string('price', 50);
            $table->string('price_suffix', 50)->nullable();
            $table->string('pill', 100)->nullable();
            $table->string('promo')->nullable();
            $table->boolean('is_popular')->default(false);
            $table->string('badge', 50)->nullable();
            $table->json('features');
            $table->string('cta_label', 50)->default('Pesan Sekarang');
            $table->text('wa_text')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index(['site', 'collection', 'sort_order']);
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('site', 20);
            $table->string('question');
            $table->text('answer');
            $table->boolean('is_visible')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index(['site', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('cards');
        Schema::dropIfExists('texts');
    }
};
