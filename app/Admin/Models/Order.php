<?php

namespace App\Admin\Models;
use Carbon\Carbon;
use App\Admin\Utils\Money;
use Illuminate\Support\Collection;
class Order extends BaseModel
{
    protected $table = 'order';
    protected $fillable = ['order_no', 'user_id'];
    public $cacheVersion = 'v6';
    public function configs()
    {
        //return $this->hasMany(Config::class, 'category_id');
    }

    public function delete()
    {
//        $res = parent::delete();
//        $this->configs->each->delete();
//        return $res;
    }

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
