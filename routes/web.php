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

Route::get('/', 'HomeController@index');
// DEMO
Route::get('demo', 'HomeController@demo')->name('demo');
Route::get('demo/register', 'HomeController@registerDemo')->name('registerDemo');
// 
Auth::routes();
Route::get('admin/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/home', function(){
	return redirect(route('dashboard', Auth::user()->team->id));
});
Route::get('/dashboard', function(){
	return redirect(route('dashboard', Auth::user()->team->id));
})->name('home');
Route::get('/profile/{user}', 'HomeController@profile')->name('profile');

// TRANSACTIONS
Route::get('transaction/create', 'TransactionController@create')->name('transaction.create');
Route::post('team/{team}/transaction', 'TransactionController@store')->name('transaction.store');
Route::get('transaction/{transaction}', 'TransactionController@show')->name('transaction.show');
Route::get('transaction/{transaction}/edit', 'TransactionController@edit')->name('transaction.edit');
Route::post('transaction/{transaction}', 'TransactionController@update')->name('transaction.update');
Route::get('transaction/{transaction}/confirm', 'TransactionController@confirmDelete')->name('transaction.confirmDelete');
Route::get('transaction/{transaction}/delete', 'TransactionController@delete')->name('transaction.delete');

// CATEGORIES
Route::post('category/create-for-team/{team}', 'CategoryController@store')->name('category.store');
Route::get('category/{category}/edit', 'CategoryController@edit')->name('category.edit');
Route::post('category/{category}', 'CategoryController@update')->name('category.update');
Route::get('category/{category}/confirm', 'CategoryController@confirmDelete')->name('category.confirmDelete');
Route::get('category/{category}', 'CategoryController@delete')->name('category.delete');
Route::get('category/{category}/view', 'CategoryController@viewBy')->name('category.viewBy');
Route::get('category/manager', 'CategoryController@manage')->name('category.manage');

Route::get('/uncategorized', 'CategoryController@uncategorized')->name('category.uncategorized');

//SETTINGS
Route::get('settings', 'SettingsController@index')->name('settings');
Route::get('settings/team', 'SettingsController@team')->name('settings.team');
Route::post('settings/changeName', 'SettingsController@changeName')->name('settings.changeName');
Route::post('settings/changePassword', 'SettingsController@changePassword')->name('settings.changePassword');
Route::post('settings/changeEmail', 'SettingsController@changeEmail')->name('settings.changeEmail');
Route::get('settings/deleteAccount', 'SettingsController@deleteAccount')->name('settings.deleteAccount');

// TEAMS
Route::get('team/create', 'TeamController@create')->name('team.create');
Route::post('/team/{team}/changename', 'TeamController@changeName')->name('team.changeName');
Route::get('team/invite', 'TeamController@sendInvite')->name('team.sendInvite');
Route::get('team/invite/sent', 'TeamController@sent')->name('team.inviteSent');
Route::get('team/invite/accept/{token}', 'TeamController@acceptInvite')->name('team.acceptInvite');
Route::get('team/{team}/view', 'TeamController@view')->name('team.view');
Route::get('team/remove/{user}', 'TeamController@remove')->name('team.removeUser');
Route::get('team/{id}/leave', 'TeamController@leave')->name('team.leave');
Route::get('invite/{id}/delete', 'TeamController@deleteInvite')->name('team.deleteInvite');

// DASHBOARD
Route::get('dashboard/{team}', 'DashboardController@index')->name('dashboard');
//TESTING
Route::get('admin/test', 'HomeController@test')->name('admin.test');

