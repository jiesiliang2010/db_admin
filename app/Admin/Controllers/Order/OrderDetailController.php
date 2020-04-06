<?php


namespace App\Admin\Controllers\Order;


use App\Admin\Controllers\Controller;

class OrderDetailController extends Controller
{
    public function show(){
        return $this->ok(['aa' => 'bb']);
    }
}
