<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeywordsToOgMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('og_metas', function (Blueprint $table) {
            $table->string('keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('og_metas', function (Blueprint $table) {
             $table->dropColumn(['keywords']);
        });
    }
}
