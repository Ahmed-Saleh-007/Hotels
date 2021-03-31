<?php

namespace App\Http\Controllers;

use App\DataTables\ReceptionistDatatable;
use App\Models\User;
use App\Http\Requests\StoreReceptionistRequest;
use App\Http\Requests\UpdateReceptionistRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ReceptionistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReceptionistDatatable $user)
    {
        

        $contries_info = countries();

        $countries_names = array();

        foreach($contries_info as $country){

            $countries_names[$country['name']] = $country['name'];

        }

        return $user->render('receptionists.index', ['countries' => $countries_names]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReceptionistRequest $request)
    {        
        $data = $request->all();

        if($request->hasFile('avatar_image')){

            // $data['avatar_image'] = $request->avatar_image->getClientOriginalName();
            $data['avatar_image'] = rand() . '.' . $request->avatar_image->getClientOriginalExtension();
            $request->avatar_image->storeAs('users_images', $data['avatar_image']);

        }

        unset($data['password_confirmaion']);

        $data['password'] = Hash::make($data['password']);

        $data['level'] = 'receptionist';

        $user = User::create($data);

        $user->assignRole('receptionist');

        return response()->json(['success' => trans('admin.record_added')]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('receptionists.ajax_show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $contries_info = countries();

        $countries = array();

        foreach($contries_info as $country){

            $countries[$country['name']] = $country['name'];

        }

        return view('receptionists.ajax_edit', compact('user', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReceptionistRequest $request, User $user)
    {

        $data = $request->all();

        //delete old image of post if exist and not the default image
        if($request->hasFile('avatar_image')){

            if (!empty($user->avatar_image) && $user->avatar_image != 'avatar.png') {
                Storage::delete('users_images/' . $user->avatar_image);
            }

            $data['avatar_image'] = rand() . '.' . $request->avatar_image->getClientOriginalExtension();
            $request->avatar_image->storeAs('users_images', $data['avatar_image']);

        } 

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        }else{
            $data['password'] = $user->password;
        }
        $user->update($data);
        return response()->json(['success' => trans('admin.updated_record')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(!empty($user->avatar_image) && $user->avatar_image != 'avatar.png')
        {
            Storage::delete('users_images/' . $user->avatar_image);
        }
        $user->delete();
        return response()->json(['success' => trans('admin.deleted_record')]);
    }

    public function destroyAll()
    {
        User::destroy(request('item'));
		return response()->json(['success' => trans('admin.deleted_record')]);
    }


}
