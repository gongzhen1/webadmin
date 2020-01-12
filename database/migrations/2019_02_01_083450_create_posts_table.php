<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('slug_id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->integer('author_id')->nullable();//编辑
            $table->string('source')->nullable();//文章来源
            $table->string('source_link',256)->nullable();//来源网址
            $table->text('summary',2048)->nullable();
            $table->text('content',100000)->nullable();
            $table->string('status')->default('1-not-publish');
            $table->float('order')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
