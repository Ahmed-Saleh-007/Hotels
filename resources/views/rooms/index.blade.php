@extends('index')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="card-title">@lang('admin.room control')</div>
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
          <h4 class="modal-title">@lang('admin.create room')</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" id="ajax_create_content">
            <div id="ajax_create_errors"></div>
            {!! Form::open(['id' => 'store_form']) !!}
            <div class="form-group">
                {!! Form::label('number', trans('admin.number')) !!}
                {!! Form::text('number', old('number'), ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('capacity', trans('admin.capacity')) !!}
                {!! Form::text('capacity', old('capacity'), ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('price', trans('admin.price')) !!}
                {!! Form::text('price', old('price'), ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('floor_id', trans('admin.floor_name')) !!}
                {!! Form::select('floor_id', App\Models\Floor::where('manager_id', auth()->user()->id)->pluck('name', 'id'), old('floor_id'), ['class' => 'form-control', 'placeholder' => '...']) !!}
            </div>
            {!! Form::submit(trans('admin.add'), ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
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
          <h4 class="modal-title">@lang('admin.view room')</h4>
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
          <h4 class="modal-title">@lang('admin.edit room')</h4>
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
          <h4 class="modal-title">@lang('admin.delete room')</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" id="ajax_delete_content">
            @csrf
            <h4 class="mb-3">{{ trans('admin.delete_this') }}</h4>
            <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.no') }}</button>
            <button class="btn btn-danger" id="delete" >{{ trans('admin.yes') }}</button>
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
            data: $(this).serialize(),                  // put your data that will send with request
            success: function (data) {}                 // data from response if request success 2**
            error: function (data) {}                   // error from response if request failed 4**, 5**
        });

        To send data:

        data: $(this).serialize(),

        or

        data: new FormData(this),
        contentType: false,
        cache:false,
        processData: false,
        dataType:"json",

        if you use fle you should take second type, and use POST in store and update


    */


    ///////////////////////////
    // Ajax handler for store//
    ///////////////////////////

    $(document).ready(function () {
        $('.ajax-create').attr("data-toggle", "modal");
        $('.ajax-create').attr("data-target", "#ajax_create");
        $('#store_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url:  '{{route('rooms.store')}}',
                type: 'post',
                data: $(this).serialize(),
                success: function (data) {
                    toastr.success(data.success, 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true});
                    $('#ajax_create_content #number').val('');
                    $('#ajax_create_content #capacity').val('');
                    $('#ajax_create_content #price').val('');
                    $('#ajax_create_content #ajax_create_errors').html('');
                    $('.buttons-reload').trigger("click");
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
            url:  '{{url("")}}/rooms/' + $(this).data('ajax'),
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
                url:  '{{url("")}}/rooms/' + $(this).data('ajax') + '/edit',
                type: 'get',
                //data: {user: $(this).data('ajax')},
                success: function (data) {
                $('#ajax_edit_content').html(data);
                }
            });
        });
    });


    ////////////////////////////
    // Ajax handler for update//
    ////////////////////////////

    $(document).ready(function () {
        $(document).on('submit', '#update_form', function(e) {
            e.preventDefault();
            $.ajax({
                url:  '{{url("")}}/rooms/' + $('#ajax_edit_content #id').val(),
                type: 'put',
                data: $(this).serialize(),
                success: function (data) {
                    toastr.success(data.success, 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true})
                    $('#ajax_edit_content #ajax_edit_errors').html('');
                    $('#ajax_edit').modal('toggle');
                    $('.buttons-reload').trigger("click");
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
                url:  '{{url("")}}/rooms/' + _id,
                type: 'delete',
                data: {
                    _token: $('#ajax_delete_content [name=_token]').val(),
                },
                success: function (data) {
                    toastr.success(data.success, 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true});
                    $('#ajax_delete').modal('toggle');
                    $('.buttons-reload').trigger("click");
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
                url:  '{{route('rooms.destroyAll')}}',
                type: 'delete',
                data: {
                    _token: $('#mutlipleDelete [name=_token]').val(),
                    item: items
                },
                success: function (data) {
                    toastr.success(data.success, 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true});
                    $('#mutlipleDelete').modal('toggle');
                    $('.buttons-reload').trigger("click");
                }
            });
        });
    });

</script>

@endpush

@endsection
