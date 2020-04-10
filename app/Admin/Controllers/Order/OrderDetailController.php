<?php


namespace App\Admin\Controllers\Order;


use App\Admin\Controllers\Controller;

use App\Admin\Modules\OrderDetail as Order;

class OrderDetailController extends Controller
{
    public function show(Order $order){
        $orderDetail = $order->fetchOrderDetailByOrderId(2);
        return $this->ok($orderDetail);
    }
}
