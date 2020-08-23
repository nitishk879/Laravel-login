<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('permission_role', function (Blueprint $table) {
//            $table->primary(array('role_id', 'permission_id'));

            $table->id();
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('permission_id');
            $table->timestamps();
            $table->softDeletes();

//            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
//            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permission_role');
    }
}
