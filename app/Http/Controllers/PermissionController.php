<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionDatatable;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(PermissionDatatable $permission)
    {

        return $permission->render('permissions.index');

    }//end of index

    public function store(Request $request)
    {
        
        $data = request()->validate([
            'name'     => 'required',
        ]);

        $permission = Permission::create($data);
        
        if(is_array($request->role_id) && !empty($request->role_id)){


            foreach($request->role_id as $roleId){

                $role = Role::find($roleId);
                $role->givePermissionTo($permission);

            }

            
        }

        return response()->json(['success' => trans('admin.record_added')]);

    }//end of store permission

    public function show(Permission $permission)
    {

        return view('permissions.ajax_show', compact('permission'));

    }//end of show

    public function edit(permission $permission)
    {

        return view('permissions.ajax_edit', compact('permission'));

    }//end of edit

    public function update(Request $request, Permission $permission)
    {

        dd($request->all());

        $data = $request->validate([

            'name'     => 'required',

        ]);
        
        $permission->update($data);
        return response()->json(['success' => trans('admin.updated_record')]);

    }//end of update 

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response()->json(['success' => trans('admin.deleted_record')]);

    }//end of delete permission

    public function destroyAll()
    {
        Permission::destroy(request('item'));
		return response()->json(['success' => trans('admin.deleted_record')]);

    }//end of delete multi-permissions

}//end of controller
