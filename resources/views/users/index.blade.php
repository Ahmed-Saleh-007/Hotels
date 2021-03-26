@extends('index')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="card-title">User Control</div>
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
          <h4 class="modal-title">Create User</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" id="ajax_create_content">
            <div id="ajax_create_errors"></div>
            @csrf
            <div class="form-group">
              <label for="name">name</label>
              <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="form-group">
              <label for="email">email</label>
              <input type="text" name="email" class="form-control" id="email">
            </div>
            <div class="form-group">
              <label for="password">password</label>
              <input type="password" name="password" class="form-control" id="password">
            </div>
            <button class="btn btn-success" id="create" >Create User</button>
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
          <h4 class="modal-title">Edit User</h4>
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
          <h4 class="modal-title">Delete User</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" id="ajax_delete_content">
            @csrf
            <h4 class="mb-3">{{ trans('admin.delete_this') }}</h4>
            <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.no') }}</button>
            <button class="btn btn-danger" id="delete" >Delete User</button>
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

    $(document).ready(function () {
        $('.ajax-create').attr("data-toggle", "modal");
        $('.ajax-create').attr("data-target", "#ajax_create");
        $(document).on('click', '#ajax_create_content #create', function () {
            $.ajax({
                url:  '{{route('users.store')}}',
                type: 'post',
                data: {
                    _token:     $('#ajax_create_content [name=_token]').val(),
                    name:       $('#ajax_create_content #name').val(),
                    email:      $('#ajax_create_content #email').val(),
                    password:   $('#ajax_create_content #password').val(),
                },
                success: function (data) {
                    toastr.success(data.success, 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true});
                    $('#ajax_create_content #name').val('');
                    $('#ajax_create_content #email').val('');
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
            });
        });
    });
    

    //////////////////////////
    // Ajax handler for show//
    //////////////////////////

    $(document).ready(function () {
      $(document).on('click', '.show-ajax', function () {
        console.log($(this).data('ajax'));
        $.ajax({
            url:  '{{url("")}}/users/' + $(this).data('ajax'),
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
                url:  '{{url("")}}/users/' + $(this).data('ajax') + '/edit',
                type: 'get',
                //data: {user: $(this).data('ajax')},
                success: function (data) {
                    $('#ajax_edit_content').html(data);
                }
            });
        });
    });


    //////////////////////////
    // Ajax handler for save//
    //////////////////////////

    $(document).ready(function () {
        $(document).on('click', '#ajax_edit_content #save', function () {
            $.ajax({
                url:  '{{url("")}}/users/' + $('#ajax_edit_content #id').val(),
                type: 'put',
                data: {
                    _token:     $('#ajax_edit_content [name=_token]').val(),
                    name:       $('#ajax_edit_content #name').val(),
                    email:      $('#ajax_edit_content #email').val(),
                    password:   $('#ajax_edit_content #password').val(),
                },
                success: function (data) {
                    toastr.success(data.success, 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true})
                    $('#ajax_edit_content #name').val('')
                    $('#ajax_edit_content #email').val('')
                    $('#ajax_edit_content #password').val('')
                    $('#ajax_edit_content #ajax_edit_errors').html('');
                    $('#ajax_edit').modal('toggle');
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                    var errorsHtml = '<div class="alert alert-danger"><ul class="mb-0">';
                    $.each( errors.errors, function( key, value ) {
                        errorsHtml += '<li>'+ value[0] + '</li>';
                    });
                    errorsHtml += '</ul></div>';
                    $('#ajax_edit_content #ajax_edit_errors').html(errorsHtml);
                }
            });
        });
    });


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
                url:  '{{url("")}}/users/' + _id,
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
                url:  '{{route('users.destroyAll')}}',
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

</script>

@endpush

@endsection
