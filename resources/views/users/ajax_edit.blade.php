<div id="ajax_edit_errors"></div>

<form  id="update_form" class="form-horizontal" enctype="multipart/form-data">
    
    @csrf
    
    <input type="text" name="id" class="hidden" id="id" value="{{$user->id}}">

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
    </div>

    <div class="form-group">
    <label for="mobile">Mobile</label>
    <input type="text" name="mobile" class="form-control" id="mobile" value="{{ $user->mobile }}">
    </div>

    <div class="form-group col-md-12 col-lg-12 col-sm-12 col-xs-12">

        {!! Form::label('gender' , trans('admin.gender')) !!}

        {!! Form::select('gender', [
            'male'     => trans('admin.male'),
            'female'   => trans('admin.female')
        ]
        ,$user->gender,['class' => 'form-control', 'placeholder' => 'gender']) !!}

    </div>

    <div class="form-group col-md-12 col-lg-12 col-sm-12 col-xs-12">

        {!! Form::label('level' , trans('admin.level')) !!}

        {!! Form::select('level', [
            'manager'          => trans('admin.manager'),
            'receptionist'     => trans('admin.receptionist'),
            'client'           => trans('admin.client')
        ]
        ,$user->level,['class' => 'form-control', 'placeholder' => 'level']) !!}

    </div>

    <div class="form-group col-md-12 col-lg-12 col-sm-12 col-xs-12">

        {!! Form::label('country' , trans('admin.country')) !!}

        {!! Form::select('country', $countries
        ,$user->country,['class' => 'form-control', 'placeholder' => 'country']) !!}

    </div>

    <div class="form-group">
        
        <label for="avatar_image">Image</label>
        <input type="file" name="avatar_image" class="form-control" id="avatar_image">

    </div>

    <div class="form-group">
        <label for="national_id">National ID</label>
        <input type="text" name="national_id" class="form-control" id="national_id" value="{{ $user->national_id }}">
    </div>

    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="text" name="email" class="form-control" id="email" value="{{ $user->email }}">
    </div>

    <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" id="password">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm password</label>
        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
    </div>

    <button type="submit" class="btn btn-success" id="update_data" >Update User</button>

</form>

