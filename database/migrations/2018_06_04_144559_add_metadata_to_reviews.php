<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetadataToReviews extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::table('reviews', function($table) {
        $table->date('release_date')->nullable();
        $table->string('label')->nullable()->default('');
        $table->string('homepage')->nullable()->default('');
        $table->string('spotify')->nullable()->default('');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
      Schema::table('reviews', function($table) {
        $table->dropColumn('release_date');
        $table->dropColumn('label');
        $table->dropColumn('homepage');
        $table->dropColumn('spotify');
      });
    }
}
