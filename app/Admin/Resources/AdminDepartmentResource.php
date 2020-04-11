<?php

namespace App\Admin\Resources;

use App\Admin\Models\AdminDepartment;

class AdminDepartmentResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var AdminDepartment $model */
        $model = $this->resource;
        return [
            'id' => $model->id,
            'name' => $model->name,
            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at,
        ];
    }
}
