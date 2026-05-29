<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

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

// =============================================
// LANGUAGE SWITCHER
// =============================================
Route::get('/change-language/{lang}', function (string $lang) {
    if (in_array($lang, ['en', 'sw'])) {
        session(['locale' => $lang]);
    }
    return redirect()->back();
})->name('language.switch');

// =============================================
// PUBLIC WEBSITE — FRONT DOOR
// =============================================

// Homepage
Route::get('/', [FrontendController::class, 'index'])->name('frontend.home');

// ── Application Module ──────────────────────────────────────────────────────
Route::get('/apply',                    [FrontendController::class, 'showApplyForm'])->name('apply.start');
Route::post('/apply/submit',            [FrontendController::class, 'submitApplication'])->name('apply.submit');
Route::get('/apply/checkout/{reference}', [FrontendController::class, 'showCheckout'])->name('apply.checkout');

// Beem payment initiation (AJAX POST from checkout page)
Route::post('/apply/beem/initiate',     [FrontendController::class, 'initiateBeemPayment'])->name('apply.beem.initiate');

// Beem webhook — called by Beem servers on payment confirmation (no CSRF)
Route::post('/apply/beem/webhook',      [FrontendController::class, 'beemWebhook'])->name('apply.beem.webhook')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

// Payment success page
Route::get('/apply/success/{reference}', [FrontendController::class, 'paymentSuccess'])->name('apply.success');

// Course list by type (AJAX)
Route::get('/get-courses/{type}', [FrontendController::class, 'getCoursesByType'])->name('apply.courses');

// Search
Route::get('/search', [FrontendController::class, 'search'])->name('frontend.search');

// Kuhusu Sisi
Route::get('/historia', [FrontendController::class, 'historia'])->name('frontend.historia');
Route::get('/dira-na-dhima', [FrontendController::class, 'diraNaDhima'])->name('frontend.dira');
Route::get('/lengo-madhumuni-na-wajibu', [FrontendController::class, 'lengo'])->name('frontend.lengo');
Route::get('/utawala', [FrontendController::class, 'utawala'])->name('frontend.utawala');
Route::get('/wafanyakazi', [FrontendController::class, 'wafanyakazi'])->name('frontend.wafanyakazi');
Route::get('/wahitimu', [FrontendController::class, 'wahitimu'])->name('frontend.wahitimu');

// Kozi
Route::get('/kozi-za-muda-mrefu', [FrontendController::class, 'koziMudaMrefu'])->name('frontend.kozi-mrefu');
Route::get('/kozi-za-muda-mfupi', [FrontendController::class, 'koziMudaMfupi'])->name('frontend.kozi-mfupi');

// Idara
Route::get('/ufundi-wa-magari', [FrontendController::class, 'ufundiWaMagari'])->name('frontend.ufundi-magari');
Route::get('/ushonaji', [FrontendController::class, 'ushonaji'])->name('frontend.ushonaji');
Route::get('/ufundi-uashi', [FrontendController::class, 'ufundiUashi'])->name('frontend.uashi');
Route::get('/ufundi-umeme-majumbani', [FrontendController::class, 'ufundiUmemeMajumbani'])->name('frontend.umeme-majumbani');
Route::get('/ufundi-umeme-magari', [FrontendController::class, 'ufundiUmemeMagari'])->name('frontend.umeme-magari');
Route::get('/uchomeleaji-na-uungaji-vyuma', [FrontendController::class, 'uchomeleaji'])->name('frontend.uchomeleaji');
Route::get('/ufundi-bomba', [FrontendController::class, 'ufundiBomba'])->name('frontend.ufundi-bomba');
Route::get('/tehama', [FrontendController::class, 'tehama'])->name('frontend.tehama');
Route::get('/huduma-za-mechanic', [FrontendController::class, 'hudumaZaMechanic'])->name('frontend.mechanic');

// Maisha Chuoni
Route::get('/malazi', [FrontendController::class, 'malazi'])->name('frontend.malazi');
Route::get('/michezo-na-burudani', [FrontendController::class, 'michezo'])->name('frontend.michezo');
Route::get('/uongozi-wa-wanafunzi', [FrontendController::class, 'uongoziWaWanafunzi'])->name('frontend.uongozi');
Route::get('/sheria-ndogo-za-wanafunzi', [FrontendController::class, 'sheriaNdogo'])->name('frontend.sheria');
Route::get('/ratiba-ya-chuo', [FrontendController::class, 'ratibaYaChuo'])->name('frontend.ratiba');

// Kujiunga
Route::get('/sifa-za-muombaji', [FrontendController::class, 'sifaZaMuombaji'])->name('frontend.sifa');
Route::get('/mahitaji-ya-kujiunga', [FrontendController::class, 'mahitajiYaKujiunga'])->name('frontend.mahitaji');
Route::get('/hatua-za-kujiunga', [FrontendController::class, 'hatuzaKujiunga'])->name('frontend.hatua');

