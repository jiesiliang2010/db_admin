<?php


namespace App\Admin\Models;


class Salesman extends BaseModel
{
    protected $table = 'cbd_salesman';


    public function fetchListByGuideIds($guideIds)
    {
        return $this
            ->whereIn('id', (array)$guideIds)
            ->get();
    }
}
