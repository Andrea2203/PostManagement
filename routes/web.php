<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/posts', function () {
    return view('posts');
});
Route::get('/categories', function () {
    return view('categories');
});
