<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| 前台路由
|
*/

Route::get('/captcha', function () {
    return captcha_src();
});
//Auth::routes();
//首页
Route::get('/','Home\IndexController@index')->name('home');

//前后台共用
Route::group(['namespace' => 'Common'], function () {
    Route::post('upload/uploadImg', 'UploadController@uploadImg')->name('uploadImg');
    Route::any('upload/ueditor', 'UploadController@allImg')->name('allImg');

    Route::any('common/linkcate', 'CommonController@linkCate')->name('linkCate');
});
//前后产品-不需要认证
Route::group(['namespace' => 'Home\Products'], function () {


    Route::get('/{cate}/','ProductsController@index')->name('products.cate')
        ->where([ 'cate' => '^ppt|excel|word|resume|design']);

    Route::get('/{cate}/{page}.html','ProductsController@index')->name('products.cate3')
        ->where([ 'cate' => '^ppt|excel|word|resume|design','page' => '[0-9+]']);

    Route::get('/{cate}/{zm}/','ProductsController@index')->name('products.cate2')
        ->where([ 'cate' => '^ppt|excel|word|resume|design','zm' => '[a-z0-9]']);

    Route::get('/{cate}/{trade}{style}{color}{soft}{type}{scale}{sort}{page}.html','ProductsController@index')->name('products.index')
        ->where([ 'cate' => '^ppt|excel|word|resume|design','trade' => '[a-z0-9]','style' => '[a-z0-9]','color' => '[a-z0-9]','soft' => '[0-9]','type' => '[0-9]','scale' => '[0-9]','sort' => '[0-9]','page' => '[0-9]+']);

    Route::get('/{cate}/{zm}/{trade}{style}{color}{soft}{type}{scale}{sort}{page}.html','ProductsController@index')->name('products.index2')
        ->where([ 'cate' => '^ppt|excel|word|resume|design','zm' => '[a-z0-9]','trade' => '[a-z0-9]','style' => '[a-z0-9]','color' => '[a-z0-9]','soft' => '[0-9]','type' => '[0-9]','scale' => '[0-9]','sort' => '[0-9]','page' => '[0-9]+']);

    Route::get('/{cate}/{id}.html','ProductsController@show')->name('products.show')
        ->where([ 'cate' => '^ppt|excel|word|resume|design','id' => '[0-9]+']);

    Route::get('/{zm}{cate}/{id}.html','ProductsController@show')->name('products.show2')
        ->where([ 'zm' => '[a-z0-9]','cate' => '^ppt|excel|word|resume|design','id' => '[0-9]+']);

    Route::post('/search','ProductsController@search')->name('products.search');

});

//博客-不需要认证
Route::group(['namespace'=>'Home','prefix'=>'u'],function (){
    //个人主页
    Route::get('/{id}.html', 'Blog\BlogController@index')->name('home.blog');
});

//会员-不需要认证
Route::group(['namespace'=>'Home','prefix'=>'user'],function (){
    //注册
    Route::get('register', 'PassportController@showRegisterForm')->name('home.user.showRegisterForm');
    Route::post('register', 'PassportController@register')->name('home.user.register');
    Route::post('reg', 'PassportController@floatLogin')->name('home.user.reg');
    //登录
    Route::get('login', 'PassportController@showLoginForm')->name('home.user.showLoginForm');
    Route::post('login', 'PassportController@login')->name('home.user.login');
    Route::get('logout', 'PassportController@logout')->name('home.user.logout');
    //弹窗登录
    Route::post('floatLogin', 'PassportController@floatLogin')->name('home.user.floatLogin');
});
//会员-需要认证
Route::group(['namespace'=>'Home','prefix'=>'user','middleware'=>'member'],function (){
    //个人中心
    Route::get('/','User\UserController@index')->name('home.user');
    Route::get('profile','User\UserController@profile')->name('home.user.profile');
    //我的
    Route::get('mine','User\MineController@mine')->name('home.user.mine');
    Route::get('mine/fav','User\MineController@fav')->name('home.user.mine.fav');
    Route::get('mine/down','User\MineController@down')->name('home.user.mine.down');
    Route::get('mine/zan','User\MineController@zan')->name('home.user.mine.zan');
    Route::get('release','User\MineController@release')->name('home.user.mine.release');
    //我的明细
    Route::get('orders/score','User\OrdersController@score')->name('home.user.orders.score');
    Route::get('orders/bill','User\OrdersController@bill')->name('home.user.orders.bill');
    Route::get('orders/exchange','User\OrdersController@exchange')->name('home.user.orders.exchange');
    Route::get('orders/pay','User\OrdersController@pay')->name('home.user.orders.pay');
    //ajax
    Route::post('pwd','User\AjaxController@pwd')->name('home.user.pwd');
    Route::post('avatar','User\AjaxController@avatar')->name('home.user.avatar');
    Route::post('nickname','User\AjaxController@nickname')->name('home.user.nickname');
    Route::post('validatephone','User\AjaxController@validatephone')->name('home.user.validatephone');
    Route::post('changephone','User\AjaxController@changephone')->name('home.user.changephone');
    Route::post('validateemail','User\AjaxController@validateemail')->name('home.user.validateemail');
    Route::post('changeemail','User\AjaxController@changeemail')->name('home.user.changeemail');
    Route::post('bindqq','User\AjaxController@bind_qq')->name('home.user.bind_qq');
    Route::post('unbindqq','User\AjaxController@unbind_qq')->name('home.user.unbind_qq');
    Route::post('senddx', 'User\AjaxController@senddx')->name('home.user.senddx');
    Route::post('sign', 'User\AjaxController@sign')->name('home.user.sign');
    Route::post('top', 'User\AjaxController@top')->name('home.user.top');
    Route::post('zan', 'User\AjaxController@zan')->name('home.user.zan');
    Route::post('fav', 'User\AjaxController@fav')->name('home.user.fav');
    Route::get('download', 'User\AjaxController@download')->name('home.user.download');


});