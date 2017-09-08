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



Route::get('/add-customer', function () {

	$user_id = env('RESELLER_CLUB_USER_ID');
	$api_key = env('RESELLER_CLUB_API_KEY');
	$url = env('RESELLER_CLUB_BASEURL');
      $class = new \App\Domains\Domain($user_id,$api_key,$url);
      echo $class->addCustomer();
	
});


Route::get('/add-contact', function () {

	$user_id = env('RESELLER_CLUB_USER_ID');
	$api_key = env('RESELLER_CLUB_API_KEY');
	$url = env('RESELLER_CLUB_BASEURL');
      $class = new \App\Domains\Domain($user_id,$api_key,$url);
      echo $class->addContact();
});


Route::get('/add-domain', function () {

	$user_id = env('RESELLER_CLUB_USER_ID');
	$api_key = env('RESELLER_CLUB_API_KEY');
	$url = env('RESELLER_CLUB_BASEURL');
      $class = new \App\Domains\Domain($user_id,$api_key,$url);
      return $class->addDomain();
	
});


Route::get('/search-domains', function () {

	$user_id = env('RESELLER_CLUB_USER_ID');
	$api_key = env('RESELLER_CLUB_API_KEY');
	$url = env('RESELLER_CLUB_BASEURL');
      $class = new \App\Domains\Domain($user_id,$api_key,$url);
      echo $class->searchDomains('shitajsdjdk',['com','net']);
});



Route::get('/change-name-servers', function () {
	$user_id = env('RESELLER_CLUB_USER_ID');
	$api_key = env('RESELLER_CLUB_API_KEY');
	$url = env('RESELLER_CLUB_BASEURL');
      $class = new \App\Domains\Domain($user_id,$api_key,$url);
      echo $class->changeNameServer();
});

