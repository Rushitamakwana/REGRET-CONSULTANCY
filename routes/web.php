<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\JobApplicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Protected Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('admin/dashboard/stats', [AdminController::class, 'getStats'])->name('dashboard.stats');
    
    Route::get('/admin/profile', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
    Route::put('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::get('/admin/change-password', [AdminController::class, 'changePassword'])->name('admin.change.password');
    Route::put('/admin/change-password', [AdminController::class, 'updatePassword'])->name('admin.password.update');

    // User Management Routes
    Route::patch('/users/{user}/toggle-status', [AdminController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');
    
    // Services Routes
    Route::get('admin/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('admin/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('admin/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('admin/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('admin/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('admin/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

    Route::get('admin/portfolios', [PortfolioController::class, 'index'])->name('portfolios.index');
    Route::get('admin/portfolios/create', [PortfolioController::class, 'create'])->name('portfolios.create');
    Route::post('admin/portfolios', [PortfolioController::class, 'store'])->name('portfolios.store');
    Route::get('admin/portfolios/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('portfolios.edit');
    Route::put('admin/portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('portfolios.update');
    Route::delete('admin/portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');
    
    // Careers Routes
    Route::get('admin/careers', [CareerController::class, 'index'])->name('careers.index');
    Route::get('admin/careers/create', [CareerController::class, 'create'])->name('careers.create');
    Route::post('admin/careers', [CareerController::class, 'store'])->name('careers.store');
    Route::get('admin/careers/{career}/edit', [CareerController::class, 'edit'])->name('careers.edit');
    Route::put('admin/careers/{career}', [CareerController::class, 'update'])->name('careers.update');
    Route::delete('admin/careers/{career}', [CareerController::class, 'destroy'])->name('careers.destroy');
    
    // Job Applications Routes
    Route::get('admin/applications', [JobApplicationController::class, 'index'])->name('applications.index');
    Route::get('admin/applications/{application}', [JobApplicationController::class, 'show'])->name('applications.show');
    Route::post('admin/applications/{application}/mark-read', [JobApplicationController::class, 'markAsRead'])->name('applications.mark-read');
    Route::delete('admin/applications/{application}', [JobApplicationController::class, 'destroy'])->name('applications.destroy');
    
    // Contact Routes
    Route::get('admin/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('admin/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::post('admin/contacts/{contact}/mark-read', [ContactController::class, 'markAsRead'])->name('contacts.mark-read');
    Route::delete('admin/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Notification Routes - UNCOMMENTED
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::patch('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
});

// Frontend Routes - Public
Route::get('/', function () {
    return view('Home');
});

Route::get('/about', function () {
    return view('About');
});

Route::get('/Career', [CareerController::class, 'publicIndex'])->name('careers.public');
Route::post('/careers/apply', [CareerController::class, 'apply'])->name('careers.apply');

Route::get('/services', [ServiceController::class, 'publicIndex'])->name('services.public');
Route::get('/ServicesDetails/{service}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/contact', function () {
    return view('Conatct');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

