<?php


namespace App\Admin\Consts;


final class Order
{

    /********************************订单类型*****************************************/

    /**
     * 虚拟订单
     */
    CONST ORDER_TYPE_VIRTUAL = 1;

    /**
     * 实物订单
     */
    CONST ORDER_TYPE_ENTITY = 0;


    /********************************订单类型*****************************************/


    /********************************配送类型*****************************************/

    /**
     * 送货上门
     */
    CONST ORDER_TRANS_TYPE_SEND = 0;

    /**
     * 自提
     */
    CONST ORDER_TRANS_TYPE_STATION = 1;

    /*********************************配送类型****************************************/


    /********************************订单状态*****************************************/

    /**
     * 新订单待支付
     */
    CONST ORDER_STATE_WAITPAY = 0;

    /**
     * 已支付待发货
     */
    CONST ORDER_STATE_PAYED = 1;

    /**
     * 已发货待收货
     */
    CONST ORDER_STATE_SENDED = 2;


    /**
     * 已收货
     */
    CONST ORDER_STATE_ARRIVED = 3;


    /**
     * 已完成
     */
    CONST ORDER_STATE_FINISHED = 4;


    /**
     * 退货中
     */
    CONST ORDER_STATE_RECHAGING = 5;


    /**
     * 退款
     */
    CONST ORDER_STATE_REFUNDING = 6;


    /**
     * 已取消
     */
    CONST ORDER_STATE_CANCELED = 7;

    /********************************订单状态*****************************************/


    /**
     * 订单状态 订单状态 0 新订单待支付 1 已支付待发货 2 已发货待收货 3 已收货 4 已完成 5 退货中 6 退款 7 已取消
     * @param $orderState
     * @return array|mixed|string
     */
    public static function getOrderState($orderState)
    {
        $orderArr = [
            static::ORDER_STATE_WAITPAY => '订单待支付',
            static::ORDER_STATE_PAYED => '待发货',
            static::ORDER_STATE_SENDED => '已发货',
            static::ORDER_STATE_ARRIVED => '已收货',
            static::ORDER_STATE_FINISHED => '已完成',
            static::ORDER_STATE_RECHAGING => '退货中',
            static::ORDER_STATE_REFUNDING => '退款',
            static::ORDER_STATE_CANCELED => '已取消',
        ];

        return is_null($orderState) ? $orderArr : (isset($orderArr[$orderState]) ? $orderArr[$orderState] : '');
    }


    /**
     * 订单类型
     * @param null $orderType
     * @return array|mixed|string
     */
    public static function getOrderType($orderType = null)
    {
        $orderTypeArr = [
            static::ORDER_TYPE_ENTITY => '实物订单',
            static::ORDER_TYPE_VIRTUAL => '虚拟订单',
        ];

        return is_null($orderType) ? $orderTypeArr : (isset($orderTypeArr[$orderType]) ? $orderTypeArr[$orderType] : '');
    }


    /**
     * 配送类型
     * @param $transType
     * @return array|mixed|string
     */
    public static function getOrderTransType($transType)
    {
        $orderArr = [
            static::ORDER_TRANS_TYPE_SEND => '快递发货',
            static::ORDER_TRANS_TYPE_STATION => '用户自提',
        ];

        return is_null($transType) ? $orderArr : (isset($orderArr[$transType]) ? $orderArr[$transType] : '');
    }
}
