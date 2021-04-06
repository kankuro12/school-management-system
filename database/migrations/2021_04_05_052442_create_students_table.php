<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('current_address');
            $table->text('permanent_address');
            $table->string('phone',12);
            $table->string('gender',10);
            $table->text('image');
            $table->date('dob')->nullable();
            $table->boolean('archived')->default(false);
            $table->string('nationality',30)->default('Nepali');
            $table->integer('nepali_dob')->nullable();
            $table->text('fathername')->nullable();
            $table->text('fatheraddress')->nullable();
            $table->text('fatherphone')->nullable();
            $table->text('mothername')->nullable();
            $table->text('motheraddress')->nullable();
            $table->text('motherphone')->nullable();
            $table->text('gaurdianname')->nullable();
            $table->text('gaurdianaddress')->nullable();
            $table->text('gaurdianphone')->nullable();
            $table->string('religion',20)->nullable();
            $table->string('caste',20)->nullable();
            $table->string('bloodgroup',20)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('level_id');
            $table->foreign('level_id')->references('id')->on('levels');
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections');
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
        Schema::dropIfExists('students');
    }
}
