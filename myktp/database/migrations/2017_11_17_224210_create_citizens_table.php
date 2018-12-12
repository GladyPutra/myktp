<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitizensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_citizens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname');
            $table->string('nik',20);
            $table->string('gender',10);
            $table->string('place_of_birth');
            $table->date('birth_date');
            $table->string('type_blood', 2)->default('-');
            $table->string('address');
            $table->string('job');
            $table->string('the_status',12);
            $table->string('state', 3)->default('WNI');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citizens');
    }
}
