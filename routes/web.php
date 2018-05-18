<?php

Route::get('/', function () {
    return view('home');
});

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/support', function () {
    return view('support');
});

Route::get('/thanks', function () {
    return view('thanks');
});

Route::get('/auth', 'AuthController@callback');

Route::post('/xkcd', 'ComicController@search');
