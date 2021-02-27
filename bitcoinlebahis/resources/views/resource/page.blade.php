@extends('layouts.app')

@section('content')

    
    <div class="row">
        <div class="col-xs-12">
            <div class="card-box">
                <!-- <div class="panel-heading">
                    <h4>Invoice</h4>
                </div> -->
                <div class="panel-body">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h1 style="font-size: 2rem; color: #2b3d51 !important;">{{$arResource->name}}</h1>
                        </div>
                        <div class="pull-right">
                          
                        </div>
                    </div>
                    <hr>

                    <div class="m-h-50"></div>

                    <div class="row">
                        <div class="col-xs-12">
                            {!! $arResource->text !!}
                        </div>
                    </div>
                    
                    
                   
                    
                    <hr>
                    <div class="pull-xs-right">
                        <h6>Share this:</h6><div class="sharethis-inline-share-buttons"></div>
                    </div>
                    <div class="clearfix"></div>

                </div>
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