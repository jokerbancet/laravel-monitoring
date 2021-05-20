<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultToDataLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_laporan', function (Blueprint $table) {
            $table->dropColumn('approve_dosen');
            $table->dropColumn('approve_industri');
            $table->dropColumn('status_laporan');
        });
        Schema::table('data_laporan', function (Blueprint $table) {
            $table->renameColumn('id_data_kompetensi','id_data_bimbingan');
            $table->enum('approve_dosen',['mengamati','mengikuti','terampil','pending'])->default('pending')->after('output');
            $table->enum('approve_industri',['mengamati','mengikuti','terampil','pending'])->default('pending')->after('approve_dosen');
            $table->enum('status_laporan',['approve','rejected','pending'])->default('pending')->after('approve_industri');
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
            $table->renameColumn('id_data_kompetensi','id_data_bimbingan');
            // $table->enum('approve_dosen',['mengamati','mengikuti','terampil','pending'])->default('pending')->after('output');
            // $table->enum('approve_industri',['mengamati','mengikuti','terampil','pending'])->default('pending')->after('approve_dosen');
            // $table->enum('status_laporan',['approve','rejected','pending'])->default('pending')->after('approve_industri');
        });
    }
}
