# Track Spec: Implementasi Modul Profil & Layanan

## Deskripsi
Membangun modul manajemen informasi profil instansi (Visi Misi, Sejarah, Struktur Organisasi) dan informasi layanan hukum (Prosedur Berperkara, Biaya Panjar Radius). Modul ini akan memisahkan pengelolaan data yang terstruktur di admin dengan penyajian informasi yang variatif di halaman publik.

## Tujuan
1.  Menyediakan informasi identitas lembaga yang lengkap dan profesional.
2.  Mempermudah masyarakat memahami alur berperkara dan estimasi biaya secara transparan.
3.  Memberikan fleksibilitas bagi admin dalam mengelola berbagai format informasi (Teks, Gambar, PDF, Tabel).

## Kriteria Penerimaan
### 1. Profil Instansi (Admin & Publik)
- **Visi Misi & Sejarah:** Pengelolaan menggunakan form khusus (Fixed Form) dengan editor teks kaya (Rich Text).
- **Struktur Organisasi:**
    - **Admin:** CRUD data personel (Nama, Jabatan, Foto, Urutan/Level).
    - **Publik:** Tampilan kartu profil (Grid) yang tersusun secara hierarki profesional.

### 2. Layanan Hukum (Admin & Publik)
- **Prosedur Berperkara:** Mendukung penyajian via Teks (Rich Text) dan Infografis (Gambar).
- **Biaya Panjar (Radius):**
    - **Admin:** Upload file SK (PDF) dan input data tabel biaya per radius/wilayah.
    - **Publik:** Menampilkan PDF Viewer tersemat dan Tabel Biaya yang informatif.

### 3. Teknis & UI
- Seluruh modul admin menggunakan **Flux UI**.
- Halaman publik menggunakan **Flux UI** dengan layout yang konsisten dengan landing page.
- Pengelolaan file media (Foto Personel, Infografis, PDF) menggunakan **Spatie Medialibrary**.

## Detail Teknis
- **Models:** `ProfileContent` (untuk Visi Misi/Sejarah), `Officer` (untuk Struktur), `RadiusFee` (untuk Tabel Biaya).
- **Frontend:** Livewire Class-Based Components.
- **Isolasi Data:** Pengujian tetap menggunakan database test untuk keamanan.

## Diluar Lingkup (Out of Scope)
- Fitur pencarian perkara (SIPP integration) - Hanya info prosedur statis di tahap ini.
- Sistem kepegawaian internal yang kompleks (hanya profil struktural).
