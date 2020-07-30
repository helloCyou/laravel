<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //创建数据库迁移文件   make:migration --create=blogs create_blogs_table
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('content','200');
            $table->integer('user_id')->index();
            // artisan migrate 生成命令
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
