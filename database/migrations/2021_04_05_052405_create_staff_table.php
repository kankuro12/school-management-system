<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('address');
            $table->string('phone',12);
            $table->string('post',50);
            $table->string('gender',10);
            $table->text('image');
            $table->integer('salary');
            $table->boolean('archived')->default(false);
            $table->string('nationality',30)->default('Nepali');
            $table->string('acc_no')->nullable();
            $table->text('fathername')->nullable();
            $table->text('mothername')->nullable();
            $table->text('spousename')->nullable();
            $table->text('academic_qualification')->nullable();
            $table->text('professional_qualification')->nullable();
            $table->text('experience')->nullable();
            $table->date('start_date')->nullable();
            $table->date('dob')->nullable();
            $table->string('maritial_status')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('id')->on('schools');
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
        Schema::dropIfExists('staff');
    }
}
