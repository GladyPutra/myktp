<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailCitizensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_detail_citizens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_citizen');
            $table->mediumtext('matrix_linear_image');
            $table->mediumtext('eigen_vector');
            $table->mediumtext('mean_flat_vector');
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
        Schema::dropIfExists('detail_citizens');
    }
}
