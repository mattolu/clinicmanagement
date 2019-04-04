<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vitals_id')->unsigned();
            $table->bigInteger('doctors_id')->unsigned();
            $table->string('disease');
            $table->string('symptoms');
            $table->string('prescription');
            $table->timestamps();
          
        });
        Schema::table('reports', function (Blueprint $table){
            $table->foreign('vitals_id')
                ->references('id')
                ->on('patients')
                ->onDelete('cascade');
            $table->foreign('doctors_id')
                ->references('id')
                ->on('doctors')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
