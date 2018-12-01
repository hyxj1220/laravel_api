<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('own_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });
        
        Schema::create('own_permission', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });
        
        Schema::create('own_permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            
            $table->foreign('permission_id')->references('id')->on('own_permission')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('own_roles')->onDelete('cascade');
            $table->primary(['permission_id', 'role_id']);
        });
        
        Schema::create('own_role_user', function (Blueprint $table) {
            $table->integer('uid')->unsigned();
            $table->integer('role_id')->unsigned();
            
            $table->foreign('uid')->references('id')->on('own_user')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('own_roles')->onDelete('cascade');
            $table->primary(['uid', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
