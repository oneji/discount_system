<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname');
            $table->integer('card_number');
            $table->date('birthday')->nullable();
            $table->integer('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('project_name')->nullable();
            $table->string('occupation')->nullable();
            $table->date('work_start_date')->nullable();
            $table->integer('discount_package_id')->unsigned()->nullable();
            $table->integer('active')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();

            $table->foreign('discount_package_id')->references('id')->on('discount_packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
