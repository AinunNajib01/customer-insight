<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TB_FILES', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200);
            $table->string('filepath', 200);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('rowstatus')->default(1);
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
        Schema::dropIfExists('TB_FILES');
    }
}
