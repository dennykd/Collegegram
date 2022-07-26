<?php

use App\Events\NotifEvent;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/notifs', function () {
    NotifEvent::dispatch(Notification::find(11));
})->middleware('auth')->name('notifs');

Route::post('/remove-notif/all', [NotificationController::class, 'removeAll'])->middleware('auth')->name('notif.remove.all');
