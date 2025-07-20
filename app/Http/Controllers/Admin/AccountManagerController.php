<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class AccountManagerController extends Controller
{
    // === USER SECTION ===

    public function userIndex()
    {
        $users = User::with('roles')->get();
        return view('admin.account.users.index', compact('users'));
    }

    public function userCreate()
    {
        $roles = Role::all();
        return view('admin.account.users.create', compact('roles'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'roles'    => 'array',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->has('roles')) {
            $user->assignRole($request->roles);
        }

        flash()->success('User created successfully.');
        return redirect()->route('admin.users.index');
    }

    public function userEdit($id)
    {
        $user  = User::findOrFail($id);
        $roles = Role::all();
        $userRole = $user->roles->pluck('name')->toArray();
        return view('admin.account.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'roles'    => 'array',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $user->syncRoles($request->roles ?? []);

        flash()->success('User updated successfully.');
        return redirect()->route('admin.users.index');
    }

    public function userDelete($id)
    {
        User::findOrFail($id)->delete();
        flash()->success('User deleted.');
        return redirect()->route('admin.users.index');
    }

    // === ROLE SECTION ===

    public function roleIndex()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.account.roles.index', compact('roles'));
    }

    public function roleCreate()
    {
        $permissions = Permission::all();
        return view('admin.account.roles.create', compact('permissions'));
    }

    public function roleStore(Request $request)
    {
        $request->validate([
            'name'        => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        flash()->success('Role created successfully.');
        return redirect()->route('admin.roles.index');
    }

    public function roleEdit($id)
    {
        $role        = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('admin.account.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function roleUpdate(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name'        => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array',
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        flash()->success('Role updated successfully.');
        return redirect()->route('admin.roles.index');
    }

    public function roleDelete($id)
    {
        Role::findOrFail($id)->delete();
        flash()->success('Role deleted.');
        return redirect()->route('admin.roles.index');
    }

        // === PERMISSION SECTION ===

    public function permissionIndex()
    {
        $permissions = Permission::all();
        return view('admin.account.permissions.index', compact('permissions'));
    }
    
    public function permissionCreate()
    {
        return view('admin.account.permissions.create');
    }
    
    public function permissionStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);
    
        Permission::create(['name' => $request->name]);
    
        flash()->success('Permission created successfully.');
        return redirect()->route('admin.permissions.index');
    }
    
    public function permissionEdit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.account.permissions.edit', compact('permission'));
    }
    
    public function permissionUpdate(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
    
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);
    
        $permission->update(['name' => $request->name]);
    
        flash()->success('Permission updated successfully.');
        return redirect()->route('admin.permissions.index');
    }
    
    public function permissionDelete($id)
    {
        Permission::findOrFail($id)->delete();
        flash()->success('Permission deleted.');
        return redirect()->route('admin.permissions.index');
    }
    
}
