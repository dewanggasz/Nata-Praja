<?php

use Illuminate\Support\Facades\Route;
use App\Models\Service;
use App\Models\HomepageSetting;
use App\Models\Article;
use App\Models\Pekerjaan;
use App\Filament\Resources\HomepageSettingResource;
use Filament\Facades\Filament;

Route::get('/', function () {
    $setting = HomepageSetting::first(); // ini ambil data pertama dari tabel
    $articles = \App\Models\Article::orderBy('published_at', 'desc')->get();
    $clientLogos = \App\Models\ClientLogo::latest()->get();
    // $job = \App\Models\Pekerjaan::orderBy('published_at', 'desc')->get();
    return view('index', compact('setting', 'articles', 'clientLogos' ));
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
    $jobs = Pekerjaan::orderBy('created_at', 'desc')->get();
    return view('page.career', compact('jobs'));
})->name('karir'); // ← Ini yang bikin route name 'career'

Route::get('/karir/{slug}', function ($slug) {
    $jobs = pekerjaan::where('slug', $slug)->firstOrFail();
    return view('page.career-information.careerInformation_page', compact('jobs'));
})->name('karir.show');

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
    $clientLogos = \App\Models\ClientLogo::latest()->get();
    return view('page.Services.callcenter', compact('clientLogos' ));
})->name('callcenter');

Route::get('/Data-Entry', function () {
    $clientLogos = \App\Models\ClientLogo::latest()->get();
    return view('page.Services.dataentry', compact('clientLogos' ));
})->name('dataentry');

Route::get('/Desk-Collection', function () {
    $clientLogos = \App\Models\ClientLogo::latest()->get();
    return view('page.Services.deskcollection', compact('clientLogos' ));
})->name('deskcollection');

Route::get('/KYC', function () {
    $clientLogos = \App\Models\ClientLogo::latest()->get();
    return view('page.Services.kyc', compact('clientLogos' ));
})->name('kyc');

Route::get('/Livechat', function () {
    $clientLogos = \App\Models\ClientLogo::latest()->get();
    return view('page.Services.livechat', compact('clientLogos' ));
})->name('livechat');

Route::get('/Telemarketing', function () {
    $clientLogos = \App\Models\ClientLogo::latest()->get();
    return view('page.Services.telemarketing', compact('clientLogos' ));
})->name('telemarketing');

Route::get('/Verification-Validation', function () {
    $clientLogos = \App\Models\ClientLogo::latest()->get();
    return view('page.Services.verification&validation', compact('clientLogos' ));
})->name('verification-validation');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Filament::registerResources([
        HomepageSettingResource::class,
    ]);
});







