<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use OpenAI\Laravel\Facades\OpenAI;

// Route::get('/index', function () {
//     $messages = collect(session('messages', []))->reject(fn ($message) => $message['role'] === 'system');

//     return view('welcome', [
//         'messages' => $messages
//     ]);
// });

Route::controller(AiController::class)->group(function () {
    Route::get('/','index')->name('index');
    Route::post('search','search')->name('search');
    Route::get('reset','reset')->name('reset');
});

