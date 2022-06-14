<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsReviewLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_review_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_id');
            $table->enum('review_type',['APPROVED','REJECTED','EDITED','PUBLISHED','UNPUBLISHED','DELETED']);
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
        Schema::dropIfExists('questions_review_logs');
    }
}
