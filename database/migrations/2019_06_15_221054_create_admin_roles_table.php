<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->string('name', 20)->comment('角色（岗位）名称');
            $table->string('slug', 20)->comment('角色（岗位）标识');
            $table->integer('department_id', false, true)->comment('部门ID');
            $table->index(['department_id', 'id'], 'idx_role_department');
            $table->integer('update_time', false, true)->default(0)->nullable(false)->comment('更新时间');
            $table->integer('create_time', false, true)->default(0)->nullable(false)->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_roles');
    }
}
