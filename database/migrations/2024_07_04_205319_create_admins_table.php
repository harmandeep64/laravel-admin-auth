<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('username', 200)->unique();
            $table->string('email', 200)->unique();
            $table->string('country_code', 5);
            $table->string('phone_number', 20);
            $table->string('password', 255);
            $table->string('remember_token', 200)->nullable()->default(null);
            $table->timestamps();
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
