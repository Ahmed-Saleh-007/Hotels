<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $contries_info = countries();
        $countries = array();
        foreach($contries_info as $country) {
            $countries[$country['name']] = $country['name'];
        }

        $user = User::find(auth()->id());
        return view('profile.profile', compact('user', 'countries'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = User::find(auth()->id());
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
        } else {
            $data['password'] = $user->password;
        }

        $user->update($data);
        return response()->json(['success' => trans('admin.updated_record')]);

    }
}
