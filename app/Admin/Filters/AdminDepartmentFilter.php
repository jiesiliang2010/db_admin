<?php


namespace App\Admin\Filters;


class AdminDepartmentFilter extends Filter
{
    protected $simpleFilters = [
        'id',
        'name' => ['like', '%?%']
    ];
}
