# Track Spec: Foundation & Core CMS

## Deskripsi
Membangun infrastruktur dasar aplikasi menggunakan Laravel, Jetstream untuk autentikasi, serta modul CMS utama (Berita, Galeri, Dokumen) menggunakan Livewire dan Flux UI.

## Tujuan
1.  Inisialisasi proyek Laravel dengan stack yang telah ditentukan.
2.  Setup autentikasi admin yang aman.
3.  Implementasi manajemen konten berita (CRUD + Media).
4.  Implementasi manajemen galeri foto/video.
5.  Implementasi manajemen dokumen (upload PDF/Formulir).

## Kriteria Penerimaan
- Proyek Laravel dapat berjalan di environment lokal.
- Admin dapat login/logout dengan aman.
- Admin dapat membuat, membaca, memperbarui, dan menghapus berita dengan gambar.
- Admin dapat mengunggah foto/video ke galeri.
- Admin dapat mengunggah dan mengelola file dokumen (PDF).
- Semua fitur menggunakan komponen Flux UI.
- Cakupan tes minimal 90%.

## Detail Teknis
- **Backend:** Laravel, Livewire v3.
- **Frontend:** Flux UI, Tailwind CSS.
- **Auth:** Laravel Jetstream (Fortify).
- **Media:** Spatie Medialibrary.
- **Roles:** Spatie Permission.
