<?php


namespace App\Admin\Controllers;


use App\Admin\Filters\AdminDepartmentFilter;
use App\Admin\Models\AdminDepartment;
use App\Admin\Requests\AdminDepartmentRequest;
use App\Admin\Resources\AdminDepartmentResource;
use Illuminate\Http\Request;

class AdminDepartmentController extends Controller
{

    public function index(AdminDepartmentFilter $filter)
    {
        $departments = AdminDepartment::query()
            ->filter($filter)
            ->orderByDesc('id')
            ->paginate();
        return $this->ok(AdminDepartmentResource::collection($departments));
    }

    public function create()
    {
        return $this->noContent();
    }

    public function edit(Request $request, AdminDepartment $adminDepartment)
    {
        $departments = AdminDepartmentResource::make($adminDepartment)->toArray($request);
        return $this->ok(['departments' => $departments]);
    }

    public function update(AdminDepartmentRequest $request, AdminDepartment $adminDepartment)
    {
        $inputs = $request->validated();
        $adminDepartment->update($inputs);
        return $this->created(AdminDepartmentResource::make($adminDepartment));
    }

    public function store(AdminDepartmentRequest $request, AdminDepartment $model)
    {
        $inputs = $request->validated();
        $department = $model->create($inputs);
        return $this->created(AdminDepartmentResource::make($department));
    }

    public function destroy(AdminDepartment $adminDepartment)
    {
        $adminDepartment->delete();
        $this->noContent();
    }
}
