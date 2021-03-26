<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDatatable;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    
    public function index(RoleDatatable $role)
    {

        return $role->render('roles.index');

    }//end of index

    public function store(Request $request)
    {

        $data = request()->validate([
            'name'     => 'required',
        ]);

        Role::create($data);

        return response()->json(['success' => trans('admin.record_added')]);

    }//end of store role

    public function show(Role $role)
    {

        return view('roles.ajax_show', compact('role'));

    }//end of show

    public function edit(Role $role)
    {

        return view('roles.ajax_edit', compact('role'));

    }//end of edit

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([

            'name'     => 'required',

        ]);
        
        $role->update($data);
        return response()->json(['success' => trans('admin.updated_record')]);

    }//end of update 

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['success' => trans('admin.deleted_record')]);

    }//end of delete role

    public function destroyAll()
    {
        Role::destroy(request('item'));
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(route('users.index'));

    }//end of delete multi-roles

}//end of controller
