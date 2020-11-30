<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('theme');
            $table->text('description');
            $table->string('username');
            $table->string('email');
            $table->timestamp('detection_date')->nullable();
            $table->string('solution_time')->nullable()->default(null);
            $table->integer('status')->unsigned()->default(1);
            $table->foreign('status')
                ->references('id')
                ->on('statuses');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
            $table->integer('solution_id')->unsigned()->nullable();
            $table->foreign('solution_id')
                ->references('id')
                ->on('solutions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problems');
    }
}
