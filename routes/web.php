<?php

use App\Livewire\Admin\Documents\Create as DocumentCreate;
use App\Livewire\Admin\Documents\Index as DocumentIndex;
use App\Livewire\Admin\Gallery\Create as GalleryCreate;
use App\Livewire\Admin\Gallery\Index as GalleryIndex;
use App\Livewire\Admin\News\Create as NewsCreate;
use App\Livewire\Admin\News\Edit as NewsEdit;
use App\Livewire\Admin\News\Index as NewsIndex;
use App\Livewire\Admin\Officers\Create as OfficerCreate;
use App\Livewire\Admin\Officers\Edit as OfficerEdit;
use App\Livewire\Admin\Officers\Index as OfficerIndex;
use App\Livewire\Admin\Procedures\Create as ProcedureCreate;
use App\Livewire\Admin\Procedures\Edit as ProcedureEdit;
use App\Livewire\Admin\Procedures\Index as ProcedureIndex;
use App\Livewire\Admin\Profile\ProfileForm;
use App\Livewire\Admin\RadiusFees\Index as RadiusFeeIndex;
use App\Livewire\Public\Documents\Index as PublicDocumentsIndex;
use App\Livewire\Public\Gallery\Index as PublicGalleryIndex;
use App\Livewire\Public\Home;
use App\Livewire\Public\News\Index as PublicNewsIndex;
use App\Livewire\Public\News\Show as PublicNewsShow;
use App\Livewire\Public\Profile\Sejarah as PublicSejarah;
use App\Livewire\Public\Profile\Structure as PublicStructure;
use App\Livewire\Public\Profile\VisiMisi as PublicVisiMisi;
use App\Livewire\Public\Services\Procedure as PublicProcedure;
use App\Livewire\Public\Services\RadiusFees as PublicRadiusFees;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', Home::class)->name('home');

// Public Routes
Route::name('public.')->group(function () {
    Route::get('/news', PublicNewsIndex::class)->name('news.index');
    Route::get('/news/{slug}', PublicNewsShow::class)->name('news.show');
    Route::get('/gallery', PublicGalleryIndex::class)->name('gallery');
    Route::get('/documents', PublicDocumentsIndex::class)->name('documents');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/visi-misi', PublicVisiMisi::class)->name('visi-misi');
        Route::get('/sejarah', PublicSejarah::class)->name('sejarah');
        Route::get('/struktur-organisasi', PublicStructure::class)->name('structure');
    });

    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/procedures/{slug}', PublicProcedure::class)->name('procedure');
        Route::get('/radius-fees', PublicRadiusFees::class)->name('radius-fees');
    });
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('news', NewsIndex::class)->name('news.index');
        Route::get('news/create', NewsCreate::class)->name('news.create');
        Route::get('news/{news}/edit', NewsEdit::class)->name('news.edit');

        Route::get('profile/visi-misi', ProfileForm::class)->name('profile.visi-misi')->defaults('key', 'visi_misi');
        Route::get('profile/sejarah', ProfileForm::class)->name('profile.sejarah')->defaults('key', 'sejarah');

        Route::get('officers', OfficerIndex::class)->name('officers.index');
        Route::get('officers/create', OfficerCreate::class)->name('officers.create');
        Route::get('officers/{officer}/edit', OfficerEdit::class)->name('officers.edit');

        Route::get('procedures', ProcedureIndex::class)->name('procedures.index');
        Route::get('procedures/create', ProcedureCreate::class)->name('procedures.create');
        Route::get('procedures/{procedure}/edit', ProcedureEdit::class)->name('procedures.edit');

        Route::get('radius-fees', RadiusFeeIndex::class)->name('radius-fees.index');

        Route::get('gallery', GalleryIndex::class)->name('gallery.index');
        Route::get('gallery/create', GalleryCreate::class)->name('gallery.create');

        Route::get('documents', DocumentIndex::class)->name('documents.index');
        Route::get('documents/create', DocumentCreate::class)->name('documents.create');
    });
});
