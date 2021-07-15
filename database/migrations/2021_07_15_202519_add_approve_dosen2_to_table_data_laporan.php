<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApproveDosen2ToTableDataLaporan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_laporan', function (Blueprint $table) {
            $table->enum('approve_dosen2',['mengamati','mengikuti','terampil','pending'])->default('pending')->after('approve_dosen');
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
            $table->dropColumn('approve_dosen2');
        });
    }
}
