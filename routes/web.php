<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');


Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');

    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

    //Location Routes
    Route::resource('locations', 'Admin\LocationsController');
    Route::post('locations_mass_destroy', ['uses' => 'Admin\LocationsController@massDestroy', 'as' => 'locations.mass_destroy']);
    Route::post('locations_restore/{id}', ['uses' => 'Admin\LocationsController@restore', 'as' => 'locations.restore']);
    Route::delete('locations_perma_del/{id}', ['uses' => 'Admin\LocationsController@perma_del', 'as' => 'locations.perma_del']);

    //RateCc Routes
    Route::resource('rateCcs', 'Admin\RateCcsController');
    Route::post('rateCcs_mass_destroy', ['uses' => 'Admin\RateCcsController@massDestroy', 'as' => 'rateCcs.mass_destroy']);
    Route::post('rateCcs_restore/{id}', ['uses' => 'Admin\RateCcsController@restore', 'as' => 'rateCcs.restore']);
    Route::delete('rateCcs_perma_del/{id}', ['uses' => 'Admin\RateCcsController@perma_del', 'as' => 'rateCcs.perma_del']);

    //RateWeight Routes
    Route::resource('rateWeights', 'Admin\RateWeightsController');
    Route::post('rateWeights_mass_destroy', ['uses' => 'Admin\RateWeightsController@massDestroy', 'as' => 'rateWeights.mass_destroy']);
    Route::post('rateWeights_restore/{id}', ['uses' => 'Admin\RateWeightsController@restore', 'as' => 'rateWeights.restore']);
    Route::delete('rateWeights_perma_del/{id}', ['uses' => 'Admin\RateWeightsController@perma_del', 'as' => 'rateWeights.perma_del']);

    //Crabrand Routes
    Route::resource('carbrands', 'Admin\CarbrandsController');
    Route::post('carbrands_mass_destroy', ['uses' => 'Admin\CarbrandsController@massDestroy', 'as' => 'carbrands.mass_destroy']);
    Route::post('carbrands_restore/{id}', ['uses' => 'Admin\CarbrandsController@restore', 'as' => 'carbrands.restore']);
    Route::delete('carbrands_perma_del/{id}', ['uses' => 'Admin\CarbrandsController@perma_del', 'as' => 'carbrands.perma_del']);

    //Carmodel Routes
    Route::resource('carmodels', 'Admin\CarmodelsController');
    Route::post('carmodels_mass_destroy', ['uses' => 'Admin\CarmodelsController@massDestroy', 'as' => 'carmodels.mass_destroy']);
    Route::post('carmodels_restore/{id}', ['uses' => 'Admin\CarmodelsController@restore', 'as' => 'carmodels.restore']);
    Route::delete('carmodels_perma_del/{id}', ['uses' => 'Admin\CarmodelsController@perma_del', 'as' => 'carmodels.perma_del']);

    Route::resource('checks', 'Admin\ChecksController');
    Route::post('checks_mass_destroy', ['uses' => 'Admin\ChecksController@massDestroy', 'as' => 'checks.mass_destroy']);
    Route::post('checks_restore/{id}', ['uses' => 'Admin\ChecksController@restore', 'as' => 'checks.restore']);
    Route::delete('checks_perma_del/{id}', ['uses' => 'Admin\ChecksController@perma_del', 'as' => 'checks.perma_del']);

    Route::post('ajaxRequest', 'Admin\ChecksController@ajaxRequestPost')->name('checks.ajaxRequest.post');

});


