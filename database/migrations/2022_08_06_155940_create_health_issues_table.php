<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_issues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('problem_type_id');
            $table->unsignedBigInteger('problem_level_id');
            $table->dateTime('time');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('problem_type_id')->references('id')->on('problem_types')->onDelete('cascade');
            $table->foreign('problem_level_id')->references('id')->on('problem_levels')->onDelete('cascade');
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
        Schema::dropIfExists('health_issues');
    }
}
