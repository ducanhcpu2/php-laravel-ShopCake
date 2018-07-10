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

Route::get('/', function () {
    return view('welcome');
});
Route::get('index',[
	'as'=>'trang-chu',
	'uses'=>'PageController@getIndex'
]);

Route::get('loai-san-pham/{type}',[
	'as'=>'loaisanpham',
	'uses'=>'PageController@getLoaiSp'
]);

Route::get('chi-tiet-san-pham/{id}',[
	'as'=>'chitietsanpham',
	'uses'=>'PageController@getChitiet'
]);

Route::get('lien-he',[
	'as'=>'lienhe',
	'uses'=>'PageController@getLienHe'
]);

Route::get('gioi-thieu',[
	'as'=>'gioithieu',
	'uses'=>'PageController@getGioiThieu'
]);

Route::get('add-to-cart/{id}',[
	'as'=>'themgiohang',
	'uses'=>'PageController@AddtoCart'
]);

Route::get('dell-cart/{id}',[
	'as'=>'xoahang',
	'uses'=>'PageController@DellCart'
]);

Route::get('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@getCheckout'
]);

Route::post('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@postCheckout'
]);

Route::get('dang-nhap',[
	'as'=>'login',
	'uses'=>'PageController@getDangNhap'
]);

Route::post('dang-nhap',[
	'as'=>'login',
	'uses'=>'PageController@postDangNhap'
]);

Route::get('dang-ky',[
	'as'=>'register',
	'uses'=>'PageController@getDangKy'
]);

Route::post('dang-ky',[
	'as'=>'register',
	'uses'=>'PageController@postDangKy'
]);

Route::get('dang-xuat',[
	'as'=>'logout',
	'uses'=>'PageController@getDangXuat'
]);

Route::get('search',[
	'as'=>'timkiem',
	'uses'=>'PageController@getTimkiem'
]);