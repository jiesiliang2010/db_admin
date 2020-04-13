<?php


namespace App\Admin\Controllers\Order;


use App\Admin\Controllers\Controller;

class OrderLogController extends Controller
{
    public function showList()
    {
        return $this->ok([[
            'date' => '2016-05-02',
            'content' => '用户来电号码为xxx',
            'remark' => '上海市普陀区金沙江路 1518 弄',
            'people' => '王小虎',
        ]]);
    }
}
