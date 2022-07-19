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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->char('employee_id', 10)->nullable()->unique();
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->char('nip', 18)->nullable()->unique();
            $table->char('ktp', 16)->nullable()->unique();
            $table->char('phone', 14)->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('email_esdm')->nullable()->unique();
            $table->string('password');
            $table->boolean('is_active')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
