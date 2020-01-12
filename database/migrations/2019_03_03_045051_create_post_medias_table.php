<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_medias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->integer('media_id');
            $table->string('alt_text')->nullable();
            $table->float('order')->default(0);
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_medias');
    }
}
