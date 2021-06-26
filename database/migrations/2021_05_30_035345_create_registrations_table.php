<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_schedule_id');
            $table->unsignedBigInteger('participant_id');
            $table->string('name')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->tinyInteger('is_paid')->default(1);
            $table->tinyInteger('passed_test')->default(1);
            $table->tinyInteger('certificate_progress')->default(1);
            $table->string('proof_transfer')->nullable();
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
        Schema::dropIfExists('registrations');
    }
}
