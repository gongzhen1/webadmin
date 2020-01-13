<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFulltextContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fulltext_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_id');
            $table->string('model_class');
            $table->string('title')->nullable();
            $table->text('content',100000)->nullable();
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
        Schema::dropIfExists('fulltext_contents');
    }
}
