<?php


namespace App\Admin\Requests;


use Illuminate\Foundation\Http\FormRequest;

class OrderDetailRequest extends FormRequest
{
    public function rules()
    {
        $orderId = $this->route()->originalParameters('order_id');
        return [];
    }
}
