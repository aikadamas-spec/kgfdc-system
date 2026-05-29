<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\BeemWebhookController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('mwanzo');
});

// Route ya kupokea taarifa za malipo kutoka Beem (Automation)
Route::post('/beem/callback', [App\Http\Controllers\BeemWebhookController::class, 'handleCallback'])->name('beem.callback');


Route::get('/apply', [ApplicationController::class, 'showApplyPage'])->name('apply.start');
Route::post('/apply/pay', [ApplicationController::class, 'processPayment'])->name('apply.pay');

// Dashboard ya Mwanafunzi yenye Logic ya Ada
Route::get('/dashboard', [App\Http\Controllers\StudentDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// Coordinator Dashboard
Route::middleware(['auth', 'role:coordinator,admin'])->group(function () {
    Route::get('/coordinator', [CoordinatorController::class, 'index'])->name('coordinator.index');
    Route::post('/coordinator/approve/{application}', [CoordinatorController::class, 'approve'])->name('coordinator.approve');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/complete-registration', [StudentProfileController::class, 'create'])->name('profile.create');
    Route::post('/complete-registration', [StudentProfileController::class, 'store'])->name('profile.store');
    Route::post('/pay-fee', [StudentDashboardController::class, 'processFeePayment'])->name('fee.pay');
});

Route::middleware(['auth', 'role:coordinator'])->group(function () {
    Route::get('/coordinator/dashboard', [CoordinatorController::class, 'dashboard'])->name('coordinator.dashboard');
    Route::post('/coordinator/approve/{id}', [CoordinatorController::class, 'approve'])->name('coordinator.approve');
});
require __DIR__.'/auth.php';

// =============================================
// KURASA ZA TOVUTI (Site Pages)
// =============================================
Route::get('/historia', fn() => view('site.historia'))->name('site.historia');
Route::get('/dira-na-dhima', fn() => view('site.dira-na-dhima'))->name('site.dira-na-dhima');
Route::get('/lengo-madhumuni-na-wajibu', fn() => view('site.lengo-madhumuni-&-wajibu'))->name('site.lengo');
Route::get('/utawala', fn() => view('site.utawala'))->name('site.utawala');
Route::get('/wafanyakazi', fn() => view('site.wafanyakazi'))->name('site.wafanyakazi');
Route::get('/wahitimu', fn() => view('site.wahitimu'))->name('site.wahitimu');

// Kozi
Route::get('/kozi-za-muda-mrefu', fn() => view('site.kozi za muda mrefu'))->name('site.kozi-mrefu');
Route::get('/kozi-za-muda-mfupi', fn() => view('site.kozi-za-muda mfupi'))->name('site.kozi-mfupi');
Route::get('/ufundi-wa-magari', fn() => view('site.ufundi wa magari'))->name('site.ufundi-magari');
Route::get('/ushonaji', fn() => view('site.ushonaji'))->name('site.ushonaji');
Route::get('/ufundi-uashi', fn() => view('site.ufundi uashi'))->name('site.uashi');
Route::get('/ufundi-umeme-majumbani', fn() => view('site.ufundi umeme wa majumbani'))->name('site.umeme-majumbani');
Route::get('/ufundi-umeme-magari', fn() => view('site.ufundi umeme wa magari'))->name('site.umeme-magari');
Route::get('/uchomeleaji-na-uungaji-vyuma', fn() => view('site.uchomeleaji na uungaji vyuma'))->name('site.uchomeleaji');
Route::get('/ufundi-bomba', fn() => view('site.ufundi bomba'))->name('site.ufundi-bomba');
Route::get('/tehama', fn() => view('site.technolojia ya habari na mawasiliano'))->name('site.tehama');

// Maisha Chuoni
Route::get('/malazi', fn() => view('site.malazi'))->name('site.malazi');
Route::get('/michezo-na-burudani', fn() => view('site.michezo na burudani'))->name('site.michezo');
Route::get('/uongozi-wa-wanafunzi', fn() => view('site.uongozi wa wanafunzi'))->name('site.uongozi');
Route::get('/sheria-ndogo-za-wanafunzi', fn() => view('site.sheria ndogo za wanafunzi'))->name('site.sheria');
Route::get('/ratiba-ya-chuo', fn() => view('site.ratiba ya chuo'))->name('site.ratiba');

// Kujiunga
Route::get('/sifa-za-muombaji', fn() => view('site.sifa za muombaji'))->name('site.sifa');
Route::get('/mahitaji-ya-kujiunga', fn() => view('site.mahitaji ya kujiunga'))->name('site.mahitaji');
Route::get('/hatua-za-kujiunga', fn() => view('site.hatua-za-kujiunga'))->name('site.hatua');

// Habari
Route::get('/habari-picha', fn() => view('site.habari-picha'))->name('site.habari');

// Wasiliana
Route::get('/wasiliana-nasi', fn() => view('site.wasiliana nasi'))->name('site.wasiliana');

// Sera na Masharti
Route::get('/sera-ya-faragha', fn() => view('site.sera-ya-faragha'))->name('site.faragha');
Route::get('/sera-ya-vidakuzi', fn() => view('site.sera-ya-vidakuzi'))->name('site.vidakuzi');
Route::get('/masharti-ya-matumizi', fn() => view('site.masharti-ya-matumizi'))->name('site.masharti');

Route::get('/coordinator/students', [CoordinatorController::class, 'students'])
    ->middleware(['auth', 'role:coordinator'])
    ->name('coordinator.students');
