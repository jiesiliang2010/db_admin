<?php

namespace App\Admin\Models;

//软删除模型
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class OrderDetail extends BaseModel
{
    protected $table = 'cbd_order_detail';

    public $cacheVersion = 'v11';


    public function salesman(){
        return $this->belongsTo(\App\Admin\Models\Salesman::class, 'cbd_salesman', 'guide_id', 'id');
    }


    public function fetchListByOrderId($orderId)
    {
        return $this->when($orderId, function ($query, $orderId) {
            return $this
                ->where('order_id', $orderId)
                ->orderBy('shop_id', 'asc')
                ->orderBy('id', 'asc')
                ->get() ?: collect();
        }, function () {
            return collect();
        });
    }
}
