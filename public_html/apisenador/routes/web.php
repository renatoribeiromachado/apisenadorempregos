<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{
    ServiceController,
    NoticieController,
    LegislationController,
    UserController,
    ConfigController,
    BannerController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Routes Services
 */ 

Route::prefix('admin')
    ->namespace('Admin') 
    ->middleware(['auth'])
    ->group(function(){
        Route::get('services', [ServiceController::class, 'index'])->name('services.index');
        Route::get('services/create', [ServiceController ::class, 'create'])->name('services.create');
        Route::post('services/store', [ServiceController::class, 'store'])->name('services.store');
        Route::get('services/{url}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::put('services/{url}', [ServiceController::class, 'update'])->name('services.update');
        Route::get('services/{url}', [ServiceController::class, 'show'])->name('services.show');
        Route::delete('services/{url}', [ServiceController::class, 'destroy'])->name('services.destroy');
        Route::any('services/search', [ServiceController::class, 'search'])->name('services.search');
        
        Route::get('noticies', [NoticieController::class, 'index'])->name('noticies.index');
        Route::get('noticies/create', [NoticieController ::class, 'create'])->name('noticies.create');
        Route::post('noticies/store', [NoticieController::class, 'store'])->name('noticies.store');
        Route::get('noticies/{url}/edit', [NoticieController::class, 'edit'])->name('noticies.edit');
        Route::put('noticies/{url}', [NoticieController::class, 'update'])->name('noticies.update');
        Route::get('noticies/{url}', [NoticieController::class, 'show'])->name('noticies.show');
        Route::delete('noticies/{url}', [NoticieController::class, 'destroy'])->name('noticies.destroy');
        Route::any('noticies/search', [NoticieController::class, 'search'])->name('noticies.search');
        
        Route::get('legislations', [LegislationController::class, 'index'])->name('legislations.index');
        Route::get('legislations/create', [LegislationController ::class, 'create'])->name('legislations.create');
        Route::post('legislations/store', [LegislationController::class, 'store'])->name('legislations.store');
        Route::get('legislations/{url}/edit', [LegislationController::class, 'edit'])->name('legislations.edit');
        Route::put('legislations/{url}', [LegislationController::class, 'update'])->name('legislations.update');
        Route::get('legislations/{url}', [LegislationController::class, 'show'])->name('legislations.show');
        Route::delete('legislations/{url}', [LegislationController::class, 'destroy'])->name('legislations.destroy');
        Route::any('legislations/search', [LegislationController::class, 'search'])->name('legislations.search');
        
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController ::class, 'create'])->name('users.create');
        Route::post('users/store', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{url}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{url}', [UserController::class, 'update'])->name('users.update');
        Route::get('users/{url}', [UserController::class, 'show'])->name('users.show');
        Route::delete('users/{url}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::any('users/search', [UserController::class, 'search'])->name('users.search');
        
        Route::get('configs', [ConfigController::class, 'index'])->name('configs.index');
        Route::post('configs/store', [ConfigController::class, 'store'])->name('configs.store');
        Route::get('configs/{id}/edit', [ConfigController::class, 'edit'])->name('configs.edit');
        Route::put('configs/{id}', [ConfigController::class, 'update'])->name('configs.update');
        
        Route::get('banners', [BannerController::class, 'index'])->name('banners.index');
        Route::get('banners/create', [BannerController ::class, 'create'])->name('banners.create');
        Route::post('banners/store', [BannerController::class, 'store'])->name('banners.store');
        Route::get('banners/{id}/edit', [BannerController::class, 'edit'])->name('banners.edit');
        Route::put('banners/{id}', [BannerController::class, 'update'])->name('banners.update');
        Route::get('banners/{id}', [BannerController::class, 'show'])->name('banners.show');
        Route::delete('banners/{id}', [BannerController::class, 'destroy'])->name('banners.destroy');
        Route::any('banners/search', [BannerController::class, 'search'])->name('banners.search');
;

 });


Route::get('/', function () {
    return view('welcome');
}); 
require __DIR__.'/auth.php';
