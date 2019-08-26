<?php
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| 后台公共路由部分
|
*/
Route::group(['namespace'=>'Admin','prefix'=>'admin'],function (){
    //登录、注销
    Route::get('login','LoginController@showLoginForm')->name('admin.loginForm');
    Route::post('login','LoginController@login')->name('admin.login');
    Route::get('logout','LoginController@logout')->name('admin.logout');

});

/*
|
| 后台需要授权的路由 admins
|
*/
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'auth'],function (){
    //后台布局
    Route::get('/','IndexController@layout')->name('admin.layout');
    //后台首页
    Route::get('/index','IndexController@index')->name('admin.index');
    Route::get('/index0','IndexController@index0')->name('admin.index0');
    Route::get('/index1','IndexController@index1')->name('admin.index1');
    Route::get('/index2','IndexController@index2')->name('admin.index2');
    //图标
    Route::get('icons','IndexController@icons')->name('admin.icons');
});

//系统管理
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>['auth','permission:system.manage']],function (){
    //数据表格接口
    Route::get('data','IndexController@data')->name('admin.data')->middleware('permission:system.role|system.permission');
    //用户管理
    Route::group(['middleware'=>['permission:system.user']],function (){
        Route::get('user/data','UserController@data')->name('admin.user.data')->middleware('permission:system.user');
        Route::get('user','UserController@index')->name('admin.user');
        //添加
        Route::get('user/create','UserController@create')->name('admin.user.create')->middleware('permission:system.user.create');
        Route::post('user/store','UserController@store')->name('admin.user.store')->middleware('permission:system.user.create');
        //编辑
        Route::get('user/{id}/edit','UserController@edit')->name('admin.user.edit')->middleware('permission:system.user.edit');
        Route::put('user/{id}/update','UserController@update')->name('admin.user.update')->middleware('permission:system.user.edit');
        //删除
        Route::delete('user/destroy','UserController@destroy')->name('admin.user.destroy')->middleware('permission:system.user.destroy');
        //分配角色
        Route::get('user/{id}/role','UserController@role')->name('admin.user.role')->middleware('permission:system.user.role');
        Route::put('user/{id}/assignRole','UserController@assignRole')->name('admin.user.assignRole')->middleware('permission:system.user.role');
        //分配权限
        Route::get('user/{id}/permission','UserController@permission')->name('admin.user.permission')->middleware('permission:system.user.permission');
        Route::put('user/{id}/assignPermission','UserController@assignPermission')->name('admin.user.assignPermission')->middleware('permission:system.user.permission');
    });
    //角色管理
    Route::group(['middleware'=>'permission:system.role'],function (){
        Route::get('role','RoleController@index')->name('admin.role');
        //添加
        Route::get('role/create','RoleController@create')->name('admin.role.create')->middleware('permission:system.role.create');
        Route::post('role/store','RoleController@store')->name('admin.role.store')->middleware('permission:system.role.create');
        //编辑
        Route::get('role/{id}/edit','RoleController@edit')->name('admin.role.edit')->middleware('permission:system.role.edit');
        Route::put('role/{id}/update','RoleController@update')->name('admin.role.update')->middleware('permission:system.role.edit');
        //删除
        Route::delete('role/destroy','RoleController@destroy')->name('admin.role.destroy')->middleware('permission:system.role.destroy');
        //分配权限
        Route::get('role/{id}/permission','RoleController@permission')->name('admin.role.permission')->middleware('permission:system.role.permission');
        Route::put('role/{id}/assignPermission','RoleController@assignPermission')->name('admin.role.assignPermission')->middleware('permission:system.role.permission');
    });
    //权限管理
    Route::group(['middleware'=>'permission:system.permission'],function (){
        Route::get('permission','PermissionController@index')->name('admin.permission');
        //添加
        Route::get('permission/create','PermissionController@create')->name('admin.permission.create')->middleware('permission:system.permission.create');
        Route::post('permission/store','PermissionController@store')->name('admin.permission.store')->middleware('permission:system.permission.create');
        //编辑
        Route::get('permission/{id}/edit','PermissionController@edit')->name('admin.permission.edit')->middleware('permission:system.permission.edit');
        Route::put('permission/{id}/update','PermissionController@update')->name('admin.permission.update')->middleware('permission:system.permission.edit');
        //删除
        Route::delete('permission/destroy','PermissionController@destroy')->name('admin.permission.destroy')->middleware('permission:system.permission.destroy');
    });
    //菜单管理
    Route::group(['middleware'=>'permission:system.menu'],function (){
        Route::get('menu','MenuController@index')->name('admin.menu');
        Route::get('menu/data','MenuController@data')->name('admin.menu.data');
        //添加
        Route::get('menu/create','MenuController@create')->name('admin.menu.create')->middleware('permission:system.menu.create');
        Route::post('menu/store','MenuController@store')->name('admin.menu.store')->middleware('permission:system.menu.create');
        //编辑
        Route::get('menu/{id}/edit','MenuController@edit')->name('admin.menu.edit')->middleware('permission:system.menu.edit');
        Route::put('menu/{id}/update','MenuController@update')->name('admin.menu.update')->middleware('permission:system.menu.edit');
        //删除
        Route::delete('menu/destroy','MenuController@destroy')->name('admin.menu.destroy')->middleware('permission:system.menu.destroy');
    });
});

