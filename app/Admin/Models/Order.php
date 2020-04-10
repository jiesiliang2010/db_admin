<?php

namespace App\Admin\Models;

use Carbon\Carbon;
use App\Admin\Utils\Money;
use Illuminate\Support\Collection;

class Order extends BaseModel
{

    public $cacheVersion = 'v6';

    protected $table = 'cbd_order';

    /**
     * 根据订单id获取主订单信息
     * @notice 缓存穿透走好人策略
     * @param $orderId
     * @return mixed
     */
    public function fetchOrderInfoById($orderId)
    {
        return $this->when($orderId, function ($query, $orderId) {
            return $this->getCache('order:'.$orderId, function () use ($orderId) {
                return $this
                    ->where('id', $orderId)
                    ->first() ?: collect();
            }) ?: collect();
        }, function () {
            return collect();
        });
    }
}
