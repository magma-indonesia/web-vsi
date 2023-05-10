<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_services', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->text('title');
            $table->text('description');
            $table->text("thumbnail")->nullable();
            $table->boolean("is_highlight")->default(false);
            $table->text("slug")->nullable();
            $table->foreignId('author_id')->index()->constrained('a_users');
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
        Schema::dropIfExists('public_services');
    }
};
