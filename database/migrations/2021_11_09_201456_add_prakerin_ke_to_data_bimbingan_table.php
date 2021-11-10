<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrakerinKeToDataBimbinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_bimbingan', function (Blueprint $table) {
            $table->smallInteger('prakerin_ke')->after('mahasiswa_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_bimbingan', function (Blueprint $table) {
            $table->dropColumn('prakerin_ke');
        });
    }
}
