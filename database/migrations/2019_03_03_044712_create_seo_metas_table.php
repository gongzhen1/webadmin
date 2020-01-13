<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('title')->nullable();
            $table->string('keywords',1024)->nullable();
            $table->string('description',1024)->nullable();
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
        Schema::dropIfExists('seo_metas');
    }
}
