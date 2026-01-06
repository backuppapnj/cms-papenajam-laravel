# Technology Stack - Sistem Informasi PA Penajam

## Core Framework & Backend
*   **Framework:** Laravel (Versi terbaru Stable)
*   **Language:** PHP (Versi 8.2+)
*   **Database:** MySQL / MariaDB

## Frontend & UI Components
*   **Frontend Engine:** Livewire (v3) - Untuk interaktivitas tanpa reload halaman penuh.
*   **Styling:** Tailwind CSS.
*   **UI Library:** **Flux UI** - Digunakan sebagai komponen UI utama untuk Landing Page dan Dashboard Admin.

## Authentication & Security
*   **Auth Scaffolding:** Laravel Jetstream (menggunakan Fortify) - Menyediakan autentikasi yang aman termasuk fitur manajemen sesi dan profil.
*   **Authorization:** Spatie Laravel-Permission - Untuk manajemen Role (misal: Super Admin, Redaktur Berita) dan Permissions.

## Media & Content Management
*   **Media Handling:** Spatie Laravel-Medialibrary - Untuk pengelolaan upload gambar berita, slider, dan dokumen publik secara terorganisir.
*   **Icons:** Heroicons (terintegrasi dengan Flux UI).

## Deployment & Infrastructure
*   **Environment:** Shared Hosting (cPanel).
*   **Optimization:** Memastikan build asset (Vite) kompatibel dengan struktur direktori shared hosting (misal: penyesuaian folder `public`).
