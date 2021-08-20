<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('reputation')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verify_token')->nullable();
            $table->boolean('verified')->default(False);
            $table->boolean('block')->default(False);
            $table->boolean('admin')->default(False);
            $table->string('photo_path')->default('https://www.gravatar.com/avatar/392f4893a64a4929c2ab2b78dba4421a.jpg?s=150&d=mp');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
