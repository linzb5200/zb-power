<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cate_id')->comment('所属分类');
            $table->string('title')->comment('标题');
            $table->integer('clicks')->default(0)->comment('点击量');
            $table->text('content')->comment('内容');
            $table->tinyInteger('sort')->default(99)->comment('排序，值越小越靠前');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1启用');
            $table->timestamps();
        });
        Schema::create('helps_cate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->string('title')->comment('分类名称');
            $table->integer('clicks')->default(0)->comment('点击量');
            $table->tinyInteger('sort')->default(99)->comment('排序，值越小越靠前');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1启用');
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
        Schema::dropIfExists('helps');
        Schema::dropIfExists('helps_cate');
    }
}
