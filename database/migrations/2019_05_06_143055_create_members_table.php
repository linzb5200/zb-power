<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('name',50)->comment('用户名')->nullable();
            $table->string('nickname',50)->comment('昵称')->nullable();
            $table->string('password',191)->comment('密码');

            $table->string('from',20)->default('member')->comment('类型');
            $table->integer('province_id')->default(0)->comment('省份');
            $table->integer('city_id')->default(0)->comment('城市');
            $table->integer('area_id')->default(0)->comment('地区');
            $table->string('mobile',20)->default('')->comment('手机');
            $table->string('qq',20)->default('')->comment('qq');
            $table->string('email')->unique()->default('')->comment('邮箱');
            $table->string('realname')->default('')->comment('真实姓名');
            $table->integer('birthday')->default(0)->comment('生日');
            $table->integer('avatar')->default(0)->comment('头像');
            $table->tinyInteger('sex')->default(0)->comment('0 保密 1 男 2 女');
            $table->string('description',191)->default('')->comment('个人描述');

            $table->integer('score')->default(0)->comment('用户积分');
            $table->integer('recommend_uid')->default(0)->comment('推荐人会员ID');
            $table->decimal('money',10,2)->default(0)->comment('金额');
            $table->decimal('frozen_money',10,2)->default(0)->comment('冻结金额');
            $table->string('register_ip',20)->default('')->comment('注册IP');
            $table->integer('login_num')->default(0)->comment('登录次数');
            $table->string('last_time',15)->default('')->comment('最后登录时间');
            $table->string('last_ip',15)->default('')->comment('最后登录ip');
            $table->boolean('is_vip')->default(0)->comment('是否为VIP ：0不是，1是');
            $table->boolean('is_lock')->default(0)->comment('是否锁定。0否，1是');
            $table->boolean('actived')->default(true)->comment('是否激活，0否，1是');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1启用');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('members_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->default(null)->comment('会员ID');
            $table->integer('num_store_pic')->default(0)->comment('图片存储数量500');
            $table->integer('num_upload_pic')->default(0)->comment('图片上传数量，140每月');
            $table->integer('num_fav_style')->default(0)->comment('收藏样式数量100');
            $table->integer('num_fav_tpl')->default(0)->comment('收藏模板数量100');
            $table->integer('num_fav_color')->default(0)->comment('收藏配色数量50');
            $table->integer('num_fav_video')->default(0)->comment('收藏视频数量50');
            $table->integer('num_fav_gif')->default(0)->comment('收藏动图数量50');
            $table->integer('num_save_art')->default(0)->comment('保存文章数量50');
            $table->integer('num_save_style')->default(0)->comment('保存样式数量');
            $table->integer('num_save_tpl')->default(0)->comment('保存模板数量100');
            $table->integer('num_save_sign')->default(0)->comment('保存签名数量5');
            $table->integer('num_craw_art')->default(0)->comment('文章采集数量，50每月');
            $table->integer('num_art_turn_pic')->default(0)->comment('文章转长图数量，50每月');
            $table->integer('num_bind_wx_public')->default(0)->comment('绑定公众号数量1');
            $table->integer('start_time')->default(0)->comment('开始时间');
            $table->integer('end_time')->default(0)->comment('结束时间');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('members_feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->default(null)->comment('会员ID');
            $table->string('type')->default('')->comment('类型');
            $table->text('content')->comment('留言内容');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1正常');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('members_message', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id_from')->default(null)->comment('接收会员ID');
            $table->integer('member_id_to')->default(null)->comment('发送会员ID');
            $table->integer('type')->default(null)->comment('消息类型');
            $table->text('content')->comment('消息内容');
            $table->string('ip',15)->default('')->comment('发送ip');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1正常');
            $table->timestamps();
        });
        Schema::create('members_drafts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->default(null)->comment('会员ID');
            $table->text('content')->comment('消息内容');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1正常');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('members_level', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->comment('等级名称');
            $table->string('description')->default('')->comment('描述');
            $table->integer('num_store_pic')->default(0)->comment('图片存储数量500');
            $table->integer('num_upload_pic')->default(0)->comment('图片上传数量，140每月');
            $table->integer('num_fav_style')->default(0)->comment('收藏样式数量100');
            $table->integer('num_fav_tpl')->default(0)->comment('收藏模板数量100');
            $table->integer('num_fav_color')->default(0)->comment('收藏配色数量50');
            $table->integer('num_fav_video')->default(0)->comment('收藏视频数量50');
            $table->integer('num_fav_gif')->default(0)->comment('收藏动图数量50');
            $table->integer('num_save_art')->default(0)->comment('保存文章数量50');
            $table->integer('num_save_style')->default(0)->comment('保存样式数量100');
            $table->integer('num_save_tpl')->default(0)->comment('保存模板数量100');
            $table->integer('num_save_sign')->default(0)->comment('保存签名数量5');
            $table->integer('num_craw_art')->default(0)->comment('文章采集数量，50每月');
            $table->integer('num_art_turn_pic')->default(0)->comment('文章转长图数量，50每月');
            $table->integer('num_bind_wx_public')->default(0)->comment('绑定公众号数量1');
            $table->tinyInteger('sort')->default(99)->comment('排序，值越小越靠前');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1启用');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('members_login', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->default(null)->comment('会员ID');
            $table->tinyInteger('log_type')->default(true)->comment('登录方式');
            $table->string('log_agent')->default('')->comment('客户端Agent信息');
            $table->string('log_ip',15)->default('')->comment('客户端ip');
            $table->string('log_address')->default('')->comment('客户端ip地理位置');
            $table->string('log_remark',15)->default('')->comment('描述');
            $table->tinyInteger('log_status')->default(true)->comment('状态，0失败，1成功');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('members_fav', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->default(null)->comment('会员ID');
            $table->string('model_type')->default('')->comment('收藏类型');
            $table->integer('model_id')->default(null)->comment('收藏ID');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1正常');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('members_pic', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('model_id');
            $table->string('model_type');
            $table->string('collection_name');
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->string('disk');
            $table->unsignedInteger('size');
            $table->json('manipulations');
            $table->json('custom_properties');
            $table->unsignedInteger('order_column')->nullable();
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1启用');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('members_integral', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->default(null)->comment('会员ID');
            $table->integer('user_score')->default(0)->comment('用户积分');
            $table->integer('log_no')->default(null)->comment('订单编号');
            $table->string('log_name')->default('')->comment('商品名称');
            $table->string('log_ip',15)->default('')->comment('登录ip');
            $table->integer('log_score')->default(0)->comment('变动积分');
            $table->tinyInteger('log_status')->default(true)->comment('状态，0失败，1成功');
            $table->timestamps();
        });
        Schema::create('members_recharge', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->default(null)->comment('会员ID');
            $table->decimal('user_money',10,2)->default(0)->comment('用户金额');
            $table->decimal('log_money',10,2)->default(0)->comment('变动金额：收入用正数，支出用负数');
            $table->tinyInteger('log_type')->default(0)->comment('动作事件：充值、支出、购买等等');
            $table->integer('log_no')->default(null)->comment('订单编号');
            $table->string('log_name')->default('')->comment('商品名称');
            $table->string('log_ip',15)->default('')->comment('操作IP');
            $table->string('log_remark',191)->comment('备注');
            $table->tinyInteger('log_status')->default(true)->comment('状态，0失败，1成功');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('members_save_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->default(null)->comment('会员ID');
            $table->text('content')->comment('内容');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1正常');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('members_save_art', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->default(null)->comment('会员ID');
            $table->string('title')->comment('标题');
            $table->integer('thumb')->comment('封面图');
            $table->tinyInteger('is_thumb')->comment('正文中显示封面图');
            $table->text('content')->comment('内容');
            $table->string('author')->comment('作者');
            $table->string('original_link')->comment('原文链接');
            $table->string('excerpt')->comment('图文摘要');
            $table->tinyInteger('audit')->default(false)->comment('审核，0待审核，1已审核，2未通过，9驳回');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1正常');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('members_works', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->integer('model_id');
            $table->string('model_type');
            $table->string('ip',15)->default('')->comment('发送ip');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1正常');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('members_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->default(null)->comment('会员ID');
            $table->integer('no')->default(null)->comment('订单编号');
            $table->string('name')->default('')->comment('商品名称');
            $table->decimal('price')->comment('价格');
            $table->integer('num')->default(null)->comment('数量');
            $table->integer('total')->default(null)->comment('合计');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1正常');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
        Schema::dropIfExists('members_info');
        Schema::dropIfExists('members_feedback');
        Schema::dropIfExists('members_message');
        Schema::dropIfExists('members_drafts');
        Schema::dropIfExists('members_level');
        Schema::dropIfExists('members_login');
        Schema::dropIfExists('members_fav');
        Schema::dropIfExists('members_pic');
        Schema::dropIfExists('members_integral');
        Schema::dropIfExists('members_recharge');
        Schema::dropIfExists('members_save_style');
        Schema::dropIfExists('members_save_art');
        Schema::dropIfExists('members_save_tpl');
        Schema::dropIfExists('members_works');
        Schema::dropIfExists('members_orders');
    }
}
