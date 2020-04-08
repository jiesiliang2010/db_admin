<?php

namespace App\Admin\Filters;

class CbdOrderFilter extends Filter
{
    protected $simpleFilters = [
        'order_no' => ['like', '?%'],
        'user_id' => ['like', '?%'],
        'phone' => ['like', '?%'],
        'receiver' => ['like', '?%'],
    ];
}
