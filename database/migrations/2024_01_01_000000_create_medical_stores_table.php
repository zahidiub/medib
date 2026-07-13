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
            $table->string('name');
            $table->string('license_no')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->text('bottom_content')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_stores');
    }
}
