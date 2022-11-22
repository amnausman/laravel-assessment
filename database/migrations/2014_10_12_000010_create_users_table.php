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
            $table->index('role_id');
            $table->unsignedBigInteger('role_id')->comment = 'If user is (admin/user/client) and set its id as foreign key in users table';
            $table->foreign('role_id')
            ->references('id')
            ->on('roles')
            ->onDelete('cascade');//Creates a roles table to describe if user is (admin/user/client) and set its id as foreign key in users table
            $table->string('name')->comment = 'Name of user';
            $table->string('phone')->comment = 'Mobile number of user'; //Data-type is string because we don't have to perform any operations on this numeric number, otherwise i would have assigned Data-type integer
            $table->string('email')->unique()->comment = 'Email of user';
            $table->string('password')->comment = 'Password of user';
            $table->boolean('status')->default(0); //To check if user is Active or not (Conditional, not in assessment requirements)
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->softDeletes(); //Column for deleted_at (Soft Delete trait imported in User Model)
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
