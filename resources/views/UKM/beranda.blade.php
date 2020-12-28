@extends('UKM.layouts.master')

@section('page-css')
<link rel="stylesheet" type="text/css" href="">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/normalize.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/component2.css') }}" />
<script src="{{ asset('assets/js/modernizr-2.6.2.min.js') }}"></script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-7243260-2']);
    _gaq.push(['_trackPageview']);
    (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
</script>
@endsection

@section('main-content')
<div class="container">
    <!-- Start Nav Structure -->
    <div style="height: 200px; position: relative;">
        <button class="cn-button" id="cn-button">Menu</button>
        <div class="cn-wrapper" id="cn-wrapper">
            <ul>
                <li><a href="#"><span>Pengajuan Proposal</span></a></li>
                <li><a href="#"><span>Pelampiran SPJ</span></a></li>
                <li><a href="#"><span>Kalender</span></a></li>
                <li><a href="#"><span>Data proposal</span></a></li>
                <li><a href="#"><span>Profile</span></a></li>
            </ul>
        </div>
    </div>

    <!-- End of Nav Structure -->
</div>

<script src="{{ asset('assets/js/polyfills.js') }}"></script>
<script src="{{ asset('assets/js/demo2.js') }}"></script>
<!-- For the demo ad only -->
<script src="http://tympanus.net/codrops/adpacks/demoad.js"></script>
@endsection