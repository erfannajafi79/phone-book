<?php

use App\Core\Routing\Route;


Route::get('/','HomeController@index');

Route::post('/contact/add','ContactController@add');

Route::get('/contact/delete/{id}','ContactController@delete');

// use App\Middleware\BlockFirefox;
// use App\Middleware\BlockIE;

// Route::get('/','HomeController@index');

// Route::get('/archive','ArchiveController@index');
// Route::get('/archive/articles','ArchiveController@articles');
// Route::get('/archive/products','ArchiveController@products');

// Route::add([ 'get' , 'post' , 'put' ] , '/a' , function(){
//     echo "welcome";
// });

// Route::get('/null' );

// Route::get('/b' , function(){
//     echo "save ok";
//     view('archive/index');
// });

// Route::put('/c' , ['Controller','Method']);

// Route::put('/d' , 'Controller@Method');

// Route::get('/todo/list','TodoController@list',[BlockFirefox::class , BlockIE::class]);
// Route::get('/todo/add','TodoController@add');




// Route::get('/post/{slug}','PostController@single');
// Route::get('/post/{slug}/comment/{cid}','PostController@comment');
