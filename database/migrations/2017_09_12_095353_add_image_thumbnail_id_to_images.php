<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageThumbnailIdToImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->integer('image_thumbnail_id')->unsigned();
            $table->foreign('image_thumbnail_id')->references('id')->on('image_thumbnails')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('image_thumbnail_id');
        });
    }
}
