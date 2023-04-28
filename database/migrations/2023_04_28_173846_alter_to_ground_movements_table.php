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
        Schema::table('ground_movements', function (Blueprint $table) {
            $table->text("thumbnail")->nullable()->after('description');
            $table->boolean("is_highlight")->default(false)->after('thumbnail');
            $table->string("slug")->nullable()->after('is_highlight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ground_movements', function (Blueprint $table) {
            $table->dropColumn('thumbnail');
            $table->dropColumn('is_highlight');
            $table->dropColumn('slug');
        });
    }
};
