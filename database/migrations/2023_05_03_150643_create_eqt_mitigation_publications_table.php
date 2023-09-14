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
        Schema::create('eqt_mitigation_publications', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("content")->nullable();
            $table->text("thumbnail")->nullable();
            $table->string("created_by")->nullable();
            $table->text('route')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('eqt_mitigation_publications');
    }
};