//会员管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:member.manage']], function () {
    //账号管理
    Route::group(['middleware' => 'permission:member.member'], function () {
        Route::get('member/data', 'MemberController@data')->name('admin.member.data');
        Route::get('member', 'MemberController@index')->name('admin.member');
        //添加
        Route::get('member/create', 'MemberController@create')->name('admin.member.create')->middleware('permission:member.member.create');
        Route::post('member/store', 'MemberController@store')->name('admin.member.store')->middleware('permission:member.member.create');
        //编辑
        Route::get('member/{id}/edit', 'MemberController@edit')->name('admin.member.edit')->middleware('permission:member.member.edit');
        Route::put('member/{id}/update', 'MemberController@update')->name('admin.member.update')->middleware('permission:member.member.edit');
        //删除
        Route::delete('member/destroy', 'MemberController@destroy')->name('admin.member.destroy')->middleware('permission:member.member.destroy');
    });
});
//采集管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:crawler.manage']], function () {
    //规则管理
    Route::group(['middleware' => 'permission:crawler.rule'], function () {
        Route::get('crawler/rule/data', 'Crawler\RuleController@data')->name('admin.crawler_rule.data');
        Route::get('crawler/rule', 'Crawler\RuleController@index')->name('admin.crawler_rule');
        //添加规则
        Route::get('crawler/rule/create', 'Crawler\RuleController@create')->name('admin.crawler_rule.create')->middleware('permission:crawler.rule.create');
        Route::post('crawler/rule/store', 'Crawler\RuleController@store')->name('admin.crawler_rule.store')->middleware('permission:crawler.rule.create');
        //编辑规则
        Route::get('crawler/rule/{id}/edit', 'Crawler\RuleController@edit')->name('admin.crawler_rule.edit')->middleware('permission:crawler.rule.edit');
        Route::put('crawler/rule/{id}/update', 'Crawler\RuleController@update')->name('admin.crawler_rule.update')->middleware('permission:crawler.rule.edit');
        //删除规则
        Route::delete('crawler/rule/destroy', 'Crawler\RuleController@destroy')->name('admin.crawler_rule.destroy')->middleware('permission:crawler.rule.destroy');
        //采集
        Route::get('crawler/rule/{id}/pick', 'Crawler\RuleController@pick')->name('admin.crawler_rule.pick');
        //复制
        Route::post('crawler/rule/{id}/copy', 'Crawler\RuleController@copy')->name('admin.crawler_rule.copy');
    });
    //采集管理
    Route::group(['middleware' => 'permission:crawler.power'], function () {
        Route::get('crawler/power/data', 'Crawler\PowerController@data')->name('admin.crawler_power.data');
        Route::get('crawler/power', 'Crawler\PowerController@index')->name('admin.crawler_power');
        //添加
        Route::get('crawler/power/create', 'Crawler\PowerController@create')->name('admin.crawler_power.create')->middleware('permission:crawler.pruducts.create');
        Route::post('crawler/power/store', 'Crawler\PowerController@store')->name('admin.crawler_power.store')->middleware('permission:crawler.power.create');
        //编辑
        Route::get('crawler/power/{id}/edit', 'Crawler\PowerController@edit')->name('admin.crawler_power.edit')->middleware('permission:crawler.power.edit');
        Route::put('crawler/power/{id}/update', 'Crawler\PowerController@update')->name('admin.crawler_power.update')->middleware('permission:crawler.power.edit');
        //删除
        Route::delete('crawler/power/destroy', 'Crawler\PowerController@destroy')->name('admin.crawler_power.destroy')->middleware('permission:crawler.power.destroy');
        //入库
        Route::post('crawler/power/adds', 'Crawler\PowerController@adds')->name('admin.crawler_power.adds')->middleware('permission:crawler.power.adds');
    });
});
//资讯管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:zixun.manage']], function () {
    //分类管理
    Route::group(['middleware' => 'permission:zixun.category'], function () {
        Route::get('category/data', 'ArticleCateController@data')->name('admin.category.data');
        Route::get('category', 'ArticleCateController@index')->name('admin.category');
        //添加分类
        Route::get('category/create', 'ArticleCateController@create')
            ->name('admin.category.create')
            ->middleware('permission:zixun.category.create');
        Route::post('category/store', 'ArticleCateController@store')
            ->name('admin.category.store')
            ->middleware('permission:zixun.category.create');
        //编辑分类
        Route::get('category/{id}/edit', 'ArticleCateController@edit')->name('admin.category.edit')->middleware('permission:zixun.category.edit');
        Route::put('category/{id}/update', 'ArticleCateController@update')->name('admin.category.update')->middleware('permission:zixun.category.edit');
        //删除分类
        Route::delete('category/destroy', 'ArticleCateController@destroy')->name('admin.category.destroy')->middleware('permission:zixun.category.destroy');
    });
    //文章管理
    Route::group(['middleware' => 'permission:zixun.article'], function () {
        Route::get('article/data', 'ArticleController@data')->name('admin.article.data');
        Route::get('article', 'ArticleController@index')->name('admin.article');
        //添加
        Route::get('article/create', 'ArticleController@create')->name('admin.article.create')->middleware('permission:zixun.article.create');
        Route::post('article/store', 'ArticleController@store')->name('admin.article.store')->middleware('permission:zixun.article.create');
        //编辑
        Route::get('article/{id}/edit', 'ArticleController@edit')->name('admin.article.edit')->middleware('permission:zixun.article.edit');
        Route::put('article/{id}/update', 'ArticleController@update')->name('admin.article.update')->middleware('permission:zixun.article.edit');
        //删除
        Route::delete('article/destroy', 'ArticleController@destroy')->name('admin.article.destroy')->middleware('permission:zixun.article.destroy');
    });
});
//产品管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:products.manage']], function () {
    //产品分类管理
    Route::group(['middleware' => 'permission:products.cate'], function () {
        Route::get('products/category/data', 'Products\ProductsCateController@data')->name('admin.products_cate.data');
        Route::get('products/category', 'Products\ProductsCateController@index')->name('admin.products_cate');
        //添加分类
        Route::get('products/category/create', 'Products\ProductsCateController@create')->name('admin.products_cate.create')->middleware('permission:products.cate.create');
        Route::post('products/category/store', 'Products\ProductsCateController@store')->name('admin.products_cate.store')->middleware('permission:products.cate.create');
        //编辑分类
        Route::get('products/category/{id}/edit', 'Products\ProductsCateController@edit')->name('admin.products_cate.edit')->middleware('permission:products.cate.edit');
        Route::put('products/category/{id}/update', 'Products\ProductsCateController@update')->name('admin.products_cate.update')->middleware('permission:products.cate.edit');
        //删除分类
        Route::delete('products/category/destroy', 'Products\ProductsCateController@destroy')->name('admin.products_cate.destroy')->middleware('permission:products.cate.destroy');
    });
    //产品管理
    Route::group(['middleware' => 'permission:products.product'], function () {
        Route::get('products/data', 'Products\ProductsController@data')->name('admin.products.data');
        Route::get('products','Products\ProductsController@index')->name('admin.products');
        //添加
        Route::get('products/create','Products\ProductsController@create')->name('admin.products.create')->middleware('permission:products.product.create');
        Route::post('products/store', 'Products\ProductsController@store')->name('admin.products.store')->middleware('permission:products.product.create');
        //编辑
        Route::get('products/{id}/edit', 'Products\ProductsController@edit')->name('admin.products.edit')->middleware('permission:products.product.edit');
        Route::put('products/{id}/update', 'Products\ProductsController@update')->name('admin.products.update')->middleware('permission:products.product.edit');
        //删除
        Route::delete('products/destroy', 'Products\ProductsController@destroy')->name('admin.products.destroy')->middleware('permission:products.product.destroy');
    });
});
//配置管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:config.manage']], function () {
    //站点配置
    Route::group(['middleware' => 'permission:config.system'], function () {
        Route::get('system/data', 'SystemController@data')->name('admin.system.data');
        Route::get('system/index', 'SystemController@index')->name('admin.system');
        //添加
        Route::get('system/create', 'SystemController@create')->name('admin.system.create')->middleware('permission:config.system.create');
        Route::post('system/store', 'SystemController@store')->name('admin.system.store')->middleware('permission:config.system.create');
        //编辑
        Route::get('system/{id}/edit', 'SystemController@edit')->name('admin.system.edit')->middleware('permission:config.system.edit');
        Route::put('system/{id}/update', 'SystemController@update')->name('admin.system.update')->middleware('permission:config.system.edit');
        //删除
        Route::delete('system/destroy', 'SystemController@destroy')->name('admin.system.destroy')->middleware('permission:config.system.destroy');
    });
    //标签管理
    Route::group(['middleware' => 'permission:config.tag'], function () {
        Route::get('tag/data', 'TagController@data')->name('admin.tag.data');
        Route::get('tag', 'TagController@index')->name('admin.tag');
        //添加
        Route::get('tag/create', 'TagController@create')->name('admin.tag.create')->middleware('permission:admin.tag.create');
        Route::post('tag/store', 'TagController@store')->name('admin.tag.store')->middleware('permission:admin.tag.create');
        //编辑
        Route::get('tag/{id}/edit', 'TagController@edit')->name('admin.tag.edit')->middleware('permission:admin.tag.edit');
        Route::put('tag/{id}/update', 'TagController@update')->name('admin.tag.update')->middleware('permission:admin.tag.edit');
        //删除
        Route::delete('tag/destroy', 'TagController@destroy')->name('admin.tag.destroy')->middleware('permission:admin.tag.destroy');
    });
    //颜色管理
    Route::group(['middleware' => 'permission:config.color'], function () {
        Route::get('color/data', 'ColorController@data')->name('admin.color.data');
        Route::get('color', 'ColorController@index')->name('admin.color');
        //添加
        Route::get('color/create', 'ColorController@create')->name('admin.color.create')->middleware('permission:admin.color.create');
        Route::post('color/store', 'ColorController@store')->name('admin.color.store')->middleware('permission:admin.color.create');
        //编辑
        Route::get('color/{id}/edit', 'ColorController@edit')->name('admin.color.edit')->middleware('permission:admin.color.edit');
        Route::put('color/{id}/update', 'ColorController@update')->name('admin.color.update')->middleware('permission:admin.color.edit');
        //删除
        Route::delete('color/destroy', 'ColorController@destroy')->name('admin.color.destroy')->middleware('permission:admin.color.destroy');
    });
    //风格管理
    Route::group(['middleware' => 'permission:config.style'], function () {
        Route::get('style/data', 'StyleController@data')->name('admin.style.data');
        Route::get('style', 'StyleController@index')->name('admin.style');
        //添加
        Route::get('style/create', 'StyleController@create')->name('admin.style.create')->middleware('permission:admin.style.create');
        Route::post('style/store', 'StyleController@store')->name('admin.style.store')->middleware('permission:admin.style.create');
        //编辑
        Route::get('style/{id}/edit', 'StyleController@edit')->name('admin.style.edit')->middleware('permission:admin.style.edit');
        Route::put('style/{id}/update', 'StyleController@update')->name('admin.style.update')->middleware('permission:admin.style.edit');
        //删除
        Route::delete('style/destroy', 'StyleController@destroy')->name('admin.style.destroy')->middleware('permission:admin.style.destroy');
    });
    //行业分类管理
    Route::group(['middleware' => 'permission:config.trades'], function () {
        Route::get('trades/data', 'TradesController@data')->name('admin.trades.data');
        Route::get('trades', 'TradesController@index')->name('admin.trades');
        //添加
        Route::get('trades/create', 'TradesController@create')->name('admin.trades.create')->middleware('permission:admin.trades.create');
        Route::post('trades/store', 'TradesController@store')->name('admin.trades.store')->middleware('permission:admin.trades.create');
        //编辑
        Route::get('trades/{id}/edit', 'TradesController@edit')->name('admin.trades.edit')->middleware('permission:admin.trades.edit');
        Route::put('trades/{id}/update', 'TradesController@update')->name('admin.trades.update')->middleware('permission:admin.trades.edit');
        //删除
        Route::delete('trades/destroy', 'TradesController@destroy')->name('admin.trades.destroy')->middleware('permission:admin.trades.destroy');
    });
    //广告位
    Route::group(['middleware' => 'permission:config.position'], function () {
        Route::get('position/data', 'PositionController@data')->name('admin.position.data');
        Route::get('position', 'PositionController@index')->name('admin.position');
        //添加
        Route::get('position/create', 'PositionController@create')->name('admin.position.create')->middleware('permission:config.position.create');
        Route::post('position/store', 'PositionController@store')->name('admin.position.store')->middleware('permission:config.position.create');
        //编辑
        Route::get('position/{id}/edit', 'PositionController@edit')->name('admin.position.edit')->middleware('permission:config.position.edit');
        Route::put('position/{id}/update', 'PositionController@update')->name('admin.position.update')->middleware('permission:config.position.edit');
        //删除
        Route::delete('position/destroy', 'PositionController@destroy')->name('admin.position.destroy')->middleware('permission:config.position.destroy');
    });
    //广告信息
    Route::group(['middleware' => 'permission:config.advert'], function () {
        Route::get('advert/data', 'AdvertController@data')->name('admin.advert.data');
        Route::get('advert', 'AdvertController@index')->name('admin.advert');
        //添加
        Route::get('advert/create', 'AdvertController@create')->name('admin.advert.create')->middleware('permission:config.advert.create');
        Route::post('advert/store', 'AdvertController@store')->name('admin.advert.store')->middleware('permission:config.advert.create');
        //编辑
        Route::get('advert/{id}/edit', 'AdvertController@edit')->name('admin.advert.edit')->middleware('permission:config.advert.edit');
        Route::put('advert/{id}/update', 'AdvertController@update')->name('admin.advert.update')->middleware('permission:config.advert.edit');
        //删除
        Route::delete('advert/destroy', 'AdvertController@destroy')->name('admin.advert.destroy')->middleware('permission:config.advert.destroy');
    });
});
//消息管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:message.manage']], function () {
    //消息管理
    Route::group(['middleware' => 'permission:message.message'], function () {
        Route::get('message/data', 'MessageController@data')->name('admin.message.data');
        Route::get('message/getUser', 'MessageController@getUser')->name('admin.message.getUser');
        Route::get('message', 'MessageController@index')->name('admin.message');
        //添加
        Route::get('message/create', 'MessageController@create')->name('admin.message.create')->middleware('permission:message.message.create');
        Route::post('message/store', 'MessageController@store')->name('admin.message.store')->middleware('permission:message.message.create');
        //删除
        Route::delete('message/destroy', 'MessageController@destroy')->name('admin.message.destroy')->middleware('permission:message.message.destroy');
        //我的消息
        Route::get('mine/message', 'MessageController@mine')->name('admin.message.mine')->middleware('permission:message.message.mine');
        Route::post('message/{id}/read', 'MessageController@read')->name('admin.message.read')->middleware('permission:message.message.mine');

        Route::get('message/count', 'MessageController@getMessageCount')->name('admin.message.get_count');
    });

});