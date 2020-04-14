<?php

/**
 * 供应商状态机
 * @ author fugui.wang
 * @ date   2020-04-14
 */

namespace App\Admin\Utils;


use App\Admin\Models\Supplier;

class SupplierStatusEngine
{
    //供应商状态定义
    const SUPPLIER_APPLY = 1;   //供应商申请中
    const SUPPLIER_REFUSE = 2;  //供应商审批拒绝
    const SUPPLIER_PASS = 3;    //供应商审批通过

    //当前操作的供应商ID
    private $supplierId = null;

    //当前操作的供应商所处状态
    private $currentSupplierStatus = null;

    //状态变更前置条件
    const PRECONDITION_FOR_CHANGE = [
        self::SUPPLIER_APPLY => [],
        self::SUPPLIER_REFUSE => [self::SUPPLIER_APPLY],
        self::SUPPLIER_PASS => [self::SUPPLIER_APPLY]
    ];

    public function __construct($supplierId)
    {
        $this->supplierId = $supplierId;
        $this->currentSupplierStatus();
    }

    //获取供应商当前状态
    public function currentSupplierStatus()
    {
        $this->currentSupplierStatus = Supplier::query()
            ->where('supplier_id', '=', $this->supplierId)
            ->first('status')
            ->status;
    }

    //通过
    public function pass()
    {
        return $this->updateSupplierStatus(self::SUPPLIER_PASS);
    }

    //拒绝
    public function refuse()
    {
       return $this->updateSupplierStatus(self::SUPPLIER_REFUSE);
    }

    //更新供应商状态
    private function updateSupplierStatus($targetStatus)
    {
        if ($targetStatus == $this->currentSupplierStatus) {
            return true;
        } elseif (!in_array($this->currentSupplierStatus, self::PRECONDITION_FOR_CHANGE[$targetStatus])) {
            return false;
        } else {
            if (
                Supplier::query()
                    ->where('supplier_id', $this->supplierId)
                    ->update(['status' => $targetStatus])
                ===
                false
            ) {
                return false;
            } else {
                return true;
            }
        }
    }

}
