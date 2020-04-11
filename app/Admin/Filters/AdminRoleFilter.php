<?php

namespace App\Admin\Filters;

use App\Admin\Filters\Traits\RolePermissionFilter;

class AdminRoleFilter extends Filter
{
    use RolePermissionFilter;
    protected $simpleFilters = [
        'id',
        'name' => ['like', '%?%'],
        'slug' => ['like', '%?%'],
        'department' => ['like', '%?%'],
    ];
    protected $filters = ['permission_name'];
}
