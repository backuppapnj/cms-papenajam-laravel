# Track Spec: Implementasi Halaman Publik (Public Facing Pages)

## Deskripsi
Membangun antarmuka depan (frontend) yang dapat diakses oleh masyarakat umum untuk melihat informasi dan konten yang dikelola melalui dashboard admin. Implementasi ini akan menggunakan **Flux UI** untuk memastikan tampilan yang modern, profesional, dan responsif.

## Tujuan
1.  Menyediakan halaman Beranda yang informatif dan representatif sebagai wajah digital PA Penajam.
2.  Menyajikan konten Berita, Pengumuman, dan Kegiatan dalam format yang mudah dicari dan dibaca.
3.  Menyediakan media Galeri visual dan Pusat Unduhan dokumen yang user-friendly bagi masyarakat.

## Kriteria Penerimaan
### 1. Halaman Beranda (Landing Page)
- Memiliki **Hero Section/Slider** untuk visual utama.
- Menampilkan **Sambutan Ketua** Pengadilan.
- Memiliki panel **Akses Cepat (Quick Links)** ke layanan utama (SIPP, e-Court, dll).
- Menampilkan bagian **Konten Terkini** yang terbagi dalam kartu (Berita, Pengumuman, Kegiatan).
- Memiliki widget **Jadwal Sholat** dan fitur **Pencarian Global**.

### 2. Halaman Arsip & Detail Berita
- **Halaman Arsip:** Menggunakan layout **Grid** dengan sistem **Filter Kategori** (Berita/Pengumuman/Kegiatan), **Sidebar** info populer, dan **Pencarian Lokal**.
- **Halaman Detail:** Menampilkan konten lengkap, **Tombol Berbagi** ke medsos, fitur **Cetak Halaman**, dan **Navigasi Konten** (Sebelumnya/Selanjutnya).

### 3. Halaman Galeri
- Menyajikan foto dan video dalam layout grid yang rapi.
- Implementasi **Lightbox/Modal** saat item galeri diklik.
- Memiliki **Filter Tipe** (Foto vs Video).

### 4. Pusat Unduhan (Dokumen)
- Menyajikan daftar dokumen dalam **Tabel Informatif** (Nama, Kategori, Ukuran, Tipe File).
- Memiliki **Tombol Unduh** langsung.
- Memiliki fitur **Pencarian Dokumen** berdasarkan judul atau kategori.

## Detail Teknis
- **UI Framework:** Flux UI (Tailwind CSS).
- **Frontend Engine:** Livewire v3 (Class-Based Components).
- **Media:** Spatie Medialibrary (untuk menampilkan gambar/file).
- **SEO:** Penambahan meta tag dasar di setiap halaman detail.

## Diluar Lingkup (Out of Scope)
- Sistem komentar pengguna.
- Sistem registrasi akun bagi masyarakat umum (hanya akses publik).
