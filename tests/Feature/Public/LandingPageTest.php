<?php

test('landing page can be rendered', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Pengadilan Agama Penajam'); // Header check
    $response->assertSee('Hak Cipta'); // Footer check
});

test('landing page shows hero section', function () {
    $this->get('/')
        ->assertSee('Selamat Datang di Pengadilan Agama Penajam')
        ->assertSee('Jadwal Sidang');
});

test('landing page shows sambutan ketua', function () {
    $this->get('/')
        ->assertSee('Sambutan Ketua Pengadilan')
        ->assertSee('Assalamu’alaikum Warahmatullahi Wabarakatuh');
});

test('landing page shows quick links', function () {
    $this->get('/')
        ->assertSee('Akses Cepat Layanan')
        ->assertSee('SIPP')
        ->assertSee('e-Court')
        ->assertSee('Jadwal Sidang')
        ->assertSee('Biaya Perkara');
});

test('landing page shows latest news', function () {
    \App\Models\News::factory()->create([
        'title' => 'Berita Pilihan Hari Ini',
        'is_published' => true,
    ]);

    $this->get('/')
        ->assertSee('Berita Pilihan Hari Ini')
        ->assertSee('Berita Terbaru');
});
