<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->char('code')->uniqid();
            $table->char('name');
            $table->char('age');
            $table->char('phone');
            $table->bigInteger('city_id')->nullable();
            $table->char('address');
            $table->boolean('gender');
            $table->char('password');
            $table->text('note')->nullable();
            $table->boolean('easy')->defult(0);
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
        Schema::dropIfExists('patients');
    }
}
