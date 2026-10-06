<?php

namespace Tests\Feature;

use App\Models\Card;
use App\Models\Faq;
use App\Models\Text;
use App\Models\User;
use Database\Seeders\ContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(ContentSeeder::class);
        $this->admin = User::factory()->create(['password' => 'rahasia123']);
    }

    public function test_tamu_diarahkan_ke_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->post('/admin/kartu/1/toggle')->assertRedirect('/admin/login');
    }

    public function test_login_dan_logout(): void
    {
        $this->post('/admin/login', ['email' => $this->admin->email, 'password' => 'salah'])
            ->assertSessionHasErrors('email');

        $this->post('/admin/login', ['email' => $this->admin->email, 'password' => 'rahasia123'])
            ->assertRedirect('/admin');
        $this->assertAuthenticatedAs($this->admin);

        $this->post('/admin/logout')->assertRedirect('/admin/login');
        $this->assertGuest();
    }

    public function test_semua_halaman_admin_terbuka(): void
    {
        $card = Card::first();
        $faq = Faq::first();

        foreach ([
            '/admin', '/admin/akun', '/admin/web1/teks', '/admin/web2/teks',
            '/admin/web1/plans', '/admin/web1/bundles', '/admin/web2/rumah', '/admin/web2/bisnis',
            '/admin/web1/plans/baru', "/admin/kartu/{$card->id}/edit",
            '/admin/web2/faq', '/admin/web2/faq/baru', "/admin/faq/{$faq->id}/edit",
        ] as $url) {
            $this->actingAs($this->admin)->get($url)->assertOk();
        }

        $this->actingAs($this->admin)->get('/admin/web1/tidakada')->assertNotFound();
        $this->actingAs($this->admin)->get('/admin/web1/faq')->assertNotFound(); // Web1 tidak punya FAQ
    }

    public function test_simpan_teks_dan_validasi_nomor_whatsapp(): void
    {
        $this->actingAs($this->admin)
            ->put('/admin/web1/teks', ['texts' => ['hero__line1' => 'Baru!', 'contact__waNumber' => '628123456789']])
            ->assertSessionHasNoErrors();

        $this->assertSame('Baru!', Text::mapFor('web1')['hero.line1']);
        $this->get('/centrin')->assertSee('Baru!'); // cache ikut diperbarui

        $this->actingAs($this->admin)
            ->put('/admin/web1/teks', ['texts' => ['contact__waNumber' => '+62 812-abc']])
            ->assertSessionHasErrors('texts.contact__waNumber');

        // Kunci yang tidak terdaftar di config/cms.php diabaikan.
        $this->actingAs($this->admin)->put('/admin/web1/teks', ['texts' => ['contact__waNumber' => '628123456789', 'hacker__key' => 'x']]);
        $this->assertArrayNotHasKey('hacker.key', Text::mapFor('web1'));
    }

    public function test_crud_kartu(): void
    {
        $data = [
            'title' => 'Paket Kilat', 'speed' => '300', 'unit' => 'Mbps', 'price' => 'Rp500.000',
            'price_suffix' => '/bulan', 'features' => ['Cepat', 'Stabil'], 'is_popular' => '0', 'is_visible' => '1',
        ];

        // Tambah → otomatis di urutan terakhir
        $this->actingAs($this->admin)->post('/admin/web1/plans', $data)->assertRedirect('/admin/web1/plans');
        $card = Card::where('title', 'Paket Kilat')->firstOrFail();
        $this->assertSame(5, $card->sort_order);
        $this->get('/centrin')->assertSee('Paket Kilat');

        // Wajib diisi
        $this->actingAs($this->admin)->post('/admin/web1/plans', ['title' => ''])->assertSessionHasErrors(['title', 'speed', 'price']);

        // Edit: mengosongkan promo benar-benar menghapus nilainya
        $card->update(['promo' => 'Promo lama']);
        $this->actingAs($this->admin)->put("/admin/kartu/{$card->id}", ['promo' => ''] + $data)->assertSessionHasNoErrors();
        $this->assertNull($card->fresh()->promo);

        // Geser ke atas, sembunyikan, duplikat, hapus
        $this->actingAs($this->admin)->post("/admin/kartu/{$card->id}/move/up");
        $this->assertSame(4, $card->fresh()->sort_order);

        $this->actingAs($this->admin)->post("/admin/kartu/{$card->id}/toggle");
        $this->assertFalse($card->fresh()->is_visible);

        $this->actingAs($this->admin)->post("/admin/kartu/{$card->id}/duplikat");
        $this->assertDatabaseHas('cards', ['title' => 'Paket Kilat (salinan)', 'is_visible' => false]);

        $this->actingAs($this->admin)->delete("/admin/kartu/{$card->id}");
        $this->assertModelMissing($card);
    }

    public function test_crud_faq(): void
    {
        $this->actingAs($this->admin)->post('/admin/web2/faq', ['question' => 'Bisa bayar tahunan?', 'answer' => 'Bisa.', 'is_visible' => '1'])
            ->assertRedirect('/admin/web2/faq');
        $this->get('/m3')->assertSee('Bisa bayar tahunan?');

        $faq = Faq::where('question', 'Bisa bayar tahunan?')->firstOrFail();
        $this->actingAs($this->admin)->put("/admin/faq/{$faq->id}", ['question' => 'Bisa bayar tahunan?', 'answer' => 'Bisa.']);
        $this->assertFalse($faq->fresh()->is_visible); // checkbox tidak dicentang = disembunyikan

        $this->actingAs($this->admin)->delete("/admin/faq/{$faq->id}");
        $this->assertModelMissing($faq);
    }

    public function test_ganti_password(): void
    {
        $this->actingAs($this->admin)->put('/admin/akun/password', [
            'current_password' => 'salah', 'password' => 'passwordbaru', 'password_confirmation' => 'passwordbaru',
        ])->assertSessionHasErrors('current_password');

        $this->actingAs($this->admin)->put('/admin/akun/password', [
            'current_password' => 'rahasia123', 'password' => 'passwordbaru', 'password_confirmation' => 'passwordbaru',
        ])->assertSessionHasNoErrors();

        $this->assertTrue(\Hash::check('passwordbaru', $this->admin->fresh()->password));
    }
}
