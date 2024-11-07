<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::post('/', function (){
    Log::info('POST :::::api/');
});

Route::get('/', function () {

    Log::info('api/');
    // return view('welcome');
    $user = auth()->loginUsingId(1);

    $token = $user->createToken('test');

    dd($token);
});

//トークンを受け取って、ユーザ情報を返却　【get】
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//トークンを受け取って、ユーザ情報を返却　【post】
Route::middleware('auth:sanctum')->post('/user', function (Request $request) {
    Log::info($request->user());
    return $request->user();
});

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
//
//Route::post('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
