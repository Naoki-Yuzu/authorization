<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('admin-for-gate', [AdminController::class, 'viewAdminPageForGate']);
Route::get('admin-for-policy', [AdminController::class, 'deleteUserForPolicy']);

// ミドルウェア経由パターン
// Route::get('admin-for-policy', [AdminController::class, 'deleteUserForPolicy'])
//     ->middleware('can:deleteAnotherUsers,user');