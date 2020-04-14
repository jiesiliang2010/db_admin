<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAdminRoleDepartment extends Migration
{

    /**
     * Run the migrations.
     * 用户岗位与所属部门关联表
     * @return void
     */
    public function up()
    {
        Schema::create('table_admin_role_department', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table
                ->integer('role_id', false, true)
                ->nullable(false)
                ->default(null)
                ->comment('角色（岗位）ID');
            $table
                ->integer('department_id', false, true)
                ->nullable(false)
                ->default(null)
                ->comment('部门ID');
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
            $table->index('role_id', 'idx_admin_role_id');
            $table->index('department_id', 'idx_admin_role_department_id');
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
        Schema::dropIfExists('table_admin_role_department');
    }
}
