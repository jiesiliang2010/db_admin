<?php

namespace App\Admin\Models;

class RefundReason extends Model
{
    protected $table = 'refund_reason';
    protected $fillable = ['reason_id', 'reason'];

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
