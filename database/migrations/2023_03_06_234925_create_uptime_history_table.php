<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uptime_history', function (Blueprint $table) {
            $table->id();
            $table->string('nama_platform');
            $table->string('persentase_hidup');
            $table->string('persentase_mati');
            $table->date('untuk_tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uptime_history');
    }
};
