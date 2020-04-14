<?php


namespace App\Admin\Models;


class Supplier extends Model
{

    public function updateSupplierStatus($supplierId, $status)
    {
        return $this->update(['status' => $status])->where(['id', $supplierId]);
    }
}
