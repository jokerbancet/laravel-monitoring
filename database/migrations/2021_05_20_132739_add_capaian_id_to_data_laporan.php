<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCapaianIdToDataLaporan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_laporan', function (Blueprint $table) {
            $table->integer('capaian_id')->nullable()->unsigned()->after('id_data_bimbingan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_laporan', function (Blueprint $table) {
            $table->dropColumn('capaian_id');
        });
    }
}
