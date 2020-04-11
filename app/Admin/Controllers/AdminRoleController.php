<?php

namespace App\Admin\Controllers;

use App\Admin\Filters\AdminRoleFilter;
use App\Admin\Models\AdminDepartment;
use App\Admin\Models\AdminUser;
use App\Admin\Requests\AdminRoleRequest;
use App\Admin\Resources\AdminDepartmentResource;
use App\Admin\Resources\AdminRoleResource;
use App\Admin\Models\AdminPermission;
use App\Admin\Models\AdminRole;
use App\Admin\Resources\AdminUserResource;
use App\Admin\Utils\Admin;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    public function store(AdminRoleRequest $request, AdminRole $model)
    {
        $inputs = $request->validated();
        $role = $model->create($inputs);
        //写入角色（岗位）的权限信息
        if (!empty($perms = $inputs['permissions'] ?? [])) {
            $role->permissions()->attach($perms);
        }
        //写入角色（岗位）的部门信息
        if (!empty($departs = $inputs['departments'] ?? [])) {
            $role->departments()->attach($departs);
        }

        return $this->created(AdminRoleResource::make($role));
    }

    public function edit(Request $request, AdminRole $adminRole)
    {
        $adminRole->load(['permissions', 'departments']);
        $roleData = AdminRoleResource::make($adminRole)->toArray($request);
        return $this->ok([
            'role' => $roleData,
            'permissions' => $this->formData()['permissions'],
            'departments' => $this->formData()['departments'],
            'isAdmin' => Admin::isAdministrator()
        ]);
    }

    public function update(AdminRoleRequest $request, AdminRole $adminRole)
    {
        $inputs = $request->validated();
        $adminRole->update($inputs);
        if (isset($inputs['permissions'])) {
            $adminRole->permissions()->sync($inputs['permissions']);
        }
        if (isset($inputs['departments'])) {
            $adminRole->departments()->sync($inputs['departments']);
        }
        return $this->created(AdminRoleResource::make($adminRole));
    }

    public function destroy(AdminRole $adminRole)
    {
        $adminRole->delete();
        return $this->noContent();
    }

    public function index(Request $request, AdminRoleFilter $filter)
    {
        $roles = AdminRole::query()
            ->with(['permissions'])
            ->filter($filter)
            ->orderByDesc('id');
        $roles = $request->get('all') ? $roles->get() : $roles->paginate();

        return $this->ok(AdminRoleResource::collection($roles));
    }

    /**
     * 返回添加和编辑表单所需的选项数据
     *
     * @return array
     */
    protected function formData()
    {
        $permissions = AdminPermission::query()
            ->orderByDesc('id')
            ->get();
        $departments = AdminDepartment::query()
            ->orderByDesc('id')
            ->get();

        return compact('permissions', 'departments');
    }

    public function create(Request $request)
    {
        $user = Admin::user();
        $currentLoginUserId = AdminUserResource::make($user)->toArray($request)['id'];
        $result = $this->formData();
        $isAdmin = Admin::isAdministrator();
        if (!$isAdmin) {
            $currentLoginDepartmentId = AdminDepartment::departmentByUserId($currentLoginUserId)->department_id;
            $result = array_merge($result, ['role'=>['departments' => ['id' => $currentLoginDepartmentId]]]);
        }
        $result['isAdmin'] = $isAdmin;

        return $this->ok($result);
    }
}
