<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->comment('分类id');
            $table->string('title',200)->comment('标题');
            $table->string('keywords',200)->comment('关键词');
            $table->text('description')->comment('描述');
            $table->text('content')->comment('内容');
            $table->integer('click')->default(0)->comment('点击量');
            $table->string('thumb',200)->nullable()->comment('缩略图');
            $table->timestamps();
        });
        Schema::create('article_cate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20)->comment('名称');
            $table->integer('parent_id')->default(0)->comment('上级ID');
            $table->integer('sort')->default(0)->comment('排序');
            $table->timestamps();
        });
        Schema::create('article_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->comment('资讯ID');
            $table->integer('tag_id')->comment('标签ID');
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
        Schema::dropIfExists('articles');
        Schema::dropIfExists('article_cate');
        Schema::dropIfExists('article_tag');
    }
}
