<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('index');
Route::get('/getAnnouncement/{announcement_id}', [App\Http\Controllers\AnnouncementController::class, 'getAnnouncement'])->name('getAnnouncement');
Route::get('/searchAnnouncements', [App\Http\Controllers\AnnouncementController::class, 'searchAnnouncements'])->name('searchAnnouncements');

Route::get('/getAddAnnouncementForm', [App\Http\Controllers\AdminController::class, 'getAddAnnouncementForm'])->name('getAddAnnouncementForm');
Route::get('/getEditAnnouncementForm/{announcement_id}', [App\Http\Controllers\AdminController::class, 'getEditAnnouncementForm'])->name('getEditAnnouncementForm');
Route::get('/getDeleteAnnouncementForm/{announcement_id}', [App\Http\Controllers\AdminController::class, 'getDeleteAnnouncementForm'])->name('getDeleteAnnouncementForm');

Route::post('/addAnnouncement', [App\Http\Controllers\AdminController::class, 'addAnnouncement'])->name('addAnnouncement');
Route::put('/editAnnouncement/{announcement_id}', [App\Http\Controllers\AdminController::class, 'editAnnouncement'])->name('editAnnouncement');
Route::delete('/deleteAnnouncement/{announcement_id}', [App\Http\Controllers\AdminController::class, 'deleteAnnouncement'])->name('deleteAnnouncement');

Route::get('/addAnnouncement', [App\Http\Controllers\AdminController::class, 'redirect'])->name('addAnnouncementRedirect');
Route::get('/editAnnouncement/{announcement_id}', [App\Http\Controllers\AdminController::class, 'redirect'])->name('editAnnouncementRedirect');
Route::get('/deleteAnnouncement/{announcement_id}', [App\Http\Controllers\AdminController::class, 'redirect'])->name('deleteAnnouncementRedirect');

Route::post('/addComment/{announcement_id}', [App\Http\Controllers\CommentController::class, 'addComment'])->name('addComment');
Route::get('/addComment/{announcement_id}', [App\Http\Controllers\AdminController::class, 'redirect'])->name('AddCommentRedirect');
Route::get('/getAnnouncement/{announcement_id}/searchComments', [App\Http\Controllers\CommentController::class, 'searchComments'])->name('searchComments');
