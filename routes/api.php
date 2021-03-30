<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\PostController;

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

Route::post('register', [RegisterController::class, 'register'])->name('login');//Updated ;
Route::post('login', [RegisterController::class, 'login'])->name('register'); ;
     


Route::group(['middleware' => 'auth:api'], function() {
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/paginate', [PostController::class, 'page'])->name('page'); ;
    Route::get('/no-paginate', [PostController::class, 'noPage'])->name('noPage'); ;

    Route::resource('posts', PostController::class); 

});

