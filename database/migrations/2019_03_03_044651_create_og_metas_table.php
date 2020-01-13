<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOgMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('og_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->integer('media_id')->nullable();
            $table->string('image_width')->nullable();
            $table->string('image_height')->nullable();
            $table->string('site_name')->nullable();
            $table->string('url')->nullable();
            $table->string('videosrc')->nullable();
            $table->string('audiosrc')->nullable();
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
        Schema::dropIfExists('og_metas');
    }
}
