<?php

// Route::get('/', function () {
//     return view('welcome');
// });

 Route::resource('/', 'PostController');
 Route::resource('/detail', 'DetailController');
 Route::resource('/submit', 'SubmitController');
 Route::resource('/edit', 'EditController');
 Route::resource('/delete', 'DetailController');
 Route::resource('/player', 'PlayerController');
 Route::resource('/comment', 'CommentController');
 
 Route::get('/test', function () {
    return view('posts.chartist');
});
 if (env('APP_ENV') === 'local') {
    URL::forceScheme('https');
 } 