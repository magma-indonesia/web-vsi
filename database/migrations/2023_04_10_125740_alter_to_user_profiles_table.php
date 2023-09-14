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
        Schema::rename('user_pofiles', 'user_profiles');

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string("first_degree", 30)->nullable();
            $table->string("first_name");
            $table->string("last_name")->nullable();
            $table->string("last_degree", 30)->nullable();
            $table->string("institution")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            //
        });
    }
};
