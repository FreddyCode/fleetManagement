<?php

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

Route::get('/',['as'=>'/'], function () {
    return view('login');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', ['as' => 'getDashboard', 'uses' => 'DashboardController@Dashboard']);
    //=============================USERS================================================
    Route::get('/user',['as'=>'getUser','uses'=>'UserController@User']);
    Route::post('/post/user',['as'=>'addUser','uses'=>'UserController@postRegister']);
    Route::get('/users',['as'=>'getUsers','uses'=>'UserController@Users']);
    Route::get('/edit/user',['as'=>'editUser','uses'=>'UserController@editUser']);
    Route::post('/update/user',['as'=>'updateUser','uses'=>'UserController@updateUser']);

    //===========================CARS===================================================
    Route::get('/cars',['as'=>'getCars','uses'=>'CarController@Cars']);
    Route::post('/postcar', ['as' => 'postCar', 'uses' => 'CarController@createCar']);
    Route::get('/carsInfo', ['as' => 'showCarsInfo', 'uses' => 'CarController@showCarInformation']);
    Route::get('/editcar', ['as' => 'editCar', 'uses' => 'CarController@editCar']);
    Route::post('/updatecar', ['as' => 'updateCar', 'uses' => 'CarController@updateCar']);
    Route::post('/deletecar', ['as' => 'deleteCar', 'uses' => 'CarController@deleteCar']);

    //===========================MODELS===================================================
    Route::get('/models',['as'=>'getModels','uses'=>'CarController@Models']);
    Route::post('/postmodel', ['as' => 'postModel', 'uses' => 'CarController@createModel']);
    Route::get('/modelsInfo', ['as' => 'showModelsInfo', 'uses' => 'CarController@showModelInformation']);
    Route::get('/editmodel', ['as' => 'editModel', 'uses' => 'CarController@editModel']);
    Route::post('/updatemodel', ['as' => 'updateModel', 'uses' => 'CarController@updateModel']);
    Route::post('/deletemodel', ['as' => 'deleteModel', 'uses' => 'CarController@deleteModel']);

    //=========================Car Owners=====================================================
    Route::get('/add-car-owners',['as'=>'AddOwner','uses'=>'OwnerController@Owner']);
    Route::get('/car-owners',['as'=>'ListOwner','uses'=>'OwnerController@OwnersList']);
    Route::post('/postCarOnwer',['as'=>'postCarOwner','uses'=>'OwnerController@PostOwner']);
    Route::get('/car-owner={id}',['as'=>'editCarOwner','uses'=>'OwnerController@editCarOwner']);
    Route::get('/view-car-owner={id}',['as'=>'viewCarOwner','uses'=>'OwnerController@viewCarOwner']);
    Route::patch('/car-owner/{id}',['as'=>'updateCarOwner','uses'=>'OwnerController@updateCarOwner']);

    //=========================Car Owners Details=====================================================
    Route::get('/add-car-owners-details',['as'=>'AddOwnerDetail','uses'=>'OwnerController@OwnerDetail']);
    Route::get('/car-owners-details',['as'=>'ListOwnerDetail','uses'=>'OwnerController@OwnersDetailList']);
    Route::post('/postCarOnwer-details',['as'=>'postCarOwnerDetail','uses'=>'OwnerController@PostOwnerDetail']);
    Route::get('/editCarOwner-{id}',['as'=>'editCarOwnerDetail','uses'=>'OwnerController@editCarOwnerDetail']);
    Route::get('/viewCarOwner-{id}',['as'=>'viewCarOwnerDetail','uses'=>'OwnerController@viewCarOwnerDetail']);
    Route::patch('/updateCarOwner/{detail_id}',['as'=>'updateCarOwnerDetail','uses'=>'OwnerController@updateCarOwnerDetail']);
    Route::get('/showModel',['as'=>'showModels','uses'=>'OwnerController@showModel']);

    //=================Payments==============================================================================
    Route::get('/payment',['as'=>'addPayment','uses'=>'PaymentController@Payment']);
    Route::get('/payments-list',['as'=>'payments','uses'=>'PaymentController@Payments']);
    Route::get('/template',['as'=>'template','uses'=>'PaymentController@template']);
    Route::get('/search',['as'=>'search','uses'=>'PaymentController@result']);
    Route::post('/payment',['as'=>'Payments','uses'=>'PaymentController@postPayment']);

    //====================================Drivers=====================================================
    Route::get('/add-driver',['as'=>'addDriver','uses'=>'DriversController@addDriver']);
    Route::get('/drivers-list',['as'=>'drivers-list','uses'=>'DriversController@driversInfo']);
    Route::post('/driver',['as'=>'postDriver','uses'=>'DriversController@postDriver']);
    Route::get('/driver-{id}',['as'=>'editDriver','uses'=>'DriversController@editDriver']);
    Route::get('/view-driver-{id}',['as'=>'viewDriver','uses'=>'DriversController@viewDriver']);
    Route::patch('/driver/{id}',['as'=>'updateDriver','uses'=>'DriversController@updateDriver']);


});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
