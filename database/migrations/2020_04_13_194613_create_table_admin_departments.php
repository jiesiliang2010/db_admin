<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAdminDepartments extends Migration
{
    /**
     * Run the migrations.
     * 用户岗位所属部门表
     * @return void
     */
    public function up()
    {
        Schema::create('table_admin_departments', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->increments('id')->comment('部门ID');
            $table->string('name', 20)->nullable(false)->default(null)->comment('部门名称');
            $table
                ->timestamp('updated_at')
                ->useCurrent()
                ->nullable(false)
                ->default(CURRENT_TIMESTAMP)
                ->comment('更新时间');
            $table
                ->timestamp('created_id')
                ->nullable(false)
                ->default(CURRENT_TIMESTAMP)
                ->comment('创建时间')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_admin_departments');
    }
}
