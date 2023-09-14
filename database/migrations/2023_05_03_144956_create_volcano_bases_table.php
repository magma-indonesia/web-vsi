<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volcano_bases', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("content")->nullable();
            $table->text("thumbnail")->nullable();
            $table->string("created_by")->nullable();
            $table->text('route')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });

        Schema::create('volcano_base_files', function (Blueprint $table) {
            $table->foreignId('volcano_base_id')->nullable()->constrained('volcano_bases')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('volcano_bases');
        Schema::dropIfExists('volcano_bases_files');
    }
};