// Habari
Route::get('/habari-picha', [FrontendController::class, 'habariPicha'])->name('frontend.habari');

// Wasiliana
Route::get('/wasiliana-nasi', [FrontendController::class, 'wasilianaNasi'])->name('frontend.wasiliana');
Route::post('/wasiliana-nasi/tuma', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Sera na Masharti
Route::get('/sera-ya-faragha', [FrontendController::class, 'seraYaFaragha'])->name('frontend.faragha');
Route::get('/sera-ya-vidakuzi', [FrontendController::class, 'seraYaVidakuzi'])->name('frontend.vidakuzi');
Route::get('/masharti-ya-matumizi', [FrontendController::class, 'mashartiyaMatumizi'])->name('frontend.masharti');

// =============================================
// BACK OFFICE — DASHBOARD (auth protected)
// =============================================

Route::group(['middleware'=>'auth'],function()
{
    Route::get('home',function()
    {
        return view('home');
    });
    Route::get('home',function()
    {
        return view('home');
    });
});

Auth::routes();
Route::group(['namespace' => 'App\Http\Controllers\Auth'],function()
{
    // ----------------------------login ------------------------------//
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate');
        Route::get('/logout', 'logout')->name('logout');
        Route::post('change/password', 'changePassword')->name('change/password');
    });

    // ----------------------------- register -------------------------//
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/register','storeUser')->name('register');    
    });
});

