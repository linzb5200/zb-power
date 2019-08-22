<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from')->default('')->comment('会员类型');
            $table->integer('from_id')->default(null)->comment('会员ID');
            $table->tinyInteger('type')->default('0')->comment('类型');
            $table->string('path')->default('')->comment('图片路径');
            $table->string('name')->default('')->comment('文件全称');
            $table->string('title')->default('')->comment('标题');
            $table->string('md5')->default('')->comment('文件md5加密');
            $table->integer('size')->default(0)->comment('文件大小');
            $table->string('mime_type')->default('')->comment('文件类型');
            $table->string('origin_name')->default('')->comment('原始名');
            $table->string('disk')->default('')->comment('保存磁盘');
            $table->string('remark')->default('')->comment('备注');
            $table->tinyInteger('sort')->default(99)->comment('排序，值越小越靠前');
            $table->tinyInteger('status')->default(0)->comment('状态，0禁用，1启用');
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
        Schema::dropIfExists('medias');
    }
}
