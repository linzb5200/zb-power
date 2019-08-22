<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type')->default('0')->comment('类型');
            $table->string('key')->default('')->comment('字段');
            $table->string('value')->default('')->comment('字段值');
            $table->string('remark')->default('')->comment('备注');
            $table->tinyInteger('sort')->default(99)->comment('排序，值越小越靠前');
            $table->tinyInteger('status')->default(true)->comment('状态，0禁用，1启用');
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
        Schema::dropIfExists('system');
    }
}
