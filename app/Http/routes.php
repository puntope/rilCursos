<?php


Route::get('/categorias/{slug}','CategoriasController@getCategoria')->where('slug', '[\s\S]+');
Route::get('/cursos/{slug}','CursosController@getCurso')->where('slug', '[\s\S]+');
Route::get('/inscribirse/{slug}','AlumnosCursosController@getInscribirse')->where('slug', '[\s\S]+');
Route::get('/pagar/{slug}','AlumnosCursosController@getPagar')->where('slug', '[\s\S]+');

Route::resource('cursos', 'CursosController');
Route::resource('alumnoscursos', 'AlumnosCursosController');
Route::resource('profesores', 'ProfesoresController');


Route::get('/imagencurso/{filename}', [
   'uses' => 'CursosController@getImagenCurso',
    'as' => 'curso.imagen'
]);
Route::get('/imagencategoria/{filename}', [
    'uses' => 'CategoriasController@getImagenCategoria',
    'as' => 'categoria.imagen'
]);

Route::controller('datatables', 'DatatableCursosController', [
    'anyData' => 'datatables.data',
    'getIndex' => 'datatables',
]);
Route::controller('datatablesCategorias', 'DatatableCategoriasController', [
    'anyData' => 'datatablesCategorias.data',
    'getIndex' => 'datatablesCategorias',
]);
Route::controller('datatablesAlumnos', 'DatatableAlumnosController', [
    'anyData' => 'datatablesAlumnos.data',
    'getIndex' => 'datatablesAlumnos',
]);
Route::controller('datatablesProfesores', 'DatatableProfesoresController', [
    'anyData' => 'datatablesProfesores.data',
    'getIndex' => 'datatablesProfesores',
]);

Route::any('/cursos', 'CursosController@index');
Route::any('/home', 'CursosController@index');
Route::any('/', 'CursosController@index');

Route::group(['middleware' => 'admin'], function () {
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/admin', 'AdminController@index');
    });
    Route::get('/admin/login', 'AdminController@login');
    Route::post('/admin/login', 'AdminController@postLogin');
    Route::get('/admin/logout', 'AdminController@logout');
    Route::resource('/admin/cursos', 'AdminCursosController');
    Route::resource('/admin/alumnos', 'AdminAlumnosController');
    Route::resource('/admin/categorias', 'AdminCategoriasController');
    Route::resource('/admin/profesores', 'AdminProfesoresController');
    Route::resource('/admin/alumnoscursos', 'AdminAlumnosCursosController');
});

Route::group(['middleware' => 'web'], function () {
    Route::group(['middleware' => 'auth:web'], function () {
        Route::get('/user', 'UserController@index');
    });
    Route::get('/login', 'UserController@login');
    Route::get('/register', 'UserController@register');
    Route::post('/login', 'UserController@postLogin');
    Route::post('/register', 'UserController@postRegister');
    Route::get('/logout', 'UserController@logout');
    Route::post('/pagar/{idCurso}/{idAlumno}', 'AlumnosCursosController@postPagar');
});





