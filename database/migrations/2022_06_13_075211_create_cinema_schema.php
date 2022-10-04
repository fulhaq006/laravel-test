<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /**
    # Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different locations

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up()
    {
        Schema::create('movie', function($table) {
            $table->increments('id');
            $table->string('movie_name');
            $table->timestamps();
        });

        Schema::create('shows', function($table) {
            $table->increments('id');
            $table->string('show_name');
            $table->integer('movie_id')->unsigned()->nullable();
            $table->foreign('movie_id')->references('id')->on('movie');
            $table->timestamps();
        });

        Schema::create('show_times', function($table) {
            $table->increments('id');
            $table->dateTime('show_time');
            $table->integer('show_id')->unsigned()->nullable();
            $table->foreign('show_id')->references('id')->on('shows');
            $table->timestamps();
        });

        Schema::create('show_locations', function($table) {
            $table->increments('id');
            $table->string('show_location');
            $table->integer('show_time_id')->unsigned()->nullable();
            $table->foreign('show_time_id')->references('id')->on('show_time');
            $table->timestamps();
        });

        Schema::create('show_pricing', function($table) {
            $table->increments('id');
            $table->float('show_prince');
            $table->integer('show_id')->unsigned()->nullable();
            $table->foreign('show_id')->references('id')->on('shows');
            $table->timestamps();
        });

        Schema::create('seat_category', function($table) {
            $table->increments('id');
            $table->string('seat_category');
            $table->float('seat_premium');
            $table->timestamps();
        });

        Schema::create('show_seating', function($table) {
            $table->increments('id');
            $table->string('show_seat');
            $table->integer('seat_category_id')->unsigned()->nullable();
            $table->foreign('seat_category_id')->references('id')->on('seat_category');
            $table->timestamps();
        });


        //throw new \Exception('implement in coding task 4, you can ignore this exception if you are just running the initial migrations.');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
