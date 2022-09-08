<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    private $type= [
        'resumption',
        'new'
    ];

    private $status= [
        'pennding',
        'canceled',
        'rejected',
        'finished',
        'accepted'
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->date('date');
            $table->time('time');
            $table->enum('type', $this->type);
            $table->float('cost')->nullable();
            $table->float('discount')->nullable();
            $table->float('final_cost')->nullable();
            $table->bigInteger('patient_id');
            $table->bigInteger('doctor_id');
            $table->enum('status', $this->status);
            $table->boolean('arrive_status')->default(0);
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
        Schema::dropIfExists('books');
    }
}
