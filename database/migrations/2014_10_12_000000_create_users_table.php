<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('name')->unique()->comment('用户名');
            $table->string('email')->unique()->comment('邮箱');
            $table->string('password')->comment('密码');
            $table->string('mobile',20)->default('')->comment('手机');
            $table->string('nickname')->default('')->comment('昵称');
            $table->integer('avatar')->default(0)->comment('头像');
            $table->integer('login_num')->default(0)->comment('登录次数');
            $table->string('last_time',15)->default('')->comment('最后登录时间');
            $table->string('last_ip',15)->default('')->comment('最后登录ip');
            $table->boolean('is_super')->default(false)->comment('超级管理员 1：是 0：否');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1启用');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
