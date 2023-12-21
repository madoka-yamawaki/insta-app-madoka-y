<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Follow;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware'=>'auth'],function(){
    Route::get('/',[HomeController::class, 'index'])->name('index');
    Route::get('/people',[HomeController::class,'search'])->name('search');

    Route::group(['prefix'=>'post','as'=>'post.'],function(){
        Route::get('/create',[PostController::class,'create'])->name('create');
        Route::post('/store',[PostController::class,'store'])->name('store');
        Route::get('/{id}/show',[PostController::class,'show'])->name('show');
        Route::get('/{id}/edit',[PostController::class,'edit'])->name('edit');
        Route::patch('/{id}/update',[PostController::class,'update'])->name('update');
        Route::delete('/{id}/destroy',[PostController::class,'destroy'])->name('destroy');
    });

    //comments group
    Route::group(['prefix'=>'comment','as'=>'comment.'],function(){
        Route::post('/{post_id}/store',[CommentController::class,'store'])->name('store');
        Route::delete('/{id}/destroy',[CommentController::class,'destroy'])->name('destroy');
    });

    //profile group
    Route::group(['prefix'=>'profile','as'=>'profile.'],function(){
        Route::get('/{id}/show',[ProfileController::class,'show'])->name('show');
        Route::get('/{id}/edit',[ProfileController::class,'edit'])->name('edit');
        Route::patch('/{id}/update',[ProfileController::class,'update'])->name('update');
         //follow
         Route::get('/{id}/followers',[ProfileController::class,'followers'])->name('followers');
         Route::get('/{id}/following',[ProfileController::class,'following'])->name('following');

    });



    //like group
    Route::group(['prefix'=>'like','as'=>'like.'],function(){
        Route::post('/{post_id}/store',[LikeController::class,'store'])->name('store');
        Route::delete('/{post_id}/destroy',[LikeController::class,'destroy'])->name('destroy');
    });

     //follow group
    Route::group(['prefix'=>'follow','as'=>'follow.'],function(){
        Route::post('/{user_id}/store',[FollowController::class,'store'])->name('store');
        Route::delete('/{user_id}/destroy',[FollowController::class,'destroy'])->name('destroy');
    });

    //admin group
    Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>'admin'],function(){

        //users group
        Route::group(['prefix'=>'users','as'=>'users.'],function(){
            Route::get('/',[UsersController::class,'index'])->name('index');
            Route::delete('/users/{id}/deactivate',[UsersController::class,'deactivate'])->name('deactivate');
            Route::patch('/{id}/activate',[UsersController::class,'activate'])->name('activate');
        });

        //posts
        Route::group(['prefix'=>'posts','as'=>'posts.'],function(){
            Route::get('/',[AdminPostController::class,'index'])->name('index');
            Route::delete('/{id}/hide', [AdminPostController::class,'hide'])->name('hide');
            Route::patch('/{id}/unhide', [AdminPostController::class,'unhide'])->name('unhide');
        });

        //categories

                Route::group(['prefix' => 'categories','as' => 'categories.'], function () {
                    Route::get('/', [CategoriesController::class,'index'])->name('index');
                    Route::post('/store', [CategoriesController::class,'store'])->name('store');
                    Route::patch('/{id}/update', [CategoriesController::class,'update'])->name('update');
                    Route::delete('/{id}/destroy', [CategoriesController::class,'destroy'])->name('destroy');
                });
    });


});

