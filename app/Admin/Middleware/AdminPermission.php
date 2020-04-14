<?php

namespace App\Admin\Middleware;

use App\Admin\Contracts\PermissionMiddleware;

class AdminPermission extends PermissionMiddleware
{
    protected $urlWhitelist = [
        '/auth/login',
        '/auth/logout',
        '/user',
        '/user/edit',
        '/configs/vue-routers',
        '/configs/system_basic/values',
        '/index', //首页给所有人
        '/order/detail/*',
    ];
}
