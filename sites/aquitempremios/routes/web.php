<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
	return redirect('/sorts');
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    if ($exitCode) {
    	echo 'Cache cleared!';
    } else {
    	echo 'Fail.';
    }
});

Route::get('/sorteio/{postCodes}', 'InstagramController@getAllComments')->name('read.comments');
// Route::get('/sorteio/agencia-conexao/{postCodes}', 'InstagramController@getAllCommentsConexao');
// Route::get('/sorteio/agencia-evolucao/{postCodes}', 'InstagramController@getAllCommentsEvolucao');
// Route::get('/sorteio/meiri/{postCodes}', 'InstagramController@getAllCommentsMeiri');
// Route::get('/sorteio/hytalo/{postCodes}', 'InstagramController@getAllCommentsHytalo');
// Route::get('/sortear/{postCodes}', 'InstagramController@getWinner');
Route::post('/update/{postId}', 'InstagramController@updateComments')->name('update.comments');
// Route::get('/secret', 'InstagramController@secret');
// Route::get('/resultado/{postCodes}', 'InstagramController@result')->name('result.comments');

Route::get('/sorts', 'SortController@index')->name('sorts.index');
Route::get('/sorts/create', 'SortController@create')->name('sorts.create');
Route::post('/sorts/store', 'SortController@store')->name('sorts.store');
Route::get('/sorts/edit/{id}', 'SortController@edit')->name('sorts.edit');
Route::post('/sorts/edit/{id}', 'SortController@edit');
Route::delete('/sorts/destroy/{id}', 'SortController@destroy')->name('sorts.destroy');
