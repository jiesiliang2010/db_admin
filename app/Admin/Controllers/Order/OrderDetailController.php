<?php


namespace App\Admin\Controllers\Order;


use App\Admin\Controllers\Controller;
use Illuminate\Http\Request;
class OrderDetailController extends Controller
{
    public function show($id){

        return $this->ok(array($id));
        return $this->ok(['aa' => 'bb']);
    }
}
