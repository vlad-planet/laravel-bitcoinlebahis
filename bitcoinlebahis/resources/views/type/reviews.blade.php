@extends('layouts.app')

@section('content')
    <div ng-controller="listController" class="list-box">
       <div class="row">
            <h1 class="title">{{$type->name}} List</h1>
       </div>   
       
       
           
        <div class="row review-cards">
            <div ng-cloak ng-repeat="item in items" class="col-sm-4 col-lg-3 col-xs-12">
                <div class="card">
                    <a href="/content/{{$type->code}}/@{{item.code}}">
                        
                        <div class="bg-preview" style="background-image: url('@{{item.image}}');"></div>
                        
                    </a>                
                    <div class="card-block">                           
                       <div class="text-xs-center">
                            
                            <a href="/content/{{$type->name}}/@{{item.code}}">
                                <h4 class="card-title">@{{item.name}}</h4>
                            </a>
                            <h6 class="card-subtitle text-muted">@{{item.bonus}}</h6>
                            <br>
                            <h3>
                                <i class="fa fa-fw fa-star" title="gorgeous" data-score="1"></i> 
                                <span>@{{item.rating}}</span>
                            </h3>
                            
                        </div>
                        <br>
                        <p>@{{item.anonce}}</p>
                        <br/>
                        <div class="text-xs-center">
                            <a href="/content/{{$type->name}}/@{{item.code}}" class="btn btn-primary">Read review</a>
                            <a href="{{$type->site}}" class="btn btn-success">Go to site</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>        
@endsection




@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<style>

     .review-cards .card > a {
            padding: 5px 5px 0 5px;
        }
    
    
    .review-cards .card-block{
        padding-top: 0px;
    }
    
    .bg-preview {
        height: 125px;
        background-size: contain;
        background-position: center center;
        background-repeat: no-repeat;
    }
    
    
     .title{
         margin: 30px 0 30px 30px;
    }

    
</style>
@endsection

@section('js')
 <!-- Raty-fa -->
<script src="assets/plugins/raty-fa/jquery.raty-fa.js"></script>
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5a5df21e032b920011311197&product=viral-notifications' async='async'></script>
<script>


mainApp.controller("listController", function ($scope, $http, $document) {
    $scope.items = {!! $arList !!};
});


</script>
@endsection