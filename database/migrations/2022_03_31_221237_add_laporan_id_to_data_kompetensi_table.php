<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLaporanIdToDataKompetensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_kompetensi', function (Blueprint $table) {
            $table->renameColumn('mahasiswa_id', 'laporan_id');
            $table->foreign('laporan_id')->on('data_laporan')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_kompetensi', function (Blueprint $table) {
            $table->dropForeign(['laporan_id']);
            $table->renameColumn('laporan_id', 'mahasiswa_id');
        });
    }
}
