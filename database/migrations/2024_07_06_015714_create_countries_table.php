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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('iso', 20);
            $table->string('flag', 200);
            $table->integer('country_code');
            $table->integer('min_phone_number_length');
            $table->integer('max_phone_number_length');
            $table->timestamps();
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
