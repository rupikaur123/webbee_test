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

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('movies_seat_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('movie_locations_seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('movie_id');
            $table->unsignedBigInteger('seat_type');
            $table->string('slot')->comment('time for the show');
            $table->decimal('price', 9, 3);
            $table->string('seats_available');
            $table->string('seats_booked');
            $table->string('seat_premium');
            $table->timestamps();

            $table->foreign('location_id')
            ->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('movie_id')
            ->references('id')->on('movies')->onDelete('cascade');

            $table->foreign('seat_type')
            ->references('id')->on('movies_seat_types')->onDelete('cascade');
        });

        Schema::create('movie_bookings_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('movie_locations_seats_id');
            $table->unsignedBigInteger('seat_type');
            $table->string('seat_number');
            $table->decimal('final_price', 9, 3);
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')->on('users')->onDelete('cascade');
            $table->foreign('movie_locations_seats_id')
            ->references('id')->on('movie_locations_seats')->onDelete('cascade');

        });


       // throw new \Exception('implement in coding task 4, you can ignore this exception if you are just running the initial migrations.');
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
