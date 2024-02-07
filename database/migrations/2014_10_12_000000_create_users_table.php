<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            
            $table->string("username")->unique();
            $table->string("password");
            $table->string("role");
            $table->string("user_token")->unique()->nullable();
            $table->string("name");
            $table->string("email")->nullable()->unique();
            $table->string("phone")->nullable();
            $table->string("gender");
            $table->string("photo");
            $table->boolean("status")->default(false);
            $table->timestamp('email_verified_at')->nullable();
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
};
