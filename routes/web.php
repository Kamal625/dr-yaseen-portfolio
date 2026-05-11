<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use App\Models\Publication;
use App\Models\Profile;

/*
|--------------------------------------------------------------------------
| Public Routes (Har koi dekh sakta hai)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // Database se data uthana zaroori hai taake error na aaye
    $publications = Publication::orderBy('created_at', 'desc')->get();
    $profile = Profile::first(); 
    
    return view('welcome', compact('publications', 'profile'));
})->name('home');

Route::get('/read/{id}', [PublicationController::class, 'show'])->name('article.read');
Route::get('/archive', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::post('/contact/send', [PublicationController::class, 'sendContact'])->name('contact.send');


/*
|--------------------------------------------------------------------------
| Admin Protected Routes (Sirf Login ke baad)
|--------------------------------------------------------------------------
*/
// Is line ko Admin routes se pehle ya baad mein kahin bhi add kar den
Route::get('/dashboard', function () {
    return redirect()->route('admin.index');
})->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Admin Dashboard
    Route::get('/admin', [PublicationController::class, 'index'])->name('admin.index');
    
    // Actions
    Route::post('/admin/store', [PublicationController::class, 'store'])->name('admin.store');
    Route::delete('/admin/publication/{id}', [PublicationController::class, 'destroy'])->name('admin.publication.destroy');
    Route::post('/admin/gallery/store', [GalleryController::class, 'store'])->name('admin.gallery.store');
    Route::delete('/admin/gallery/{id}', [GalleryController::class, 'destroy'])->name('admin.gallery.destroy');
    Route::post('/admin/profile/update', [PublicationController::class, 'updateProfile'])->name('admin.profile.update');

    // Breeze default profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';