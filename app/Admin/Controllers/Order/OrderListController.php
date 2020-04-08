<?php


namespace App\Admin\Controllers\Order;

use App\Admin\Models\Order;
use App\Admin\Filters\CbdOrderFilter;
use App\Admin\Resources\CbdOrderResource;
use Illuminate\Http\Request;
use App\Admin\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class OrderListController extends Controller
{
    public function list(Request $request,CbdOrderFilter $filter){
        //return $this->ok(array($request['order_no']));
        $orderList = Order::query()
            ->filter($filter)
            ->orderByDesc('id');
        if ($request->has('create_at_start') && $request->has('create_at_end')) {
            $createStartTime = strtotime($request->input('create_at_start'));
            $createEndTime = strtotime($request->input('create_at_end'));
            $getResult = $orderList->whereBetween('create_at',array($createStartTime,$createEndTime));
        }else{
            $getResult = $orderList->get();
        }
        $orderResult = $request->input('all')
            ? $getResult
            : $orderList->paginate();

        return $this->ok(CbdOrderResource::collection($orderResult));
    }
}
