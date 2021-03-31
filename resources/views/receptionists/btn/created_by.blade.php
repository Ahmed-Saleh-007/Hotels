@if($created_by != null)

    <b class="text-blue">{{ \App\Models\User::find($created_by)->name }}</b>

@else

    <b class="text-danger">---</b>

@endif