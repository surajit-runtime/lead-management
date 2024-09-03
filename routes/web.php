<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CSVuploadController;
use App\Http\Controllers\LeadAssignController;
use App\Http\Controllers\nurturingLeadController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HotLeadController;
use App\Http\Controllers\MarketauthmoduleController;
use App\Http\Controllers\State_Dis_Distributor_BM_Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [LoginController::class, 'index'])->name('index');

Route::post('/checklogin', [LoginController::class, 'checklogin'])->name('checklogin');
Route::get('/reset_password', [LoginController::class, 'resetPassPage'])->name('reset_pass');
Route::post('/generate-password', [LoginController::class, 'generateOTP'])->name('generateOTP');
Route::post('/captcha-validation', [LoginController::class, 'capthcaFormValidate']);
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);
Route::post('/otp-verify', [LoginController::class, 'otpverify'])->name('otpverify');
Route::post('/login-otp-verify', [LoginController::class, 'loginOtpVerfiy'])->name('loginOtpVerfiy');
Route::post('/password-update', [LoginController::class, 'updatpass'])->name('updatpass');
//---------------------------------------------------------------------------------------------Role = 1,2--------------------------------------------------------
Route::group(['middleware' => ['AdminAuth', 'role.access:1,2,5']], function () {
    Route::get('/dashboard', [HomeController::class, 'dashboardpage'])->name('dashboard');
});

Route::group(['middleware' => ['AdminAuth', 'role.access:1,2,3']], function () {
    Route::get('/all-leads-call-center', [HomeController::class, 'allLeadsCallCenterPage'])->name('allLeadsCallCenterPage');
    Route::get('/new-call', [HomeController::class, 'newCallPage'])->name('newCallPage');
    Route::get('/call_not_received/{id}', [LeadAssignController::class, 'call_not_receivd']);
    Route::post('/new-call/update', [LeadAssignController::class, 'update_NewLead_CallCenter'])->name('updateNewLeadCallcenter');
});
Route::group(['middleware' => ['AdminAuth', 'role.access:1,2']], function () {
    Route::get('/assign-leads-admin', [HomeController::class, 'leadAssignAdminPage'])->name('leadAssignAdminPage');
    Route::POST('/update-zone/', [LeadAssignController::class, 'update']);
    Route::POST('/delet-lead/', [LeadAssignController::class, 'destroy']);
    Route::get('/fetch-districts/', [CSVuploadController::class, 'fetchDistricts']);
});
Route::group(['middleware' => ['AdminAuth', 'role.access:1']], function () {


    Route::get('/call_center/1', [HomeController::class, 'callCenter_1_page'])->name('callCenter_1_page');
    Route::get('/call_center/2', [HomeController::class, 'callCenter_2_page'])->name('callCenter_2_page');
    Route::get('/call_center/3', [HomeController::class, 'callCenter_3_page'])->name('callCenter_3_page');
    Route::get('/call_center/4', [HomeController::class, 'callCenter_4_page'])->name('callCenter_4_page');

    Route::get('/call_center/hot-lead/1', [HomeController::class, 'hotLeadPage_admin_view_1'])->name('callCenter_hotLead_view1');
    Route::get('/call_center/hot-lead/2', [HomeController::class, 'hotLeadPage_admin_view_2'])->name('callCenter_hotLead_view2');
    Route::get('/call_center/hot-lead/3', [HomeController::class, 'hotLeadPage_admin_view_3'])->name('callCenter_hotLead_view3');
    Route::get('/call_center/hot-lead/4', [HomeController::class, 'hotLeadPage_admin_view_4'])->name('callCenter_hotLead_view4');

    Route::get('/assign-leads-manager', [HomeController::class, 'leadAssignManagerPage'])->name('leadAssignManagerPage');
    Route::get('/all-leads-show', [HomeController::class, 'allLeadAdminShowPage'])->name('allLeadAdminShowPage');
    Route::get('/report-bm-Wise', [HomeController::class, 'bmWiseReportpage'])->name('bmWiseReportpage');
    Route::post('/report-bm-Wise', [HomeController::class, 'bmWiseReportFilter'])->name('bmWiseReportFilter');
    Route::post('/all-leads-show', [HomeController::class, 'allLeadAdminShowPageRequest'])->name('allLeadAdminShowPageRequest');

    // Route::get('/manual-leads-upload',  [HomeController::class, 'manualLeadUpPage'])->name('manualLeadUpPage');
    Route::get('/manual-leads-upload', [HomeController::class, 'manualLeadUpPage'])->name('manualLeadUpPage');

    Route::post('importCsv', [CSVuploadController::class, 'importCsv'])->name('importCsv');
    Route::get('/user/details/{id}', [CSVuploadController::class, 'userDetails'])->name('user.details');

    Route::get('/add-lead-manually', [CSVuploadController::class, 'Manually_Adn_Page'])->name('Manually_Adn_Page');

    Route::post('/store/lead/manually', [CSVuploadController::class, 'storeLeadManually'])->name('storeLeadManually');

    Route::get('/add-Manager', [HomeController::class, 'addManagerPage'])->name('addManagerPage');
    Route::get('/create-Manager-Sales', [HomeController::class, 'createMangePage'])->name('createMangePage');
    Route::post('/store', [UsersController::class, 'store'])->name('store');
    Route::get('user/{id}/edit', [UsersController::class, 'edit'])->name('user.edit');
    Route::put('user/{id}/update', [UsersController::class, 'update'])->name('user.update');

    Route::get('user/{id}/delete', [UsersController::class, 'destroy'])->name('user.delete');

    Route::get('/report', [ReportController::class, 'currentReportPage'])->name('reportPage');
    Route::post('/report', [ReportController::class, 'currentReportFilter'])->name('currentReportFilter');

    Route::get('/report-zone-wise', [ReportController::class, 'reportZonePage'])->name('reportZonePage');
    Route::post('/report-zone-wise', [ReportController::class, 'reportZonePageFilter'])->name('reportZonePageFilter');

    // Market Authentication Module
    Route::get('/campaign', [MarketauthmoduleController::class, 'showCampaignPage'])->name('campaignPage');
    Route::get('/drop', [MarketauthmoduleController::class, 'handleDrop'])->name('handleDrop');
    Route::get('/publish', [MarketauthmoduleController::class, 'showPublishPage'])->name('publishPage');
    Route::get('/lead-list', [MarketauthmoduleController::class, 'handleLeadList'])->name('handleLeadList');
    Route::get('/audience', [MarketauthmoduleController::class, 'handleAudience'])->name('handleAudience');
    route::post('/create-campaign', [MarketauthmoduleController::class, 'createCampaign'])->name('createCampaign');
    Route::post('/lead-list', [MarketauthmoduleController::class, 'filteredAllLeadList'])->name('filteredAllLeadList');
});
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//---------------------------------------------------------------------------------------------Role = 5--------------------------------------------------------

