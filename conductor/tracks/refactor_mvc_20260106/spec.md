# Track Spec: Refactor to Class-Based Livewire (MVC)

## Deskripsi
Melakukan migrasi seluruh komponen frontend yang saat ini menggunakan **Livewire Volt (Functional API)** menjadi **Livewire Class-Based Components** standar. Tujuannya adalah memisahkan logika PHP (Controller/Component) dari tampilan (View/Blade) untuk mengikuti prinsip MVC yang lebih ketat dan memudahkan pemahaman bagi pengembang yang terbiasa dengan struktur Laravel klasik.

## Tujuan
1.  Memisahkan logika bisnis dari file view (`resources/views/livewire`) ke folder app (`app/Livewire`).
2.  Mempertahankan fungsionalitas fitur yang ada (Auth, Berita, Galeri, Dokumen).
3.  Memastikan semua tes otomatis tetap lulus setelah refactoring.
4.  Menghapus dependensi pada sintaks Volt di file Blade akhir.

## Ruang Lingkup Refactoring
1.  **Authentication:** Login, Register, Forgot Password, Reset Password, Verify Email, Confirm Password.
2.  **User Settings:** Profile, Password, 2FA, Delete User.
3.  **Admin CMS:**
    -   News (Index, Create, Edit)
    -   Gallery (Index, Create)
    -   Documents (Index, Create)

## Detail Teknis
-   **Namespace Baru:** `App\Livewire\...`
-   **Lokasi View Baru:** Tetap di `resources/views/livewire/...` tetapi tanpa blok PHP `<?php ... ?>` di atasnya.
-   **Routing:** Mengubah `Volt::route(...)` menjadi `Route::get(..., Component::class)`.

## Kriteria Penerimaan
-   Tidak ada lagi file Blade yang berisi logika PHP (`new class extends Component`).
-   Semua Route di `web.php` menggunakan referensi Class, bukan string Volt.
-   `php artisan test` lulus 100%.
