<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\SupportController;

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

Route::get('/', function () {
    return Redirect::to('login');
});

Route::get('/dashboard', [TrackController::class, 'index'])->name('dashboard');

/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('tracks');
})->name('dashboard'); */

/**
 * Tracks
 */
Route::get('/tracks', [TrackController::class, 'index'])->name('tracks');
Route::get('/track/add', [TrackController::class, 'add'])->name('trackAdd')->middleware('web', 'permission:track-add');
Route::get('/track/edit/{id}', [TrackController::class, 'edit'])->name('trackEdit')->middleware('web', 'permission:track-edit');
Route::post('/track/edit/{id}', [TrackController::class, 'edit'])->name('trackEdit')->middleware('web', 'permission:track-edit');

Route::get('/track/publish/{id}', [TrackController::class, 'publish'])->name('trackPublish')->middleware('web', 'permission:track-publish');

Route::get('/comments',  [CommentController::class, 'index'])->name('comments');
Route::get('/supports',  [SupportController::class, 'index'])->name('supports');

/**
 * Channels
 */
Route::get('/channels',  [ChannelController::class, 'index'])->name('channels');
Route::get('/channel/add', [ChannelController::class, 'add'])->name('channelAdd')->middleware('web', 'permission:channel-add');
Route::post('/channel/add', [ChannelController::class, 'add'])->name('channelAdd')->middleware('web', 'permission:channel-add');;
Route::get('/channel/edit/{id}', [ChannelController::class, 'edit'])->name('channelEdit')->middleware('web', 'permission:channel-edit');;
Route::post('/channel/edit/{id}', [ChannelController::class, 'edit'])->name('channelEdit')->middleware('web', 'permission:channel-edit');;
