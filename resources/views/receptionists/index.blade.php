@extends('index')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="card-title">Receptionists Control</div>
    </div>
    <div class="card-body">
        {!! $dataTable->table(['class' => 'dataTable table table-striped table-hover table-bordered'], true) !!}
    </div>
</div>


<!--
    create modal view using by ajax
-->

<div id="ajax_create" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Receptionist</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" id="ajax_create_content">

            <div id="ajax_create_errors"></div>
            
        <form method="POST" id="store_form" class="form-horizontal" enctype="multipart/form-data">
                @csrf

            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" id="name">
            </div>

            <div class="form-group">
              <label for="mobile">Mobile</label>
              <input type="text" name="mobile" class="form-control" id="mobile">
            </div>

            <div class="form-group col-md-12 col-lg-12 col-sm-12 col-xs-12">

                {!! Form::label('gender' , trans('admin.gender')) !!}
            
                {!! Form::select('gender', [
                    'male'     => trans('admin.male'),
                    'female'   => trans('admin.female')
                ]
                ,old('gender'),['class' => 'form-control', 'placeholder' => 'gender']) !!}
            
            </div>

            {{-- <div class="form-group col-md-12 col-lg-12 col-sm-12 col-xs-12">

                {!! Form::label('level' , trans('admin.level')) !!}
            
                {!! Form::select('level', [
                    'manager'          => trans('admin.manager'),
                    'receptionist'     => trans('admin.receptionist'),
                    'client'           => trans('admin.client')
                ]
                ,old('level'),['class' => 'form-control', 'placeholder' => 'level']) !!}
            
            </div> --}}

            <div class="form-group col-md-12 col-lg-12 col-sm-12 col-xs-12">

                {!! Form::label('country' , trans('admin.country')) !!}
            
                {!! Form::select('country', $countries
                ,old('country'),['class' => 'form-control', 'placeholder' => 'country']) !!}
            
            </div>

            <div class="form-group">
                <label for="avatar_image">Image</label>
                <input type="file" name="avatar_image" class="form-control" id="avatar_image" onchange="doAfterSelectImage(this)" style="display: none">
            
                <label for="avatar_image">

                <img src="{{ url('images/image.png') }}" class="img-thumbnail" alt="" width="80" id="post_user_image_">
                </label>
            
            
            </div>

            <div class="form-group">
                <label for="national_id">National ID</label>
                <input type="text" name="national_id" class="form-control" id="national_id">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" name="email" class="form-control" id="email">
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" id="password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
              </div>

            <button type="submit" class="btn btn-success" id="create_user" >Create User</button>

        </form>
        </div>
      </div>
    </div>
</div>


<!--
    view modal view using by ajax
-->

<div id="ajax_view" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View User</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" id="ajax_view_content">
          
        </div>
      </div>
    </div>
</div>


<!--
    edit modal view using by ajax
-->

<div id="ajax_edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Receptionist</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" id="ajax_edit_content">
          
        </div>
      </div>
    </div>
</div>


<!--
    delete modal view using by ajax
-->

<div id="ajax_delete" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Receptionist</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" id="ajax_delete_content">
            @csrf
            <h4 class="mb-3">{{ trans('admin.delete_this') }}</h4>
            <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.no') }}</button>
            <button class="btn btn-danger" id="delete" >Delete Receptionist</button>
          </div>
      </div>
    </div>
</div>


<!--
    delete all modal view using by ajax
-->

