<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    Mail::raw('Test Email from Laravel!', function ($message) {
        $message->to('test@example.com')
                ->subject('Test Email');
    });

    return 'Email sent!';
});
Route::get('/', function () {
    return view('welcome');
});
