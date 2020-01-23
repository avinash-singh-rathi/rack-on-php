<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDobToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('salutation',['Mr', 'Ms', 'Dr', 'Mrs', 'Prof'])->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender',['m', 'f', 't'])->nullable();
            $table->string('image')->nullable();
            $table->string('mobile')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn('salutation');
          $table->dropColumn('dob');
          $table->dropColumn('gender');
          $table->dropColumn('image');
        });
    }
}
