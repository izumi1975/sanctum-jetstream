<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

//supermanというabilityを持つtokenを生成するロジック
//Route::middleware([
//    'auth:sanctum',
//    'verified'
//])->group(function() {
//    Route::get('/token/create/{name}', function (Request $request) {
//        $token = $request->user()->createToken(
//            $request->name,
//            ['superman']
//        );
//        return explode('|', $token->plainTextToken, 2)[1];
//    })->name('superman');
//});
Route::middleware([
    'auth:sanctum',
    'verified'
])->get('/token/create/{name}', function (Request $request) {
    $token = $request->user()->createToken(
        $request->name,
        ['superman']
    );
    return explode('|', $token->plainTextToken, 2)[1];
});
