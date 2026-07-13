<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalStoresTable extends Migration
{
    public function up()
    {
        Schema::create('medical_stores', function (Blueprint $table) {
            $table->id();
            $table->string('license_number')->unique();
            $table->string('name');
            $table->string('address');
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_stores');
    }
}