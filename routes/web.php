<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google-auth');
 
Route::get('/auth/callback', function () {
    $user = Socialite::driver('google')->user();
    $user= User::updateOrCreate(['email'=>$user->email],[
    'name'=>$user->name,
    'password'=>'password',
]);
 
Auth::login($user);
 
    return redirect('/dashboard');
});



Route::middleware('auth')->group(function () {
    Route::resource('/ticket', TicketController::class);// web.php
    Route::post('/ticket/resolved/{id}', [TicketController::class, 'resolved'])->name('ticket.resolved');
    Route::get('/resolve-ticket', [TicketController::class, 'resolve'])->name('ticket.resolve');
    

    
});



