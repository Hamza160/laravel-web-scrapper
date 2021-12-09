<?php

use App\Http\Controllers\ScraperController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [ScraperController::class, 'index']);
Route::post('/post-property-scraper', [ScraperController::class, 'PropertyScraper'])->name('post-property-scraper');
Route::get('/property-detail-scraper', [ScraperController::class, 'PropertyDetailScrapper']);
Route::post('/update-property-detail-scraper', [ScraperController::class, 'UpdatePropertyDetailScrapper'])->name('update-property-details');
Route::get('/get-latest-property-scraper', [ScraperController::class, 'GetLatestProperty'])->name('get-latest-property-scraper');

Route::get('/scrap-agnets', [ScraperController::class, 'ScrapAgents']);


// Route::get('/scraper', [ScraperController::class, 'companies']);