<div id="mutlipleDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <div class="empty_record hidden">
                        <h4>{{ trans('admin.please_check_some_records') }} </h4>
                    </div>
                    <div class="not_empty_record hidden">
                        <h4>{{ trans('admin.ask_delete_itme') }} <span class="record_count"></span> ? </h4>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="empty_record hidden">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
                </div>
                <div class="not_empty_record hidden">
                    @csrf
                    <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.no') }}</button>
                    {{-- <input type="submit"  value="{{ trans('admin.yes') }}"  class="btn btn-danger del_all" /> --}}
                    <button class="btn btn-danger" id="ajax_delete_all" >{{ trans('admin.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

{!! $dataTable->scripts() !!}

<script>

    /*
        How ajax work using jQuery

        $.ajax({
            url:  '',                                   // put you route here
            type: 'get',                                // put your method get, post, put, delete
            data: {},                                   // put your data that will send with request
            success: function (data) {}                 // data from response if request success 2**
            error: function (data) {}                   // error from response if request failed 4**, 5**
        });

    */


    ///////////////////////////
    // Ajax handler for store//
    ///////////////////////////

    // $(document).ready(function () {
    //     $('.ajax-create').attr("data-toggle", "modal");
    //     $('.ajax-create').attr("data-target", "#ajax_create");
    //     $(document).on('click', '#ajax_create_content #create', function (event) {

    //         event.preventDefault();

    //         var avatar_image =      $('#ajax_create_content #avatar_image').get(0).files[0];


    //         // var formData = new FormData($('#storeForm').val());
    //         // console.log(formData);

    //         // var _token =  $('#csrf-token').val();
    //         // totalFormData.append('_token', _token);
    //         // console.log(totalFormData);

    //         // alert($('#ajax_create_content #name').val());

    //         // $.ajaxSetup({
    //         //     headers: {
    //         //         'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    //         //     }
    //         // });




    //         // $.ajax({
    //         //     url:  '{{route('users.store')}}',
    //         //     type: 'post',
    //         //     data: {
    //         //         name         : $('#ajax_create_content #name').val(),
    //         //         mobile       : $('#ajax_create_content #mobile').val(),
    //         //         gender       : $('#ajax_create_content #gender').val(),
    //         //         avatar_image : avatar_image,
    //         //         level        : $('#ajax_create_content #level').val(),
    //         //         national_id  : $('#ajax_create_content #national_id').val(),
    //         //         email        : $('#ajax_create_content #email').val(),
    //         //         password     : $('#ajax_create_content #password').val(),
    //         //         password_confirmation:  $('#ajax_create_content #password_confirmation').val(),
    //         //     },
    //         //     // processData: false,
    //         //     // contentData : false,
    //         //     // cache: false,
    //         //     success: function (data) {
    //         //         toastr.success(data.success, 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true});
    //         //         $('#ajax_create_content #name').val('');
    //         //         $('#ajax_create_content #email').val('');
    //         //         $('#ajax_create_content #password').val('');
    //         //         $('#ajax_create_content #ajax_create_errors').html('');
    //         //     },
    //         //     error: function (data) {
    //         //         var errors = data.responseJSON;
    //         //         console.log(errors);
    //         //         var errorsHtml = '<div class="alert alert-danger"><ul class="mb-0">';
    //         //         $.each( errors.errors, function( key, value ) {
    //         //             errorsHtml += '<li>'+ value[0] + '</li>';
    //         //         });
    //         //         errorsHtml += '</ul></div>';
    //         //         $('#ajax_create_content #ajax_create_errors').html(errorsHtml);
    //         //     }
    //         // });
    //     });
    // });
    

    //////////////////////////
    // Ajax handler for show//
    //////////////////////////

    $(document).ready(function () {
      $(document).on('click', '.show-ajax', function () {
        console.log($(this).data('ajax'));
        $.ajax({
            url:  '{{url("")}}/receptionists/' + $(this).data('ajax'),
            type: 'get',
            //data: {user: $(this).data('ajax')},
            success: function (data) {
              $('#ajax_view_content').html(data);
            }
        });
      });
    });


    //////////////////////////
    // Ajax handler for edit//
    //////////////////////////

    $(document).ready(function () {
        $(document).on('click', '.edit-ajax', function () {
            console.log($(this).data('ajax'));
            $.ajax({
                url:  '{{url("")}}/receptionists/' + $(this).data('ajax') + '/edit',
                type: 'get',
                //data: {user: $(this).data('ajax')},
                success: function (data) {
                    $('#ajax_edit_content').html(data);
                }
            });
        });
    });

    //=========================//
    // Ajax handler for update //
    //=========================//

    // $(document).ready(function () {
    //     $(document).on('click', '#ajax_edit_content #update_data', function () {
            
    //         $.ajax({
    //             url:  '{{url("")}}/users/' + $('#ajax_edit_content #id').val(),
    //             type: 'put',
    //             data: {
    //                 _token:     $('#ajax_edit_content [name=_token]').val(),
    //                 name:       $('#ajax_edit_content #name').val(),
    //                 email:      $('#ajax_edit_content #email').val(),
    //                 password:   $('#ajax_edit_content #password').val(),
    //             },
    //             success: function (data) {
    //                 toastr.success(data.success, 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true})
    //                 $('#ajax_edit_content #name').val('')
    //                 $('#ajax_edit_content #email').val('')
    //                 $('#ajax_edit_content #password').val('')
    //                 $('#ajax_edit_content #ajax_edit_errors').html('');
    //                 $('#ajax_edit').modal('toggle');
    //             },
    //             error: function (data) {
    //                 var errors = data.responseJSON;
    //                 console.log(errors);
    //                 var errorsHtml = '<div class="alert alert-danger"><ul class="mb-0">';
    //                 $.each( errors.errors, function( key, value ) {
    //                     errorsHtml += '<li>'+ value[0] + '</li>';
    //                 });
    //                 errorsHtml += '</ul></div>';
    //                 $('#ajax_edit_content #ajax_edit_errors').html(errorsHtml);
    //             }
    //         });
    //     });
    // });


    ////////////////////////////
    // Ajax handler for delete//
    ////////////////////////////

    $(document).ready(function () {
        var _id = 0;
        $(document).on('click', '.delete-ajax', function () {
            console.log($(this).data('ajax'));
            _id = $(this).data('ajax');
        });
        $(document).on('click', '#ajax_delete_content #delete', function () {
            $.ajax({
                url:  '{{url("")}}/receptionists/' + _id,
                type: 'delete',
                data: {
                    _token: $('#ajax_delete_content [name=_token]').val(),
                },
                success: function (data) {
                    toastr.success(data.success, 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true});
                    $('#ajax_delete').modal('toggle');
                }
            });
        });
    });

    ////////////////////////////////
    // Ajax handler for delete all//
    ////////////////////////////////
    
    $(document).ready(function () {
        $(document).on('click', '#ajax_delete_all', function () {
            var items = [];
            $.each($(".item_checkbox[name='item[]']:checked"), function() {
                items.push($(this).val());
            });
            $.ajax({
                url:  '{{route('receptionists.destroyAll')}}',
                type: 'delete',
                data: {
                    _token: $('#mutlipleDelete [name=_token]').val(),
                    item: items
                },
                success: function (data) {
                    toastr.success(data.success, 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true});
                    $('#mutlipleDelete').modal('toggle');
                }
            });
        });
    });

    //==========================//
    //for showing selected image//
    //==========================//
    function doAfterSelectImage(input){
        readURL(input);
    }

    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#post_user_image_').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    //===========================//


    //=====================================//
    //store user data with image using AJAX//
    //=====================================// 

    $(document).ready(function(){   

        $('.ajax-create').attr("data-toggle", "modal");
        $('.ajax-create').attr("data-target", "#ajax_create");

        $('#store_form').on('submit', function(event){

            event.preventDefault();     

            $.ajax({
                url:"{{route('receptionists.store')}}",
                method:"POST",
                data: new FormData(this),
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",

                success: function (data) {
                    toastr.success(data.success, 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true});
                    $('#ajax_create_content #name').val('');
                    $('#ajax_create_content #email').val('');
                    $('#ajax_create_content #avatar_img').val('');
                    $('#ajax_create_content #mobile').val('');
                    $('#ajax_create_content #national_id').val('');
                    $('#ajax_create_content #level').val('');
                    $('#ajax_create_content #gender').val('');
                    $('#ajax_create_content #password_confirmation').val('');
                    $('#ajax_create_content #password').val('');
                    $('#ajax_create_content #ajax_create_errors').html('');
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                    var errorsHtml = '<div class="alert alert-danger"><ul class="mb-0">';
                    $.each( errors.errors, function( key, value ) {
                        errorsHtml += '<li>'+ value[0] + '</li>';
                    });
                    errorsHtml += '</ul></div>';
                    $('#ajax_create_content #ajax_create_errors').html(errorsHtml);
                }
                
            });//end of ajax request
            
        });

    });


    //=====================================//
    //store user data with image using AJAX//
    //=====================================// 

    $(document).ready(function(){  


        $(document).on('submit', '#ajax_edit_content #update_form', function(event){


            event.preventDefault(); 
            console.log(new FormData(this));

            $.ajax({
                url: '{{url("")}}/receptionists/' + $('#ajax_edit_content #id').val(),
                method:"put",
                data: new FormData(this),
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",

                success: function (data) {
                    toastr.success(data.success, 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true});
                    $('#ajax_create_content #name').val('');
                    $('#ajax_create_content #email').val('');
                    $('#ajax_create_content #avatar_img').val('');
                    $('#ajax_create_content #mobile').val('');
                    $('#ajax_create_content #national_id').val('');
                    $('#ajax_create_content #level').val('');
                    $('#ajax_create_content #gender').val('');
                    $('#ajax_create_content #password_confirmation').val('');
                    $('#ajax_create_content #password').val('');
                    $('#ajax_create_content #ajax_create_errors').html('');
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                    var errorsHtml = '<div class="alert alert-danger"><ul class="mb-0">';
                    $.each( errors.errors, function( key, value ) {
                        errorsHtml += '<li>'+ value[0] + '</li>';
                    });
                    errorsHtml += '</ul></div>';
                    $('#ajax_create_content #ajax_create_errors').html(errorsHtml);
                }
                
            });//end of ajax request
            
        });

    });

</script>

@endpush

@endsection
