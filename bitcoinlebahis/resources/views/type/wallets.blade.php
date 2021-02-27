@extends('layouts.app')

@section('content')
    <div ng-controller="listController" class="list-box">
       <div class="row">
            <h1 class="title">{{$type->name}} List</h1>
       </div>   
       
       
           
        <div class="row">
            <div ng-cloak ng-repeat="item in items" class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-three">
                    <div class="bg-icon pull-xs-left">
                          <a href="/content/{{$type->code}}/@{{item.code}}">
                            <img class="preview" src="@{{item.image}}" height="78">
                          </a>
                    </div>
                    <div class="text-xs-right">
                        
                        <a href="/content/{{$type->code}}/@{{item.code}}">
                            <h6 class="text-success text-uppercase m-b-15 m-t-10">@{{item.name}}</h6>
                        </a>
                                                    
                        <h2 class="m-b-10">
                            <i class="fa fa-fw fa-star" title="gorgeous" data-score="1"></i> 
                            <span>@{{item.rating}}</span>
                        </h2>
                        
                        
                        <div class="info-box">
                            <h6>Ease of use</h6>
                            <progress class="progress progress-striped progress-xs progress-warning m-b-0" value="@{{item.ease_of_use}}" max="100"></progress>
                        </div>
                        
                        <div class="info-box">
                           <h6>Anonymity</h6>
                            <progress class="progress progress-striped progress-xs progress-warning m-b-0" value="@{{item.anonymity}}" max="100"></progress>
                        </div>
                        
                        <div class="info-box">
                            <h6>Supported coins</h6>
                            @{{item.coins}}
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
    
    .title{
         margin: 30px 0 30px 30px;
    }

    .info-box h6{
        text-transform: uppercase;
        margin: 20px 0 15px 0;
        line-height: 0;
    }
    
    .preview {
        border-radius: 100%;
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