<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::latest()->paginate(50);
        $permission = Permission::all();

        return view('admin.roles.index', compact('roles', 'permission'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required',
        ]);

        $role = Role::create(['name' => $request->name]);

        $permissions = $request->input('permissions');

        $permissions = array_map(function ($item) {
            return (int)$item;
        }, $permissions);

        if (!empty($permissions)){
            $role->syncPermissions($permissions);
        }

        return redirect()->back()->with('success', 'با موفقیت ثبت شد.');
    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if ($request->has('name')) {
            $role->name = $request->input('name');
            $role->save();
        }

        $permissions = $request->input('permission');

        $permissions = array_map(function ($item) {
            return (int)$item;
        }, $permissions);

        if (!empty($permissions)){
            $role->syncPermissions($permissions);
        }

        return redirect()->back()->with('success', 'با موفقیت بروزرسانی شد.');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->back()->with('success', 'با موفقیت حذف شد.');
    }
}
