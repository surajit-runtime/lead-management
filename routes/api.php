<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/store/lead',  [APIController::class, 'storeNewLead'])->name('storeNewLead');
Route::post('lead-assign-center',  [APIController::class, 'LeadAssignCallCenter'])->name('leadassigncenter');
Route::post('distributor-details',  [APIController::class, 'GetDistributorDetails']);
Route::get('/cron-daily-report',  [APIController::class, 'fetchDailyReport']);
