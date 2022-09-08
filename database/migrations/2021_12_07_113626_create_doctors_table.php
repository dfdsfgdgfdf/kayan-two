<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->char('name');
            $table->char('phone')->uniqid();
            $table->char('email');
            $table->char('password');
            $table->text('image');
            $table->text('curriculum');
            $table->bigInteger('specialization_id');
            $table->integer('diagnosis_availability')->default(0);
            $table->boolean('dashboard_availability')->default(0);
            $table->boolean('online_check_ups')->default(0);
            $table->boolean('online_chat')->default(0);
            $table->tinyInteger('status')->default(0);

            $table->float('new_cost')->default(0);
            $table->float('resumption_cost')->default(0);

            $table->rememberToken();
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
        Schema::dropIfExists('doctors');
    }
}