Route::group(['namespace' => 'App\Http\Controllers'],function()
{
    // -------------------------- main dashboard ----------------------//
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->middleware('auth')->name('home');
        Route::get('user/profile/page', 'userProfile')->middleware('auth')->name('user/profile/page');
        Route::get('teacher/dashboard', 'teacherDashboardIndex')->middleware('auth')->name('teacher/dashboard');
        Route::get('student/dashboard', 'studentDashboardIndex')->middleware('auth')->name('student/dashboard');

        // ── DEV ONLY: seed test visitor locations for map testing ──────────
        Route::get('/activate-admin-map', 'simulateTraffic')->middleware('auth')->name('activate-admin-map');
    });

    // ----------------------------- user controller ---------------------//
    Route::controller(UserManagementController::class)->group(function () {
        Route::get('list/users', 'index')->middleware('auth')->name('list/users');
        Route::post('change/password', 'changePassword')->name('change/password');
        Route::get('view/user/edit/{id}', 'userView')->middleware('auth');
        Route::post('user/update', 'userUpdate')->name('user/update');
        Route::post('user/delete', 'userDelete')->name('user/delete');
        Route::get('get-users-data', 'getUsersData')->name('get-users-data'); /** get all data users */

    });

    // ------------------------ setting -------------------------------//
    Route::controller(Setting::class)->group(function () {
        Route::get('setting/page', 'index')->middleware('auth')->name('setting/page');
        Route::post('setting/update', 'update')->middleware('auth')->name('setting/update');
    });

    // ------------------------ student -------------------------------//
    Route::controller(StudentController::class)->group(function () {
        Route::get('student/list', 'student')->middleware('auth')->name('student/list'); // list student
        Route::get('student/grid', 'studentGrid')->middleware('auth')->name('student/grid'); // grid student
        Route::get('student/add/page', 'studentAdd')->middleware('auth')->name('student/add/page'); // page student
        Route::post('student/add/save', 'studentSave')->name('student/add/save'); // save record student
        Route::get('student/edit/{id}', 'studentEdit'); // view for edit
        Route::post('student/update', 'studentUpdate')->name('student/update'); // update record student
        Route::post('student/delete', 'studentDelete')->name('student/delete'); // delete record student
        Route::patch('student/status/{id}', 'updateStatus')->middleware('auth')->name('student/status'); // approve or reject
        Route::get('student/profile/{id}', 'studentProfile')->middleware('auth'); // profile student
    });

    // ------------------------ teacher -------------------------------//
    Route::controller(TeacherController::class)->group(function () {
        Route::get('teacher/add/page', 'teacherAdd')->middleware('auth')->name('teacher/add/page'); // page teacher
        Route::get('teacher/list/page', 'teacherList')->middleware('auth')->name('teacher/list/page'); // page teacher
        Route::get('teacher/grid/page', 'teacherGrid')->middleware('auth')->name('teacher/grid/page'); // page grid teacher
        Route::post('teacher/save', 'saveRecord')->middleware('auth')->name('teacher/save'); // save record
        Route::get('teacher/edit/{teacher_id}', 'editRecord'); // view teacher record
        Route::post('teacher/update', 'updateRecordTeacher')->middleware('auth')->name('teacher/update'); // update record
        Route::post('teacher/delete', 'teacherDelete')->name('teacher/delete'); // delete record teacher
    });

    // ----------------------- department -----------------------------//
    Route::controller(DepartmentController::class)->group(function () {
        Route::get('department/list/page', 'departmentList')->middleware('auth')->name('department/list/page'); // department/list/page
        Route::get('department/add/page', 'indexDepartment')->middleware('auth')->name('department/add/page'); // page add department
        Route::get('department/edit/{department_id}', 'editDepartment'); // page add department
        Route::post('department/save', 'saveRecord')->middleware('auth')->name('department/save'); // department/save
        Route::post('department/update', 'updateRecord')->middleware('auth')->name('department/update'); // department/update
        Route::post('department/delete', 'deleteRecord')->middleware('auth')->name('department/delete'); // department/delete
        Route::get('get-data-list', 'getDataList')->name('get-data-list'); // get data list

    });

    // ----------------------- subject -----------------------------//
    Route::controller(SubjectController::class)->group(function () {
        Route::get('subject/list/page', 'subjectList')->middleware('auth')->name('subject/list/page'); // subject/list/page
        Route::get('subject/add/page', 'subjectAdd')->middleware('auth')->name('subject/add/page'); // subject/add/page
        Route::post('subject/save', 'saveRecord')->name('subject/save'); // subject/save
        Route::post('subject/update', 'updateRecord')->name('subject/update'); // subject/update
        Route::post('subject/delete', 'deleteRecord')->name('subject/delete'); // subject/delete
        Route::get('subject/edit/{subject_id}', 'subjectEdit'); // subject/edit/page
    });

    // ----------------------- invoice -----------------------------//
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('invoice/list/page', 'invoiceList')->middleware('auth')->name('invoice/list/page'); // subjeinvoicect/list/page
        Route::get('invoice/paid/page', 'invoicePaid')->middleware('auth')->name('invoice/paid/page'); // invoice/paid/page
        Route::get('invoice/overdue/page', 'invoiceOverdue')->middleware('auth')->name('invoice/overdue/page'); // invoice/overdue/page
        Route::get('invoice/draft/page', 'invoiceDraft')->middleware('auth')->name('invoice/draft/page'); // invoice/draft/page
        Route::get('invoice/recurring/page', 'invoiceRecurring')->middleware('auth')->name('invoice/recurring/page'); // invoice/recurring/page
        Route::get('invoice/cancelled/page', 'invoiceCancelled')->middleware('auth')->name('invoice/cancelled/page'); // invoice/cancelled/page
        Route::get('invoice/grid/page', 'invoiceGrid')->middleware('auth')->name('invoice/grid/page'); // invoice/grid/page
        Route::get('invoice/add/page', 'invoiceAdd')->middleware('auth')->name('invoice/add/page'); // invoice/add/page
        Route::post('invoice/add/save', 'saveRecord')->name('invoice/add/save'); // invoice/add/save
        Route::post('invoice/update/save', 'updateRecord')->name('invoice/update/save'); // invoice/update/save
        Route::post('invoice/delete', 'deleteRecord')->name('invoice/delete'); // invoice/delete
        Route::get('invoice/edit/{invoice_id}', 'invoiceEdit')->middleware('auth')->name('invoice/edit/page'); // invoice/edit/page
        Route::get('invoice/view/{invoice_id}', 'invoiceView')->middleware('auth')->name('invoice/view/page'); // invoice/view/page
        Route::get('invoice/settings/page', 'invoiceSettings')->middleware('auth')->name('invoice/settings/page'); // invoice/settings/page
        Route::get('invoice/settings/tax/page', 'invoiceSettingsTax')->middleware('auth')->name('invoice/settings/tax/page'); // invoice/settings/tax/page
        Route::get('invoice/settings/bank/page', 'invoiceSettingsBank')->middleware('auth')->name('invoice/settings/bank/page'); // invoice/settings/bank/page
    });

    // ----------------------- accounts ----------------------------//
    Route::controller(AccountsController::class)->group(function () {
        Route::get('account/fees/collections/page', 'index')->middleware('auth')->name('account/fees/collections/page');
        Route::get('add/fees/collection/page', 'addFeesCollection')->middleware('auth')->name('add/fees/collection/page');
        Route::post('fees/collection/save', 'saveRecord')->middleware('auth')->name('fees/collection/save');
    });

    // ----------------------- contact messages --------------------//
    Route::controller(\App\Http\Controllers\ContactController::class)->group(function () {
        Route::get('messages/list', 'index')->middleware('auth')->name('messages/list');
        Route::post('messages/delete', 'destroy')->middleware('auth')->name('messages/delete');
    });

    // ----------------------- kamati za chuo ----------------------//
    Route::get('admin/kamati-za-chuo', [\App\Http\Controllers\KamatiController::class, 'index'])
        ->middleware('auth')
        ->name('admin/kamati-za-chuo');
});