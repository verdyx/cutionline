<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->enum('gender', ['Laki-Laki', 'Perempuan']);
            $table->string('position');
            $table->string('rank');
            $table->string('birthday');
            $table->string('birthplace');
            $table->enum('blood_types', ['A', 'B', 'O', 'AB']);
            $table->enum('religion', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Kepercayaan Lain']);
            $table->string('work_unit');
            $table->string('years_of_service');
            $table->string('phone');
            $table->string('address');
            $table->boolean('is_core');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
