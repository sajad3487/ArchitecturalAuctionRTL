<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id');
            $table->integer('designer_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('description')->nullable();
            $table->string('tags')->nullable();
            $table->integer('vote')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('location_lat')->nullable();
            $table->string('location_long')->nullable();
            $table->date('deadline');
            $table->integer('size');
            $table->integer('net_price');
            $table->integer('total_price');
            $table->string('objective')->nullable();
            $table->integer('status')->default(1);

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
        Schema::dropIfExists('projects');
    }
}
