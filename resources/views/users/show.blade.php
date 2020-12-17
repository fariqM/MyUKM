@extends('layouts.app', ['page' => __('users'), 'pageSlug' => 'TabelPengajuan'])

@section('content')
<div>
<iframe src="{{ asset('storage/docs/proposal/'.$data->name) }}" frameborder="0" height="600" width="1000"></iframe>

</div>
@endsection
