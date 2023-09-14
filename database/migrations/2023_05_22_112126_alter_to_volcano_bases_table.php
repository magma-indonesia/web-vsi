<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('volcano_bases', function (Blueprint $table) {
            $table->text('intro')->nullable();
            $table->text('history')->nullable();
            $table->text('geology')->nullable();
            $table->text('geophysic')->nullable();
            $table->text('geochemistry')->nullable();
            $table->text('disaster_area')->nullable();
            $table->text('reference')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('volcano_bases', function (Blueprint $table) {
            //
        });
    }
};
