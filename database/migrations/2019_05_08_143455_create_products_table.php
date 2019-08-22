<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->default(0)->comment('用户ID');
            $table->integer('cate_id')->comment('所属分类');
            $table->string('title')->comment('标题');
            $table->string('tag')->default('')->comment('标签');
            $table->integer('points')->default(0)->comment('积分');
            $table->integer('clicks')->default(0)->comment('点击量');
            $table->integer('fav')->default(0)->comment('已被收藏');
            $table->integer('used')->default(0)->comment('已被使用');
            $table->integer('zan')->default(0)->comment('点赞数量');
            $table->integer('download')->default(0)->comment('下载次数');
            $table->integer('thumb')->default(0)->comment('封面图');
            $table->integer('page')->default(0)->comment('页面数量');
            $table->string('attachment')->default('')->comment('上传文件');
            $table->integer('format',20)->default('')->comment('文件格式');
            $table->float('size',10,2)->default('')->comment('文件大小');
            $table->text('content')->comment('内容');
            $table->tinyInteger('sort')->default(99)->comment('排序，值越小越靠前');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1启用');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('products_cate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->string('title')->comment('分类名称');
            $table->string('route')->default('')->comment('路由');
            $table->string('pinyin')->default('')->comment('拼音');
            $table->integer('clicks')->default(0)->comment('点击量');
            $table->tinyInteger('sort')->default(99)->comment('排序，值越小越靠前');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1启用');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('products_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tag')->default('')->comment('标签名称');
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
        Schema::dropIfExists('products');
        Schema::dropIfExists('products_cate');
        Schema::dropIfExists('products_tags');
    }
}
