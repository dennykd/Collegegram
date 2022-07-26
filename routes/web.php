<?php

use App\Events\NotifEvent;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Models\Notification;
use Illuminate\Http\Request;

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

Route::get('/home', function (Request $request) {
    $posts = Post::where('post_category_id', 1)->latest()->paginate(15);
    if ($request->ajax()) {
        $view = view('partials.fragment-post', ['posts' => $posts])->render();
        return response()->json(['html' => $view]);
    }

    return view('user.home', [
        'title' => 'Home',
        'posts' => $posts,
        // 'notifs' => Notification::where('to_user_id', auth()->user()->id)->where('show', true)->latest()->take(8)->get(),
    ]);
})->middleware('auth')->name('home');

Route::get('/menfess', [PostController::class, 'allFess'])->middleware('auth')->name('menfess');
Route::get('/menfess/{posts}', [PostController::class, 'showFess'])->middleware('auth')->name('menfess.show');

Route::get('/{author:username}/status', [PostController::class, 'all'])->middleware('auth')->name('user.status');
Route::post('/user/update', [PostController::class, 'userUpdate'])->middleware('auth')->name('user.update');
Route::get('/{author:username}/status/{posts}', [PostController::class, 'show'])->middleware('auth')->name('post.show');

// AUTHENTICATION
Route::get('/', [AuthController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'regindex'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// POSTS
Route::post('/create', [PostController::class, 'create'])->middleware('auth');
Route::delete('/delete', [PostController::class, 'destroy'])->middleware('auth'); //not used
Route::post('/like', [PostController::class, 'like'])->middleware('auth'); //ajax
// Route::post('/comment', [PostController::class, 'comment'])->middleware('auth')->name('post.comment'); //notused
Route::post('/unshow-notif', [PostController::class, 'unshow_notif'])->middleware('auth')->name('notif.unshow');
Route::post('/reply', [PostController::class, 'reply'])->middleware('auth')->name('comment.reply');
Route::post('/follow', [PostController::class, 'follow'])->middleware('auth')->name('user.follow'); //ajax
Route::post('/unfollow', [PostController::class, 'unfollow'])->middleware('auth')->name('user.unfollow');

// FOR AJAX DEBUG
// Route::get('/get-like-count', [PostController::class, 'get_like_count'])->middleware('auth')->name('get.like.count');

Route::get('/notifs', function () {
    NotifEvent::dispatch(Notification::find(11));
})->middleware('auth')->name('notifs');

// AJAX HANDLER
Route::post('/remove-notif/all', [NotificationController::class, 'removeAll'])->middleware('auth')->name('notif.remove.all'); //ajax
Route::post('/remove-notif', [NotificationController::class, 'remove'])->middleware('auth')->name('notif.remove'); //ajax
Route::get('/get-update', [PostController::class, 'getUpdate'])->middleware('auth')->name('get.update.post'); //ajax
Route::get('/get-notif', [NotificationController::class, 'getNotif'])->middleware('auth')->name('get.notif'); //ajax
Route::get('/get-comments', [PostController::class, 'show'])->middleware('auth')->name('get.comments'); //ajax
Route::post('/do-comment', [PostController::class, 'comment'])->middleware('auth')->name('do.comment'); //ajax
Route::post('/do-reply', [PostController::class, 'reply'])->middleware('auth')->name('do.reply'); //ajax
// AJAX HANDLER END
