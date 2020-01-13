<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('tel')->nullable();
            $table->string('company')->nullable();
            $table->text('message')->nullable();
            $table->string('url')->nullable();
            $table->string('ip')->nullable();
            $table->string('browser')->nullable();
            $table->boolean('is_new')->default(true); 
            $table->boolean('is_spam')->default(false);
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
        Schema::dropIfExists('inquiries');
    }
}
