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
            $table->string('cas_no')->nullable();
            $table->string('hscode')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('summary',1024)->nullable();
            $table->text('description',1024000)->nullable();
            $table->text('additional_information',1024000)->nullable();
            $table->string('feature')->nullable();
            $table->string('specs')->nullable();
            $table->string('certification')->nullable();
            $table->string('status')->default('1-not-publish'); 
            $table->string('purity')->nullable();
            $table->string('grade')->nullable();
            $table->string('packaging')->nullable();
            $table->string('capacity')->nullable();
            $table->string('delivery')->nullable();
            $table->string('min_order')->nullable();
            $table->string('order')->nullable();
            $table->integer('view_times')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('author_id')->nullable();//编辑
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
    }
}
