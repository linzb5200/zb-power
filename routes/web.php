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
    Route::get('/download','ProductsController@download')->name('download');

});

//博客-不需要认证
Route::group(['namespace'=>'Home','prefix'=>'blog'],function (){
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
    Route::get('mine','User\MineController@art')->name('home.user.mine');
    Route::get('mine/fav','User\MineController@fav')->name('home.user.mine.fav');
    Route::get('mine/down','User\MineController@down')->name('home.user.mine.down');
    Route::get('mine/add','User\MineController@add')->name('home.user.mine.add');
    //我的明细
    Route::get('details/score','User\DetailsController@score')->name('home.user.details.score');
    Route::get('details/recharge','User\DetailsController@recharge')->name('home.user.details.recharge');
    //修改资料
    Route::post('pwd','User\AjaxController@pwd')->name('home.user.pwd');
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


});