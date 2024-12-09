<?php

//  use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController; // 追記
use App\Http\Controllers\MicropostsController; //追記
use App\Http\Controllers\UserFollowController;  // 追記
use App\Http\Controllers\FavoriteController;  // 追記

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
Route::get('/', [MicropostsController::class, 'index']);
Route::get('/dashboard', [MicropostsController::class, 'index'])->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
    Route::resource('microposts', MicropostsController::class, ['only' => ['store', 'destroy']]);
});

Route::group(['middleware' => ['auth']], function () {
    
    Route::prefix('users/{id}')->group(function () {
        // POSTとDELETEはフォロー／アンフォローをHTTPで操作するルーティング
        Route::post('follow', [UserFollowController::class, 'store'])->name('user.follow');
        Route::delete('unfollow', [UserFollowController::class, 'destroy'])->name('user.unfollow');
        
        // GETの2つはフォローしている人とフォローされている人のUser一覧を表示するルーティング
        Route::get('followings', [UsersController::class, 'followings'])->name('users.followings');
        Route::get('followers', [UsersController::class, 'followers'])->name('users.followers');
        
        // お気に入り用
        Route::get('favorites', [UsersController::class, 'favorites'])->name('users.favorites');
        
        // POSTとDELETEはお気に入り登録／お気に入り解除をHTTPで操作するルーティング
        // Route::post('favorites', [UserFollowController::class, 'store'])->name('user.favorite');
        // Route::post('favorites', [UserFollowController::class, 'destroy'])->name('user.unfavorite');
    });
    
    Route::prefix('microposts/{id}')->group(function () {
        // POSTとDELETEはフォロー／アンフォローをHTTPで操作するルーティング
        Route::post('favorite', [FavoriteController::class, 'store'])->name('favorites.favorite');
        Route::delete('unfavorite', [FavoriteController::class, 'destroy'])->name('favorites.unfavorite');
    });

    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);

    // ...（中略）...
});

require __DIR__.'/auth.php';
