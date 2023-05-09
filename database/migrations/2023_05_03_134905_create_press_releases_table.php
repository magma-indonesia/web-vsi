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
        Schema::create('mountains', function (Blueprint $table) {
            $table->id();
            $table->string("ga_code")->nullable();
            $table->string("ga_nama_gapi")->nullable();
            $table->string("ga_kab_gapi")->nullable();
            $table->string("ga_prov_gapi")->nullable();
            $table->string("ga_koter_gapi")->nullable();
            $table->string("ga_elev_gapi")->nullable();
            $table->string("ga_lon_gapi")->nullable();
            $table->string("ga_lat_gapi")->nullable();
            $table->tinyInteger("ga_status")->default(0);
            $table->tinyInteger("has_vona")->default(0);
            $table->text("url")->nullable();
            $table->timestamps();
        });

        Schema::create('press_releases', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("letter_number")->nullable();
            $table->text("content")->nullable();
            $table->text("thumbnail")->nullable();
            $table->string("created_by")->nullable();
            $table->text('route')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });

        Schema::create('press_release_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('press_release_id')->nullable()->constrained('press_releases')->onDelete('cascade')->onUpdate('cascade');
            $table->string('category');
            $table->timestamps();
        });

        Schema::create('press_release_mountains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('press_release_id')->nullable()->constrained('press_releases')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('mountain_id')->nullable()->constrained('mountains')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('press_release_files', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->default(1);
            $table->foreignId('press_release_id')->nullable()->constrained('press_releases')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('file_id')->nullable()->constrained('files')->onDelete('cascade')->onUpdate('cascade');
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
        //
    }
};
