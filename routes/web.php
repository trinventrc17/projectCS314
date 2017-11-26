<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return redirect('login');
});








Route::group(['middleware' => 'auth'], function () {
    Route::resource('posrooms', 'CustomerController');
    Route::resource('rooms', 'RoomController');
    Route::resource('suppliers', 'SupplierController');
    Route::resource('products', 'ProductController');
    Route::resource('users', 'UserController');
    Route::resource('expenses', 'ExpensesController');
    Route::resource('stocks', 'StocksController');
    Route::resource('roomchanges', 'RoomChangesController');



    //Excel Reports
    Route::get('ExportReports','ExcelReports@ExportReports');
            Route::get('/printables/index/sales','ExcelReports@salesIndex');
            Route::get('/printables/index/sales/salesCustomizedFilter','ExcelReports@salesCustomizedFilter');
            Route::get('/printables/index/sales/salesDefaultFilter','ExcelReports@salesDefaultFilter');
                Route::get('/printables/index/sales/salesExcelPrintable','ExcelReports@salesExcelPrintable');

            Route::get('/printables/index/earningsAndExpenses','ExcelReports@earningsAndExpensesIndex');
            Route::get('/printables/index/earningsAndExpenses/earningsAndExpensesCustomizedFilter','ExcelReports@earningsAndExpensesCustomizedFilter');
            Route::get('/printables/index/earningsAndExpenses/earningsAndExpensesDefaultFilter','ExcelReports@earningsAndExpensesDefaultFilter');
                Route::get('/printables/index/earningsAndExpenses/earningsAndExpensesExcelPrintable','ExcelReports@earningsAndExpensesExcelPrintable');

            Route::get('/printables/index/products','ExcelReports@productsIndex');
            Route::get('/printables/index/products/productsDefaultFilter','ExcelReports@productsDefaultFilter');
            Route::get('/printables/index/products/productsCustomizedFilter','ExcelReports@productsCustomizedFilter');
                Route::get('/printables/index/products/productsExcelPrintable','ExcelReports@productsExcelPrintable');




    //Room Changes
    Route::post('/roomchanges/{id}/updateRoom','RoomChangesController@updateRoom');
        Route::post('/rooms/{id}/roomChangesSale','RoomChangesController@roomChangesSale');

    //Additional Room Sales
    Route::post('/rooms/{id}/additionalSale','RoomController@additionalSale');

    Route::get('/stocks/addFromExisting/addFromExisting','StocksController@addFromExisting');
     Route::get('/stocks/ask/ask','StocksController@ask');

    Route::get('/productsReport','ProductsReportController@index');
    Route::get('/productsReport/rooms','ProductsReportController@rooms');
    Route::get('/productsReport/earnings','ProductsReportController@earnings');
    //Rooms Track
    Route::get('RoomsTrack/{id}/chooseAction', 'RoomsTrackController@chooseAction');
    Route::get('RoomsTrack/{id}/{action}/actionChosen', 'RoomsTrackController@actionChosen');



    //Rooms
    Route::get('/home', 'BaseController@index');
    Route::get('/rooms/create','RoomController@create');
    
    Route::get('/rooms/{id}/checkstatus/','RoomController@checkstatus');
        Route::get('/rooms/{id}/askoccupy/','RoomController@askoccupy');
        Route::get('/rooms/{id}/roomoccupied/','RoomController@roomoccupied');
        
    Route::get('/rooms/{id}/chooseaction/','RoomController@chooseaction');
        Route::get('/rooms/{id}/walkin','RoomController@walkin');
            Route::get('/rooms/{id}/movieOrKtv','RoomController@movieOrKtv');
                Route::get('/rooms/{id}/movieChooseRoomType','MovieController@movieChooseRoomType');
                    Route::get('/rooms/{id}/movieGoodFor2','MovieController@movieGoodFor2');
                    Route::get('/rooms/{id}/movieGoodFor4','MovieController@movieGoodFor4');
                    Route::get('/rooms/{id}/movieGoodFor8','MovieController@movieGoodFor8');
                Route::get('/rooms/{id}/ktv','RoomController@ktv');
                
        Route::get('/rooms/{id}/reserve','RoomController@reserve');
            Route::post('/rooms/{id}/walkinsales','RoomController@walkinSale');
            Route::post('/rooms/{id}/additionalSale','RoomController@additionalSale');
            Route::get('/rooms/{id}/walkin/sales','RoomController@roomSales');

        Route::get('/rooms/{id}/roomDetailsAndReceipt/','RoomController@roomDetailsAndReceipt');


    //End Rooms
    Route::resource('sales', 'SaleController', ['only' => ['create', 'store']]);
    Route::get('sales/receipt/{id}', 'SaleController@receipt');

    Route::group(['prefix' => 'inventories'], function () {
        Route::resource('receivings', 'ReceivingController', ['except' => ['edit', 'update', 'destroy']]);
        Route::resource('adjustments', 'AdjustmentController', ['except' => ['edit', 'update', 'destroy']]);
        Route::get('trackings', 'TrackingController@index');
    });

    Route::get('reports/{type}', 'ReportController@index');
    Route::get('reports/sales/{id}', 'ReportController@show');

    Route::get('shows/{type}', 'SalesController@index');

    Route::group(['prefix' => 'settings'], function () {
        Route::get('profile', 'ProfileController@edit');
        Route::put('profile', 'ProfileController@update');
        Route::get('general', 'SettingController@edit');
        Route::put('general', 'SettingController@update');
        Route::get('/personal-tokens', function () {
            return view('settings.users.personal-access-token');
        });
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
    });
});
