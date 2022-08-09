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
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('district')->nullable();
            // would have separated the "state" (new table) but left it because of lack of time
            $table->string('state');
            //lat + long can be stored as json
            //$table->jsonb('coords');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('population');
            $table->unsignedFloat('area')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['name']);
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
