<?php

namespace App\Admin\Modules;

use App\Admin\Models\Order;
use App\Admin\Models\OrderDetail as OrderDetailModel;
use App\Admin\Facades\ModelCacheFace;
use App\Admin\Models\Shop;
use App\Admin\Models\Salesman;
use App\Admin\Utils\Money;
use Carbon\Carbon;

class OrderDetail
{
    public function fetchOrderDetailByOrderId($orderId)
    {
        $order = tap((new Order)->fetchOrderInfoById($orderId), function (&$order) {
            if (!($order = collect($order))->isEmpty()) {
//                $order['create_date'] = $order['create_time'] ? Carbon::createFromTimestamp($order['create_time'])->toDateTimeString() : '';
                $order['create_date'] = $order['create_time'];
                $order['amount'] = Money::Low($order['amount']);
                $order['base_amount'] = Money::Low(11111111);
                $order['receiver_address'] = implode(' ', [$order['province_name'], $order['city_name'], $order['district_name'], $order['address']]);
            }
        });
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

            $orderDtailList = $orderDtailList->map(function ($detail, $k) use ($guideList) {
                $detail['create_date'] = $detail['create_at'] ? Carbon::createFromTimestamp($detail['create_at'])->toDateTimeString() : '';
                $detail['guide_name'] = $guideList->offsetExists($detail['guide_id']) ? $guideList[$detail['guide_id']]['realname'] : '';
                $detail['guid_nick_name'] = $guideList->offsetExists($detail['guide_id']) ? $guideList[$detail['guide_id']]['nickname'] : '';
                return collect($detail)->map(function ($v, $k) {
                    return strval($v);
                });
            })->groupBy('shop_id')->map(function ($shopGoods, $shopId) use ($shopList) {
                $isExistShop = $shopList->offsetExists($shopId);
                return [
                    'shop_name' => $isExistShop ? $shopList[$shopId]['shop_name'] : '',
                    'supplier_name' => $isExistShop ? $shopList[$shopId]['supplier']['supplier_name'] : '',
                    'sub_order_no' => $isExistShop ? $shopList[$shopId]['sub_order_no'] : '',
                    'charge_person' => $isExistShop ? $shopList[$shopId]['charge_person'] : '',
                    'charge_person_phone' => $isExistShop ? $shopList[$shopId]['charge_person_phone'] : '',
                    'guide_nick_name' => $isExistShop ? $shopList[$shopId]['charge_person_phone'] : '',
                    'goodList' => $shopGoods,
                ];
            })->values();
        }
        return [
            'order' => $order,
            'detailList' => $orderDtailList,
        ];
    }
}
