<?php

use App\Http\Controllers\Zoho\ZohoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[ZohoController::class, 'index'])->name('home');
Route::post('/add_deal',[ZohoController::class, 'deal_data'])->name('add_deal');
