<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubNameToMedicalStoresTable extends Migration
{
    public function up()
    {
        Schema::table('medical_stores', function (Blueprint $table) {
            $table->string('sub_name')->nullable()->after('name');
        });
    }

    public function down()
    {
        Schema::table('medical_stores', function (Blueprint $table) {
            $table->dropColumn('sub_name');
        });
    }
}
