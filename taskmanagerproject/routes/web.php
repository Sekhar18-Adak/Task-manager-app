<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Http\Controllers\MailController;
use App\Http\Controllers\emailmanager;


Route::get('/', fn() => view('default'));

Route::get('/tasks', fn() => view('task.index'));
Route::get('/test-mail', function () {
    Mail::to('your_email@example.com')->send(new TestMail('Test Subject', 'Test Message'));
    return 'Mail sent';
});