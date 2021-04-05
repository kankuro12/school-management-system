<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('identifier')->default(100);
            $table->integer('type')->default(0);
            $table->unsignedBigInteger('foreign_id');
            $table->text('name');
            $table->text('value');
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
        Schema::dropIfExists('extra_infos');
    }
}
