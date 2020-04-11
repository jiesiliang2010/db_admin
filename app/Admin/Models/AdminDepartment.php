<?php

namespace App\Admin\Models;

class AdminDepartment extends Model
{
    protected $fillable = ['name'];

    public static function departmentByUserId($userId)
    {
        return self::table('admin_role_department as ard')
            ->join('admin_user_role as user_role', 'user_role.role_id', '=', 'ard.role_id')
            ->where('user_role.user_id', '=', $userId)
            ->first('ard.department_id')
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
