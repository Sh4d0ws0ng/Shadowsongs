<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPersonalInformationToUsers extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::table('users', function($table) {
        $table->text('about_me')->nullable();
        $table->string('firstname')->nullable()->default('');
        $table->string('lastname')->nullable()->default('');
        $table->string('website')->nullable()->default('');
        $table->string('twitter')->nullable()->default('');
        $table->string('facebook')->nullable()->default('');
        $table->string('instagram')->nullable()->default('');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
      Schema::table('users', function($table) {
        $table->dropColumn('about_me');
        $table->dropColumn('firstname');
        $table->dropColumn('lastname');
        $table->dropColumn('website');
        $table->dropColumn('twitter');
        $table->dropColumn('facebook');
        $table->dropColumn('instagram');
      });
    }
}
