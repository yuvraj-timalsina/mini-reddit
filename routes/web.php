<?php

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CommunityPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostCommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::resources([
        'communities'=> CommunityController::class,
        'communities.posts'=>CommunityPostController::class,
        'posts.comments'=>PostCommentController::class
    ]);
    Route::get('posts/{post_id}/vote/{vote}', [CommunityPostController::class, 'vote'])->name('post.vote');
});
