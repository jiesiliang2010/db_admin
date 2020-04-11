<?php

namespace App\Admin\Models;

class AdminRole extends Model
{
    protected $fillable = ['name', 'slug'];

    public function permissions()
    {
        return $this->belongsToMany(
            AdminPermission::class,
            'admin_role_permission',
            'role_id',
            'permission_id'
        );
    }

    public function departments()
    {
        return $this->belongsToMany(
            AdminDepartment::class,
            'admin_role_department',
            'role_id',
            'department_id'
        );
    }

    public function department()
    {
        return $this->hasOne(AdminDepartment::class, 'id', 'department_id');
    }

    public function delete()
    {
        $this->permissions()->detach();
        $this->departments()->detach();
        return parent::delete();
    }
}
