<?php


namespace App\Admin\Controllers\Order;


use App\Admin\Controllers\Controller;

class TransLogController extends Controller
{
    public function showList(){
        return $this->ok([
            ['id' =>  '1',
            'company' => '圆通',
            'no' => 'u987f9a79',
            'info' => [
                [
                    'content' => '快递公司开始揽收',
                    'timestamp' => '2018-04-11',
                ],
                [
                    'content' => '快递到达【上海市】虹口区',
                    'timestamp' => '2018-04-13',
                ],
            ]],
        ]);
    }
}
