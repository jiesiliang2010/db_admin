<?php


namespace App\Admin\Controllers\Order;


use App\Admin\Controllers\Controller;

use App\Admin\Modules\OrderDetail as Order;
use App\Admin\Requests\OrderDetailRequest;

class OrderDetailController extends Controller
{
    public function show(OrderDetailRequest $request, Order $order){
        $orderDetail = $order->fetchOrderDetailByOrderId(request('order_id'));
        return $this->ok($orderDetail);
    }
}