Route::group(['middleware' => ['AdminAuth', 'role.access:5']], function () {
    // Your routes that require specific roles


    Route::get('/state-list', [HomeController::class, 'fetchStateList'])->name('fetchStateList');
    Route::get('/create-state', [State_Dis_Distributor_BM_Controller::class, 'createState'])->name('createState');
    Route::get('/district-list', [HomeController::class, 'fetchDistrictList'])->name('fetchDistrictList');
    Route::get('/BM-list', [HomeController::class, 'fetchBmList'])->name('fetchBmList');
    Route::get('/bm_edit/{id}', [State_Dis_Distributor_BM_Controller::class, 'editpage'])->name('editpage');
    Route::put('bm_dist_detail/{id}/update', [State_Dis_Distributor_BM_Controller::class, 'updateBmDist'])->name('user.updateBmDist');
});


//---------------------------------------------------------------------------------------------Role = 3--------------------------------------------------------

Route::group(['middleware' => ['AdminAuth', 'role.access:3']], function () {

    Route::get('/dashboard/Zone', [HomeController::class, 'dashboardpageZoneWise'])->name('Zonedashboard');
    Route::get('/hot-leads', [HomeController::class, 'hotLeadPage'])->name('hotLeadPage');
    Route::get('/nurturing-leads', [HomeController::class, 'nuturingLeadPage'])->name('nuturingLeadPage');
    Route::get('/lead_detail/{id}', [HomeController::class, 'hotLeadDetailsPage']);

    Route::get('/nurturing_lead_detail/{id}', [HomeController::class, 'nurturingLeadDetailPage']);

    Route::get('/notification/{id}', [HomeController::class, 'notificationLead_id'])->name('notificationLead_id');

    Route::get('/resume-call', [HomeController::class, 'resumeCallPage'])->name('resumecallpage');
    Route::get('/hot-Lead-call', [HomeController::class, 'hot_Lead_Call_Page'])->name('hot_Lead_Call_Page');

    Route::get('/dead-leads', [HomeController::class, 'deadLeadPage'])->name('deadLeadPage');
    Route::get('/close-leads', [HomeController::class, 'closeLeadPage'])->name('closeLeadPage');

    //  Route::post('/new-call/update',  [LeadAssignController::class, 'update_NewLead_CallCenter'])->name('updateNewLeadCallcenter');
    Route::post('/resume-call/update', [nurturingLeadController::class, 'updateNurturingLead'])->name('updateNurturingLead');
    Route::post('/hotLead-call/update', [HotLeadController::class, 'updateHotLead'])->name('updateHotLead');
});
