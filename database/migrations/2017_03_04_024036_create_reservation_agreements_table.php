<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signed_agreements', function (Blueprint $table) {
            $table->mediumInteger('reservation');
            $table->integer('signed')->default(0);
            $table->string('link')->nullable();
            
            $table->timestamps();
        });

        Schema::create('reservation_agreements', function (Blueprint $table) {
            $table->mediumInteger('id');
            $table->mediumInteger('enitiy');
            $table->integer('required')->default(1);
            $table->string('link');
            
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
        //
    }
}
