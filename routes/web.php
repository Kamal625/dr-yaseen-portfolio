<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use App\Models\Publication;
use App\Models\Profile;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Har koi dekh sakta hai)
|--------------------------------------------------------------------------
*/

// 1. Home Page: Sirf haliya (recent) 3-4 items dikhane ke liye
Route::get('/', function () {
    $publications = Publication::orderBy('created_at', 'desc')->take(4)->get();
    $profile = Profile::first(); 
    return view('welcome', compact('publications', 'profile'));
})->name('home');

// 2. Publication & Research: Sirf 'scholarly' category wala kaam
Route::get('/publications-research', [PublicationController::class, 'research'])->name('publications.research');

// 3. Public Scholarship: Sirf 'creative' category wala kaam
Route::get('/public-scholarship', [PublicationController::class, 'publicScholarship'])->name('public.scholarship');

// 4. Digital Archive & Gallery: Multimedia aur events
Route::get('/digital-archive', [GalleryController::class, 'index'])->name('gallery.index');

// 5. Single Article: Mukammal article parhne ke liye
Route::get('/read/{id}', [PublicationController::class, 'show'])->name('article.read');

// 6. Contact Page
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::post('/contact/send', [PublicationController::class, 'sendContact'])->name('contact.send');


/*
|--------------------------------------------------------------------------
| ADMIN PROTECTED ROUTES (Sirf Login ke baad)
|--------------------------------------------------------------------------
*/

// Login ke baad dashboard se admin portal par bhej do
Route::get('/dashboard', function () {
    return redirect()->route('admin.index');
})->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Admin Dashboard Main Page
    Route::get('/admin', [PublicationController::class, 'index'])->name('admin.index');
    
    // Articles Actions (Save & Delete)
    Route::post('/admin/store', [PublicationController::class, 'store'])->name('admin.store');
    Route::delete('/admin/publication/{id}', [PublicationController::class, 'destroy'])->name('admin.publication.destroy');
    
    // Gallery Actions (Save & Delete)
    Route::post('/admin/gallery/store', [GalleryController::class, 'store'])->name('admin.gallery.store');
    Route::delete('/admin/gallery/{id}', [GalleryController::class, 'destroy'])->name('admin.gallery.destroy');
    
    // Profile & Social Links Update
    Route::post('/admin/profile/update', [PublicationController::class, 'updateProfile'])->name('admin.profile.update');

    // Breeze default profile settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';