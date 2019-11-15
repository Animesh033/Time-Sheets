<?php

Route::middleware(['verified', 'role:administrator'])->group(function () {
	Route::namespace('Admin')->group(function () {
	    // Controllers Within The "App\Http\Controllers\Admin" Namespace
    	Route::resource('admin', 'AdminController');
	});
});
