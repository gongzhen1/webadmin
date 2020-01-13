<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderToPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('order')->nullable();
            $table->string('short_title')->nullable();
            $table->text('summary',1024)->nullable();
            $table->integer('feature_image_id')->nullable();
            $table->integer('page_category_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
             $table->dropColumn(['order']);
             $table->dropColumn(['short_title']);
             $table->dropColumn(['summary']);
             $table->dropColumn(['feature_image_id']);
             $table->dropColumn(['page_category_id']);
        });
    }
}
