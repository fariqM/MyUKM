@extends('UKM.layouts.master')

@section('main-content')
    
<div>
    <iframe src="{{ asset('storage/docs/spj/'.$data->spj_name) }}" frameborder="0" height="600" width="1000"></iframe>
</div>

@endsection

@section('bottom-js')
<script src="{{asset('assets/js/form.basic.script.js')}}"></script>


@endsection