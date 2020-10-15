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
            $table->id();
            $table->integer('campaign_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable()->default(0);
            $table->integer('lft')->unsigned()->default(0);
            $table->integer('rgt')->unsigned()->default(0);
            $table->integer('depth')->unsigned()->default(0);
            $table->string('code')->nullable();
            $table->tinyInteger('type')->unsigned()->default(QuestionType::Text);
            $table->mediumText('text');
            $table->mediumText('conditions')->nullable();
            $table->text('extras')->nullable();
            $table->foreignId('option_group_id')->nullable();
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
