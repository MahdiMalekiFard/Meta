<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CoreController;

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => ['locale', 'remove.search.term']], function () {
    
    Route::get('/',function (){
//        return view('mail.send-verification-code-mail',[
//        'code' => 'test',
//        'username' => 'test',
//        'password' => 'test',
//        'website_url' => 'http://aaa.com'
//        ]);
        return view('home');
    })->name('home.index');
    
    Route::post('upload-image-dropzone', [CoreController::class, 'dropzone'])->name('upload-image-dropzone');
    Route::post('upload-image-tinymce', [CoreController::class, 'tinyMCEImageUpload'])->name('upload-image-tinymce');
    Route::post('add-comment', [CoreController::class, 'addComment'])->name('add-comment');
    
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', [AuthController::class, 'loginView'])->name('login-view');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        
        Route::get('register', [AuthController::class, 'registerView'])->name('register-view');
        Route::post('register', [AuthController::class, 'register'])->name('register');
        
        Route::get('forgot-password', [AuthController::class, 'forgotPasswordView'])->name('forgot-password-view');
        Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
        
        Route::get('verify-code/{user_id}', [AuthController::class, 'verifyCodeView'])->name('verify-code-view');
        Route::post('verify-code', [AuthController::class, 'verifyCode'])->name('verify-code');
        
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
    
});
    

    

