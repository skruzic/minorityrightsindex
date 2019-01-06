<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\QuestionType;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('lft')->unsigned();
            $table->integer('rgt')->unsigned();
            $table->integer('depth')->unsigned();
            $table->string('title')->nullable();
            $table->tinyInteger('type')->unsigned()->default(QuestionType::TEXT);
            //$table->text('question');
            $table->mediumText('question');
            $table->integer('option_group_id')->unsigned()->nullable();
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
        Schema::dropIfExists('questions');
    }
}
