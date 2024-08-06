<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FileDownloadController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Backend\DashboardController;


Route::get('/clear/{command}', function ($command) {
    $response = Artisan::call($command);
    dd($response);
});



Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('vision', 'vision')->name('visions');
    Route::get('mission', 'mission')->name('missions');
    Route::get('room', 'room')->name('room');
    Route::get('infastructure', 'infastructure')->name('infastructure');
    Route::get('contact-us', 'contact_us')->name('contact-us');
    Route::get('gallery', 'gallery')->name('gallery');
    Route::get('gallery-detail/{slug}', 'galleryDetail')->name('gallery.detail');
    Route::get('tenders', 'tenders')->name('tenders');
    Route::get('placement-service', 'placementservice')->name('placementservice');
    Route::get('abouts', 'about')->name('abouts');
    Route::get('hostel-facility', 'hostel_facility')->name('hostelservice');
    Route::get('board-of-directory', 'boardofdirectory')->name('boardofdirectory');
    Route::get('team-member', 'teamofmember')->name('teamofmember');
    Route::get('traning-programme', 'traningprogramme')->name('traningprogramme');
    Route::get('study-material', 'studymaterial')->name('studymaterial');
    Route::get('reliving-orders', 'relivingorders')->name('relivingorders');
    Route::get('feedback', 'feedback')->name('feedback');
    Route::get('login-register', 'login_register')->name('login-register');
    Route::get('/training/{id}',  'training_show')->name('training.show');
    Route::get('/reliving-show/{id}',  'reliving_show')->name('reliving.show');
    Route::get('/study-show/{id}',  'study_show')->name('studymaterial.show');
    Route::get('/tender/{id}',  'tender_show')->name('tender.show');
    Route::get('/page/{slug}',  'page')->name('page');
    Route::get('/management/{slug}',  'managementDetail')->name('management.detail');
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('login', [LoginController::class, 'adminlogin'])->name('login'); // Display login form

Route::post('/logins', [LoginController::class, 'login'])->name('login.submit'); // Process login form submission

Route::post('/register', [LoginController::class, 'register'])->name('register');

Route::get('/training-events', [EventController::class, 'index'])->name('training.search');

Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');


Route::get('/download/{fileName}', [FileDownloadController::class, 'download'])->name('document.download');
