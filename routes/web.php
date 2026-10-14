<?php

use App\Http\Controllers\Admin\ArticleAdminController;
use App\Http\Controllers\Admin\ConsultationAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqAdminController;
use App\Http\Controllers\Admin\PortfolioAdminController;
use App\Http\Controllers\Admin\PricingAdminController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\SettingAdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/paket-harga', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');

// Layanan
Route::get('/layanan', [ServiceController::class, 'index'])->name('services.index');
Route::get('/layanan/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Portofolio
Route::get('/portofolio', [PortfolioController::class, 'index'])->name('portfolios.index');
Route::get('/portofolio/{slug}', [PortfolioController::class, 'show'])->name('portfolios.show');

// Blog / Tips
Route::get('/blog', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/blog/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Form Konsultasi
Route::get('/konsultasi', [ConsultationController::class, 'create'])->name('consultation.create');
Route::post('/konsultasi', [ConsultationController::class, 'store'])->name('consultation.store');
Route::get('/konsultasi/berhasil/{id}', [ConsultationController::class, 'success'])->name('consultation.success');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Admin Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Services
    Route::resource('services', ServiceAdminController::class)->except(['show']);

    // Pricing Plans
    Route::resource('pricing', PricingAdminController::class)->except(['show']);

    // Portfolios
    Route::resource('portfolios', PortfolioAdminController::class)->except(['show']);

    // Articles
    Route::resource('articles', ArticleAdminController::class)->except(['show']);

    // FAQs
    Route::resource('faqs', FaqAdminController::class)->except(['show']);

    // Consultations
    Route::get('/consultations', [ConsultationAdminController::class, 'index'])->name('consultations.index');
    Route::get('/consultations/{id}', [ConsultationAdminController::class, 'show'])->name('consultations.show');
    Route::put('/consultations/{id}', [ConsultationAdminController::class, 'update'])->name('consultations.update');
    Route::delete('/consultations/{id}', [ConsultationAdminController::class, 'destroy'])->name('consultations.destroy');

    // Website Settings
    Route::get('/settings', [SettingAdminController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingAdminController::class, 'update'])->name('settings.update');
});
