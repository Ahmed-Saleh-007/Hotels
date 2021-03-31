@extends('index')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="card-title">My Approved Clients</div>
    </div>
    <div class="card-body">
        {!! $dataTable->table(['class' => 'dataTable table table-striped table-hover table-bordered'], true) !!}
    </div>
</div>


@push('js')

{!! $dataTable->scripts() !!}

@endpush

@endsection
