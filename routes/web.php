<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\SpotifyAuthController;
// Protect routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        $events = App\Models\Event::all();
        $todos = App\Models\Post::all();
        return view('overview', compact('todos', 'events'));
    });

    Route::get('/todo-list', function(){
        return view('todo-list');
    });

    Route::resource('TodoList', PostController::class);

    Route::get('/study-timer', function(){
        return view('timer');
    });

    Route::get('/scheduling', function(){
        return view('schedlue');
    });
    Route::get('/music', function(){
        return view('music');
    });
});

// Existing routes that don't need authentication
Route::get('locale/{lang}',[LocaleController::class,'setLocale']);
Route::get('/api/events', [EventController::class, 'index']);
Route::post('/api/events', [EventController::class, 'store']);
Route::put('/api/events/{id}', [EventController::class, 'update']);
Route::delete('/api/events/{id}', [EventController::class, 'destroy']);
Route::get('/callback', function () {
    // Handle Spotify API callback
    return "Spotify API callback";
});
Route::get('/spotify/login', [SpotifyAuthController::class, 'redirectToSpotify']);
Route::get('/callback', [SpotifyAuthController::class, 'handleSpotifyCallback']);
// Authentication routes

Auth::routes();