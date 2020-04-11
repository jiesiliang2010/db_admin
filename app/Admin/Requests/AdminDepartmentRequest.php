<?php

namespace App\Admin\Requests;

use Illuminate\Support\Arr;

class AdminDepartmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = (int) optional($this->route('admin_department'))->id;
        $rules = [
            'name' => 'required|unique:admin_roles,name,'.$id,
        ];
        if ($this->isMethod('put')) {
            $rules = Arr::only($rules, $this->keys());
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => '部门名称'
        ];
    }
}
