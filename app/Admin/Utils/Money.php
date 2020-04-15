<?php


namespace App\Admin\Utils;


class Money
{
    public static function Calc($n1, $symbol, $n2, $scale = '2')
    {
        $res = "";
        switch ($symbol) {
            case "+"://加法
                $res = bcadd($n1, $n2, $scale);
                break;
            case "-"://减法
                $res = bcsub($n1, $n2, $scale);
                break;
            case "*"://乘法
                $res = bcmul($n1, $n2, $scale);
                break;
            case "/"://除法
                $res = bcdiv($n1, $n2, $scale);
                break;
            case "%"://求余、取模
                $res = bcmod($n1, $n2, $scale);
                break;
            default:
                $res = "";
                break;
        }
        return $res;
    }

    /**
     * 相加
     * @param mixed ...$args
     * @return mixed
     */
    public static function add(...$args)
    {
        return array_reduce($args, function ($slack, $arg) {
            return bcadd($slack, $arg, 2);
        }, 0);
    }

    /**
     * 相乘
     * @param mixed ...$args
     * @return mixed
     */
    public static function mul(...$args)
    {
        return array_reduce($args, function ($slack, $arg) {
            return bcmul($slack, $arg, 2);
        }, 1);
    }


    /**
     * 价格由元转分(用于微信支付单位转换)
     * @param $price 金额
     * @return int
     */
    public static function Up($price)
    {
        $price = intval(self::Calc(100, "*", $price));
        return $price;
    }

    /**
     * 价格由分转元
     * @param $price 金额
     * @return float
     */
    public static function Low($price)
    {
        $price = self::Calc(self::priceformat($price), "/", 100);
        return $price;
    }

    /**
     * 价格格式化
     *
     * @param int $price
     * @return string    $price_format
     */
    public static function Priceformat($price)
    {
        $price_format = number_format($price, 2, '.', '');
        return $price_format;
    }
}
