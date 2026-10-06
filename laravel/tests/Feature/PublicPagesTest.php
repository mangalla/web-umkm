<?php

namespace Tests\Feature;

use App\Models\Card;
use App\Models\Faq;
use App\Models\Text;
use Database\Seeders\ContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(ContentSeeder::class);
    }

    public function test_web1_menampilkan_teks_dan_kartu_dari_database(): void
    {
        Text::saveMany('web1', ['hero.line1' => 'Judul Dari Admin']);

        $this->get('/centrin')
            ->assertOk()
            ->assertSee('Judul Dari Admin')
            ->assertSee('Paket Starter')
            ->assertSee('Koneksi+ 200 · Bundling')
            ->assertSee('https://wa.me/6287778333933?text=', false);
    }

    public function test_kartu_tersembunyi_tidak_tampil(): void
    {
        Card::where('title', 'Paket Starter')->update(['is_visible' => false]);

        $this->get('/centrin')->assertOk()->assertDontSee('Paket Starter');
    }

    public function test_teks_kartu_di_escape(): void
    {
        Card::where('title', 'M3 Basic')->update(['title' => '<script>alert(1)</script>']);

        $this->get('/m3')
            ->assertOk()
            ->assertDontSee('<script>alert(1)</script>', false)
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false);
    }

    public function test_web2_menampilkan_paket_rumah_bisnis_dan_faq(): void
    {
        Faq::where('question', 'Apakah ada biaya instalasi?')->update(['is_visible' => false]);

        $this->get('/m3')
            ->assertOk()
            ->assertSee('M3 Family')
            ->assertSee('M3 Biz Max')
            ->assertSee('Berapa lama proses pemasangan?')
            ->assertDontSee('Apakah ada biaya instalasi?');
    }

    public function test_beranda_memakai_harga_termurah_dari_database(): void
    {
        $response = $this->get('/')->assertOk();

        // Centrin: paket termurah Rp209.000, 50–200 Mbps; M3: Rp150.000, 20–150 Mbps.
        $data = $response->viewData('providers');
        $this->assertSame(['url' => route('web1'), 'price' => 209000, 'speedMin' => 50, 'speedMax' => 200], $data['centrin']);
        $this->assertSame(['url' => route('web2'), 'price' => 150000, 'speedMin' => 20, 'speedMax' => 150], $data['m3']);
        $response->assertSee('window.SITE_DATA = {"centrin"', false);
    }

    public function test_alamat_lama_dialihkan(): void
    {
        $this->get('/Web1/index.html')->assertRedirect('/centrin');
        $this->get('/Web2/index.html')->assertRedirect('/m3');
    }
}
