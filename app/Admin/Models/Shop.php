<?php


namespace App\Admin\Models;


class Shop extends BaseModel
{
    protected $table = 'shop';

    protected $primaryKey = 'shop_id';

    public function supplier()
    {
        /**
         *多对1 第二个是本表关联外表的字段 第三个是外表的字段
         */
        return $this->belongsTo(\App\Admin\Models\Supplier::class, 'supplier_id', 'supplier_id');
    }


    public function fetchListByShopIds($shopIds)
    {
        return $this
            ->whereIn('shop_id', (array)$shopIds)
            ->with('supplier')
            ->get();
    }
}
