<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ThankYouController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/{slug}', [ServiceController::class, 'show'])->name('show');
});

Route::prefix('programs')->name('programs.')->group(function () {
    Route::get('/', [ProgramController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProgramController::class, 'show'])->name('show');
});

Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

Route::get('/team', [TeamController::class, 'index'])->name('team');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials');
Route::get('/faqs', [FaqController::class, 'index'])->name('faqs');

Route::get('/donation', [DonationController::class, 'index'])->name('donation.index');
Route::post('/donation', [DonationController::class, 'store'])->name('donation.store');
Route::post('/donation/create-order', [DonationController::class, 'createOrder'])->name('donation.createOrder');
Route::post('/donation/verify', [DonationController::class, 'verify'])->name('donation.verify');
Route::get('/donation/thank-you', [DonationController::class, 'thankYou'])->name('donation.thankYou');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

Route::get('/thank-you', [ThankYouController::class, 'show'])->name('thank-you');
