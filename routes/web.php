<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompleteProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

Route::get("/",[ProjectController::class,'home'])->name('guest.home');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['prefix'=>'admin'],function(){
    Route::group(['middleware'=> 'admin.guest'],function(){
        Route::get('login',[AdminController::class,'login'])->name('admin.login');
        Route::post('login',[AdminController::class,'processLogin'])->name('admin.processLogin');
    });
    Route::group(['middleware'=> 'admin.auth'],function(){
        Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
        Route::get('logout', [AdminController::class,'logout'])->name('admin.logout');
        Route::get('changepass/{id}',[AdminController::class,'changePass'])->name('admin.changePass');
        Route::put('changepass/{id}',[AdminController::class,'updatePass'])->name('admin.updatePass');
        Route::get('allProjects/{id}', [AdminController::class,'allProjects'])->name('admin.allProjects');
        Route::delete('deleteProjects/{id}', [AdminController::class,'deleteProject'])->name('admin.deleteProject');
        Route::get('seeComment/{id}', [AdminController::class,'seeComment'])->name('admin.seeComment');
        Route::delete('deleteComment/{id}', [AdminController::class,'deleteComment'])->name('admin.deleteComment');
        Route::get('totalUsers', [AdminController::class,'totalUsers'])->name('admin.totalUsers');
        Route::delete('deleteUser/{id}', [AdminController::class,'deleteUser'])->name('admin.deleteUser');
    });
});
Route::group(['prefix'=>'user'],function(){
Route::group(['middleware'=> 'guest'],function(){
    Route::get('login',[UserController::class,'login'])->name('user.login');
    Route::post('login',[UserController::class,'processLogin'])->name('user.processLogin');
    Route::get('reggister',[UserController::class,'register'])->name('user.register');
    Route::post('register',[UserController::class,'processRegister'])->name('user.processRegister');
});
Route::group(['middleware'=> 'auth'],function(){
    Route::get("home",[ProjectController::class,'home'])->name('user.home');
    Route::get('dashboard', [UserController::class,'index'])->name('user.dashboard');
    Route::get('logout', [UserController::class,'logout'])->name('user.logout');
    Route::get('allProjects/{id}', [ProjectController::class,'allProjects'])->name('user.allProjects');
    Route::get('viewProjects/{id}', [ProjectController::class,'viewprojects'])->name('user.viewprojects');
    Route::delete('deleteProjects/{id}', [ProjectController::class,'deleteProject'])->name('user.deleteProject');
    Route::get('completeProfile/{id}', [CompleteProfileController::class,'completeProfile'])->name('user.completeProfile');
    Route::post('completeProfile/{id}', [CompleteProfileController::class,'ProcesscompleteProfile'])->name('user.processCompleteProfile');
    Route::get('editProfile/{id}', [CompleteProfileController::class,'editProfile'])->name('user.editProfile');
    Route::put('editProfile/{id}', [CompleteProfileController::class,'processEditProfile'])->name('user.processEditProfile');
    Route::get('changeProfile/{id}', [UserController::class,'changeDP'])->name('user.changeDP');
    Route::put('changeProfile/{id}', [UserController::class,'processChangeDP'])->name('user.processChangeDP');
    Route::get('changePass/{id}', [CompleteProfileController::class,'changePass'])->name('user.changePass');
    Route::put('changePass/{id}', [CompleteProfileController::class,'processChangePass'])->name('user.processChangePass');
    Route::get('uploadProjects/{id}', [ProjectController::class,'uploadproject'])->name('user.uploadproject');
    Route::post('uploadProjects/{id}', [ProjectController::class,'processUploading'])->name('user.processUploading');
    Route::post('postComment/{id}', [CommentController::class,'postComment'])->name('user.postComment');
    Route::get('editProject/{id}', [ProjectController::class,'editProject'])->name('user.editProject');
    Route::put('editProject/{id}', [ProjectController::class,'processEdit'])->name('user.processEdit');
    Route::get('seeComment/{id}', [CommentController::class,'seeComment'])->name('user.seeComment');
    Route::get('otherProfile/{id}', [CompleteProfileController::class,'otherProfile'])->name('user.otherProfile');
    Route::delete('deleteComment/{id}', [CommentController::class,'deleteComment'])->name('user.deleteComment');
});
});

require __DIR__.'/auth.php';
