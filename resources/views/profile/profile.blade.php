@extends('index')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="card-title">@lang('admin.profile')</div>
    </div>
    <div class="card-body">
        <div id="ajax_profile_errors"></div>

        <form id="profile_form" class="form-horizontal" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
                        </div>
            
                        <div class="form-group col-md-6">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" class="form-control" id="mobile" value="{{ $user->mobile }}">
                        </div>
            
                        <div class="form-group col-md-6">
                            {!! Form::label('gender' , trans('admin.gender')) !!}
            
                            {!! Form::select('gender', [
                                'male'     => trans('admin.male'),
                                'female'   => trans('admin.female')
                            ]
                            , $user->gender, ['class' => 'form-control', 'placeholder' => 'gender']) !!}
                        </div>
            
                        <div class="form-group col-md-6">
                            {!! Form::label('country' , trans('admin.country')) !!}
                            {!! Form::select('country', $countries, $user->country, ['class' => 'form-control', 'placeholder' => 'country']) !!}
                        </div>
            
                        <div class="form-group col-md-6">
                            <label for="national_id">National ID</label>
                            <input type="text" name="national_id" class="form-control" id="national_id" value="{{ $user->national_id }}">
                        </div>
            
                        <div class="form-group col-md-6">
                            <label for="email">E-mail</label>
                            <input type="text" name="email" class="form-control" id="email" value="{{ $user->email }}">
                        </div>
            
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
            
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Confirm password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 up_img">
                    <div class="form-group">
                        <h1>
                            {{trans('admin.image')}}
                        </h1>
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="avatar_image" name="avatar_image"/>
                                <label for="avatar_image">
                                    <i class="fa fa-pencil-alt"></i>
                                </label>
                            </div>
                            <div class="avatar-preview">
                                @if($user->avatar_image == 'avatar.png')
                                <div id="imagePreview" style="background-image: url({{ url('images') . '/' . $user->avatar_image }});"></div>
                                @else
                                <div id="imagePreview" style="background-image: url({{ url('storage/users_images') . '/' . $user->avatar_image }});"></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
    
            </div>

            <button type="submit" class="btn btn-success" id="update_data" >@lang('admin.save')</button>

        </form>
    </div>
</div>

@push('js')
<script>

    //======================================//
    //update user data with image using AJAX//
    //======================================// 

    $(document).ready(function(){  
        $(document).on('submit', '#profile_form', function(event){

            event.preventDefault(); 

            console.log(new FormData(this));

            $.ajax({
                url: '{{url("")}}/profile',
                method:"post",
                data: new FormData(this),
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",

                success: function (data) {
                    toastr.success(data.success, 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true});
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                    var errorsHtml = '<div class="alert alert-danger"><ul class="mb-0">';
                    $.each( errors.errors, function( key, value ) {
                        errorsHtml += '<li>'+ value[0] + '</li>';
                    });
                    errorsHtml += '</ul></div>';
                    $('#ajax_profile_errors').html(errorsHtml);
                }
                
            });//end of ajax request
            
        });
    });
</script>
@endpush

@endsection
