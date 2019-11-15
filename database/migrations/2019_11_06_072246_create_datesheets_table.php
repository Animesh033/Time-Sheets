<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datesheets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('break_hrs')->nullable();
            $table->tinyInteger('break_mins')->nullable();
            $table->tinyInteger('idle_hrs')->nullable();
            $table->tinyInteger('idle_mins')->nullable();
            $table->boolean('leave_status');
            $table->date('sheet_date');
            $table->tinyInteger('total_hrs')->nullable();
            $table->tinyInteger('total_mins')->nullable();
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
        Schema::dropIfExists('datesheets');
    }
}
