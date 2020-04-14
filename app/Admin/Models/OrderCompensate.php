<?php

namespace App\Admin\Models;

class OrderCompensate extends Model
{
    protected $table = 'order_compensate';

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
