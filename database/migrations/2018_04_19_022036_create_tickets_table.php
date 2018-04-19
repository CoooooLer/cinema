<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sId');
            $table->string('username',20);
            $table->string('movie_name',50);
            $table->string('cinema_name',50);
            $table->string('s_start',20);
            $table->string('s_end',20);
            $table->string('s_name',20);
            $table->integer('row');
            $table->integer('column');
            $table->date('date');
            $table->decimal('price');
            $table->string('phone',11);

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
        Schema::dropIfExists('tickets');
    }
}
