<?php

use Illuminate\Support\Facades\Route;
use App\Models\Service;
use App\Models\HomepageSetting;
use App\Models\Article;
use App\Filament\Resources\HomepageSettingResource;
use Filament\Facades\Filament;

Route::get('/', function () {
    $setting = HomepageSetting::first(); // ini ambil data pertama dari tabel
    $articles = \App\Models\Article::orderBy('published_at', 'desc')->get();
    return view('index', compact('setting', 'articles'));
});

Route::get('/layanan', function () {
    return view('page.our-service');
})->name('layanan');

Route::get('/aboutUs', function () {
    return view('page.About-us');
})->name('aboutUs');

Route::get('/gallery', function () {
    return view('page.gallery');
})->name('gallery');

Route::get('/karir', function () {
    return view('page.career');
})->name('karir');

Route::get('/contact', function () {
    return view('page.contact-us');
})->name('contact');

Route::get('/faq', function () {
    return view('page.faq');
})->name('faq');

Route::get('/artikel', function () {
    $articles = \App\Models\Article::orderBy('published_at', 'desc')->get();
    return view('page.artikel', compact('articles'));
})->name('artikel');

Route::get('/artikel/{slug}', function ($slug) {
    $article = Article::where('slug', $slug)->firstOrFail();
    return view('page.Blog-post.blog-post', compact('article'));
})->name('artikel.show');

Route::get('/Call-Center', function () {
    return view('page.Services.callcenter');
})->name('callcenter');

Route::get('/Data-Entry', function () {
    return view('page.Services.dataentry');
})->name('dataentry');

Route::get('/Desk-Collection', function () {
    return view('page.Services.deskcollection');
})->name('deskcollection');

Route::get('/KYC', function () {
    return view('page.Services.kyc');
})->name('kyc');

Route::get('/Livechat', function () {
    return view('page.Services.livechat');
})->name('livechat');

Route::get('/Telemarketing', function () {
    return view('page.Services.telemarketing');
})->name('telemarketing');

Route::get('/Verification-Validation', function () {
    return view('page.Services.verification&validation');
})->name('verification-validation');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Filament::registerResources([
        HomepageSettingResource::class,
    ]);
});







