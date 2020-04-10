<?php


namespace App\Admin\Models;


class Supplier extends BaseModel
{
    protected $table = 'cbd_supplier';

    protected $primaryKey = 'supplier_id';

    public function shop()
    {
        return $this->hasMany(Shop::class, 'supplier_id', 'supplier_id');
    }

}
