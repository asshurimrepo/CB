<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdToPreamdesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('premades', function (Blueprint $table) {
            $table->integer('category_id')->after('filename');
            $table->text('actions')->after('filename');
            $table->text('options')->after('filename');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('premades', function (Blueprint $table) {
            $table->dropColumn('category_id');
            $table->dropColumn('actions');
            $table->dropColumn('options');
        });
    }
}
