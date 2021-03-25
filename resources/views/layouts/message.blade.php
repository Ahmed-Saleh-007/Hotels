@if($errors->any())
@push('js')
<script>
    toastr.error(`<ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>`, 'Error Alert', {timeOut: 10000, closeButton: true, progressBar: true})
</script>
@endpush
@endif

@if(session()->has('success'))
@push('js')
<script>
    toastr.success('{{ session('success') }}', 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true})
</script>
@endpush
@endif

@if(session()->has('error'))
@push('js')
<script>
    toastr.error('{{ session('error') }}', 'Error Alert', {timeOut: 10000, closeButton: true, progressBar: true})
</script>
@endpush
@endif