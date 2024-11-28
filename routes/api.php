<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use Dotenv\Exception\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[AuthController::class,'register']);

// Route::get('/ModelNotFoundTest',function (){
//     throw new ModelNotFoundException;
// });

Route::get('/test/model-not-found', function () {
    throw new ModelNotFoundException("The requested model was not found.");
});
Route::get('/test/Http-not-found', function () {
    throw new NotFoundHttpException("Not Found Http Exception");
});
Route::get('/test/method-not-allowed', function () {
    throw new MethodNotAllowedHttpException(["POST , PUT"],'this method is not allowed');
});
Route::get('test/UnAuthenticated', function () {
    throw new AuthenticationException("UnAuthenticated");
});
Route::get('/test/access-denied', function () {
    throw new AccessDeniedHttpException("access denied to this resource");
});
Route::get('/test/validation-failed', function () {
    throw new ValidationException("validation failed");
});
Route::get('/test/server_error',function(){
    throw new Exception();
});

Route::apiResource('user',UserController::class);
