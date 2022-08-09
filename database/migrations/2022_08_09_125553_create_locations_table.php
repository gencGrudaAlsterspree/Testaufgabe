<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->uuid();
            $table->string('name');
            $table->string('district');
            $table->string('state');
            //lat + long can be stored as json
            //$table->jsonb('coords');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('population');
            $table->unsignedFloat('area');
            $table->softDeletes();
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
        Schema::dropIfExists('locations');
    }
};