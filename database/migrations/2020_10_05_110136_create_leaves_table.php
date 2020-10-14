<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('letter_number')->nullable();
            $table->integer('number_of_days');
            $table->enum('kind_of_leave', ['Cuti Tahunan', 'Cuti Besar', 'Cuti Sakit', 'Cuti Melahirkan', 'Cuti Karena Alasan Penting', 'Cuti di Luar Tanggungan Negara']);
            $table->enum('status_boss', ['Disetujui', 'Tidak disetujui', 'Perubahan', 'Ditangguhkan'])->nullable();
            $table->enum('status_leader', ['Disetujui', 'Tidak disetujui', 'Perubahan', 'Ditangguhkan'])->nullable();
            $table->date('from_date');
            $table->date('to_date');
            $table->string('address');
            $table->string('reason');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
}
