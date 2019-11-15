<?php

Route::middleware(['verified', 'role:viewer'])->group(function () {
	Route::namespace('Viewer')->group(function () {
	    // Controllers Within The "App\Http\Controllers\Viewer" Namespace
    	Route::get('/viewer/timesheet', 'ViewerController@timesheet')->name('viewer.timesheet');
    	Route::post('/viewer/clients', 'ViewerController@clients')->name('viewer.clients');
    	Route::resource('viewer', 'ViewerController');
	});
});
