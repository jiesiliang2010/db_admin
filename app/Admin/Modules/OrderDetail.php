<?php

namespace App\Admin\Modules;

use App\Admin\Models\Order;
use App\Admin\Models\OrderDetail as OrderDetailModel;
use App\Admin\Facades\ModelCacheFace;
use App\Admin\Models\Shop;
use App\Admin\Models\Salesman;
use App\Admin\Utils\Money;
use Carbon\Carbon;
use App\Admin\Consts\Order as OrderAlias;

class OrderDetail
{
    /**
     * 订单详情
     * @param $orderId
     * @return array
     */
    public function fetchOrderDetailByOrderId($orderId)
    {
        //主订单信息
        $order = tap((new Order)->fetchOrderInfoById($orderId), function (&$order) {
            if (!($order = collect($order))->isEmpty()) {
//                $order['create_date'] = $order['create_time'] ? Carbon::createFromTimestamp($order['create_time'])->toDateTimeString() : '';
                $order['create_date'] = $order['create_time'];
                $order['show_total_money'] = 0;
                $order['shop_total_money'] = 0;
                $order['guide_total_money'] = 0;
                $order['receiver_address'] = implode(' ', [$order['province_name'], $order['city_name'], $order['district_name'], $order['address']]);
                $order['order_type_alias'] = OrderAlias::getOrderType($order['order_type']);
                $order['order_trans_type_alias'] = OrderAlias::getOrderType($order['trans_type']);
            }
        });

        //订单商品规格信息
        $orderDtailList = collect((new OrderDetailModel)->cacheTap(600)->fetchListByOrderId($order->offsetExists('id') ? $order['id'] : 0));
        if (($shopIds = $orderDtailList->pluck('shop_id')->unique())->isNotEmpty()) {
            //店铺商户信息
            $shopList = collect((new Shop)->cacheTap(3600)
                ->fetchListByShopIds($shopIds->toArray())
            )->keyBy('shop_id');

            //导购信息
            $guideList = collect((new Salesman)->cacheTap(3600)
                ->fetchListByGuideIds($orderDtailList->pluck('guide_id')->unique()->toArray() ?: 0)
            )->keyBy('id');

            $orderDtailList = $orderDtailList->map(function ($detail, $k) use ($guideList, $order) {
                $order['show_total_money'] = Money::add($order['show_total_money'], Money::mul($detail['price'], $detail['num']));
                $order['shop_total_money'] = Money::add($order['shop_total_money'], $detail['supplier_amount']);
                $order['guide_total_money'] = Money::add($order['guide_total_money'], $detail['guide_amount']);

                $detail['create_date'] = $detail['create_at'] ? Carbon::createFromTimestamp($detail['create_at'])->toDateTimeString() : '';
                $detail['guide_name'] = $guideList->offsetExists($detail['guide_id']) ? $guideList[$detail['guide_id']]['realname'] : '';
                $detail['guid_nick_name'] = $guideList->offsetExists($detail['guide_id']) ? $guideList[$detail['guide_id']]['nickname'] : '';
                $detail['sale_money'] = Money::Low(Money::mul($detail['price'], $detail['num'])); //销售金额
                $detail['pay_money'] = Money::Low($detail['goods_amount']); //实付金额
                $detail['shop_discount_money'] = Money::Low($detail['shop_discount']); //店铺优惠
                $detail['platform_discount_money'] = Money::Low($detail['platform_discount_amount']); //平台优惠
                $detail['platform_broker_money'] = Money::Low($detail['platform_amount']); //平台佣金
                $detail['shop_clear_money'] = Money::Low($detail['supplier_amount']); //店铺结算价
                $detail['guide_broker_money'] = Money::Low($detail['guide_amount']); //导购佣金
                $detail['order_state_alias'] = OrderAlias::getOrderState($detail['status']);

                return collect($detail)->map(function ($v, $k) {
                    return strval($v);
                });
            })->groupBy('shop_id')->map(function ($shopGoods, $shopId) use ($shopList) {
                $isExistShop = $shopList->offsetExists($shopId);
                return [
                    'shop_id' => $shopId,
                    'shop_name' => $isExistShop ? $shopList[$shopId]['shop_name'] : '',
                    'supplier_name' => $isExistShop ? $shopList[$shopId]['supplier']['supplier_name'] : '',
                    'sub_order_no' => $shopGoods[0]['sub_order_no'],
                    'shop_charge_person' => $isExistShop ? $shopList[$shopId]['charge_person'] : '',
                    'shop_contract' => $isExistShop ? $shopList[$shopId]['contact_phone'] : '',
                    'supplier_id' => $shopList[$shopId]['supplier_id'],
                    'goodList' => $shopGoods,

                ];
            })->values();
        }

        //订单金额聚合
        $order = tap($order, function (&$order) {
            $order['show_total_money'] = Money::Low($order['show_total_money']);
            $order['shop_total_money'] = Money::Low($order['shop_total_money']);
            $order['guide_total_money'] = Money::Low($order['guide_total_money']);
        })->map(function ($v){
            return strval($v);
        });


        return [
            'order' => $order,
            'detailList' => $orderDtailList,
        ];
    }
}
