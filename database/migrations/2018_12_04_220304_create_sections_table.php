<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->unsigned()->nullable()->default(0);
            $table->integer('lft')->unsigned()->default(0);
            $table->integer('rgt')->unsigned()->default(0);
            $table->integer('depth')->unsigned()->default(0);
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('campaign_id')->unsigned()->index();
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
        Schema::dropIfExists('sections');
    }
}
