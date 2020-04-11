<?php

namespace App\Admin\Controllers;

use App\Admin\Filters\AdminUserFilter;
use App\Admin\Models\AdminDepartment;
use App\Admin\Requests\AdminUserProfileRequest;
use App\Admin\Requests\AdminUserRequest;
use App\Admin\Resources\AdminUserResource;
use App\Admin\Models\AdminPermission;
use App\Admin\Models\AdminRole;
use App\Admin\Models\AdminUser;
use App\Admin\Utils\Admin;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function user()
    {
        $user = Admin::user();
        return $this->ok(
            AdminUserResource::make($user)
                ->gatherAllPermissions()
                ->onlyRolePermissionSlugs()
        );
    }

    public function editUser()
    {
        $user = Admin::user();
        $user->load(['roles', 'permissions']);
        return $this->ok(AdminUserResource::make($user));
    }

    public function updateUser(AdminUserProfileRequest $request)
    {
        $inputs = $request->validated();
        Admin::user()->updateUser($inputs);
        return $this->callAction('user', [])->setStatusCode(201);
    }

    public function index(AdminUserFilter $filter)
    {
        if (!Admin::isAdministrator()) {
            $users = AdminUser::query()
                ->filter($filter)
                ->with(['roles'])
                ->join('admin_user_role as aur', 'admin_users.id', '=', 'aur.user_id')
                ->join('admin_role_department as ard', 'aur.role_id', '=', 'ard.role_id')
                ->orderByDesc('id')
                ->paginate();
        } else {
            $users = AdminUser::query()
                ->filter($filter)
                ->with(['roles'])
                ->orderByDesc('id')
                ->paginate();
        }
        return $this->ok(AdminUserResource::collection($users));
    }

    public function store(AdminUserRequest $request, AdminUser $user)
    {
        $inputs = $request->validated();
        $user = $user::createUser($inputs);

        if (!empty($q = $request->post('roles', []))) {
            $user->roles()->attach($q);
        }
        if (!empty($q = $request->post('permissions', []))) {
            $user->permissions()->attach($q);
        }

        return $this->created(AdminUserResource::make($user));
    }

    public function show(AdminUser $adminUser)
    {
        $adminUser->load(['roles', 'permissions']);

        return $this->ok(AdminUserResource::make($adminUser));
    }

    public function update(AdminUserRequest $request, AdminUser $adminUser)
    {
        $inputs = $request->validated();
        $adminUser->updateUser($inputs);
        if (isset($inputs['roles'])) {
            $adminUser->roles()->sync($inputs['roles']);
        }
        if (isset($inputs['permissions'])) {
            $adminUser->permissions()->sync($inputs['permissions']);
        }
        return $this->created(AdminUserResource::make($adminUser));
    }

    public function destroy(AdminUser $adminUser)
    {
        $adminUser->delete();
        return $this->noContent();
    }

    public function edit(Request $request, AdminUser $adminUser)
    {
        $adminUser->load(['roles']);
        $adminUserData = AdminUserResource::make($adminUser)
            ->onlyRolePermissionIds()
            ->toArray($request);
        $formData = $this->formData($adminUserData['id']);
        $departmentId = AdminDepartment::departmentByUserId($adminUserData['id']);
        if (!empty($departmentId)) {
            $adminUserData['departments'] = $departmentId->department_id?:0;
        }
        return $this->ok(array_merge($formData, [
            'admin_user' => $adminUserData,
            'isAdmin' => Admin::isAdministrator()
        ]));
    }

    /**
     * 返回创建和编辑表单所需的选项数据
     * @param int currentLoginUserId
     * @return array
     */
    protected function formData($currentLoginUserId = 0)
    {
        if (!Admin::isAdministrator()) {
            $currentDepartmentId = AdminDepartment::departmentByUserId($currentLoginUserId)->department_id;
            $roles = AdminRole::query()
                ->join('admin_role_department as ard', 'ard.role_id', '=', 'admin_roles.id')
                ->where('ard.department_id', $currentDepartmentId)
                ->orderByDesc('id')
                ->get();
        } else {
            $roles = AdminRole::query()
                ->orderByDesc('id')
                ->get();
        }
        /*$permissions = AdminPermission::query()
            ->orderByDesc('id')
            ->get();*/
        $departments = AdminDepartment::query()
            ->orderByDesc('id')
            ->get();
        return compact('roles', 'departments');
    }

    public function create(Request $request)
    {
        $isAdmin = Admin::isAdministrator();
        $user = Admin::user();
        $currentLoginUserId = AdminUserResource::make($user)->toArray($request)['id'];
        $formData = $this->formData($currentLoginUserId);
        if (!$isAdmin) {
            $currentLoginDepartmentId = AdminDepartment::departmentByUserId($currentLoginUserId)->department_id;
            $formData = array_merge($formData, ['role'=>['departments' => ['id' => $currentLoginDepartmentId]]]);
        } else {
            $formData = array_merge($formData, ['role'=>['departments' => ['id' => 0]]]);
        }
        $formData['isAdmin'] = $isAdmin;
        return $this->ok($formData);
    }
}
