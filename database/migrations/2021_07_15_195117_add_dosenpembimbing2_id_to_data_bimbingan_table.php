<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDosenpembimbing2IdToDataBimbinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_bimbingan', function (Blueprint $table) {
            $table->unsignedBigInteger('dosenpembimbing2_id')->nullable()->after('dosenpembimbing_id');
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
            $table->dropColumn('dosenpembimbing2_id');
        });
    }
}
