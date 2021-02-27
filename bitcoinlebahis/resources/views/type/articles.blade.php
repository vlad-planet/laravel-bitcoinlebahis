@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="card-box">
                {{!! $arList !!}}
            </div>
        </div>
    </div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
@endsection

@section('js')
 <!-- Raty-fa -->
<script src="assets/plugins/raty-fa/jquery.raty-fa.js"></script>
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5a5df21e032b920011311197&product=viral-notifications' async='async'></script>
@endsection