<?php

namespace App\Admin\Models;

use Illuminate\Support\Facades\DB;

class AdminDepartment extends Model
{
    protected $fillable = ['name'];

    public static function departmentByUserId($userId)
    {
        return DB::table('admin_role_department as ard')
            ->join('admin_user_role as user_role', 'user_role.role_id', '=', 'ard.role_id')
            ->join('admin_departments as department', 'ard.department_id', '=', 'department.id')
            ->where('user_role.user_id', '=', $userId)
            ->first(['department.id as department_id', 'department.name as department_name'])
            ;
    }

    public function roles()
    {
        return $this->belongsToMany(
            AdminRole::class,
            'admin_role_department',
            'role_id',
            'department_id'
        );
    }
}
