<?php


namespace App\Admin\Controllers\Order;


use App\Admin\Controllers\Controller;
use App\Admin\Models\OrderCompensate;
use App\Admin\Models\RefundReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Admin\Modules\OrderDetail as Order;
class OrderDetailController extends Controller
{
    public function show(Order $order){
        $orderDetail = $order->fetchOrderDetailByOrderId(2);
        return $this->ok($orderDetail);
    }
    public function getOrderSupplier(Request $request)
    {
        $order_id = $request->input('order_id');
        $supplierInfo = DB::table('order_detail as od')
                ->join('supplier as supplier', 'od.supplier_id', '=', 'supplier.supplier_id')
                ->where(['od.order_id' => $order_id,])
                ->select('supplier.supplier_id', 'supplier.supplier_name')
                ->distinct('supplier.supplier_id')
                ->get();
        return $this->ok($supplierInfo);
    }
    public function getOrderSupplierShops(Request $request)
    {
        $order_id = $request->input('order_id');
        $supplier_id = $request->input('supplier_id');
        $supplierInfo = DB::table('cbd_order_detail as od')
            ->join('cbd_shop as shop', 'shop.shop_id', '=', 'od.shop_id')
            ->where(['od.order_id' => $order_id,'od.supplier_id' => $supplier_id])
            ->select('shop.shop_id', 'shop.shop_name')
            ->distinct('od.shop_id')
            ->get();
        return $this->ok($supplierInfo);
    }
    /**
     * @desc 获取赔款原因
     */
    public function getCompensateReason()
    {
         $refundReason = RefundReason::all();
         return $this->ok($refundReason);
    }
    /**
     * @desc execute order compensate action
     */
    public function doOrderCompensate(Request $request)
    {
        $compensateData = $request->all();
        $refundReason = RefundReason::all()->keyBy('reason_id');
        $compensateModel = new OrderCompensate();
        $compensateModel->timestamps = false;
        $compensateModel->supplier_id = $compensateData['supplier_id'];
        $compensateModel->shop_id = $compensateData['shop_id'];
        $compensateModel->reason_id = $compensateData['reason_id'];
        $compensateModel->reason = $refundReason[$compensateData['reason_id']]['reason'];
        $compensateModel->compensate_amount = $compensateData['compensate_amount'];
        $compensateModel->compensate_object_id = $compensateData['compenate_object'];
        $compensateModel->compensate_object = self::compensateObject[$compensateData['compenate_object']];
        $compensateModel->compensate_describe = $compensateData['compensate_describe'];
        $compensateModel->order_id = $compensateData['order_id'];
        $compensateModel->audit_state = $compensateData['audit_state'];
        $compensateModel->create_time = time();
        $compensateModel->save();
        return $this->ok([]);
    }
}
