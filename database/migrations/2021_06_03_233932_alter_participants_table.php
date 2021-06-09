<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->string('ktp')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('surat_pengantar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Participant', function (Blueprint $table) {
            //
        });
    }
}
