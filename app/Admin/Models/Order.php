<?php

namespace App\Admin\Models;

class Order extends Model
{
    protected $table = 'cbd_order';
    protected $fillable = ['order_no', 'user_id'];

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
}
