@extends('layouts.app')

@section('content')
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.12';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    
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
                             <h3>
                                <span>Rating: <i class="fa fa-fw fa-star" title="gorgeous" data-score="1"></i>  {{$arResource->rating}}</span>
                            </h3>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
    
    
    
    <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="ion-ios7-basketball pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Game Play</h6>
                    <h2 class="m-b-20" data-plugin="counterup"><?=!empty($arResource->rating_gameplay) ? $arResource->rating_gameplay : 0?></h2>
               
                </div>
            </div>
            
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="ion-ios7-telephone pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Customer Service</h6>
                    <h2 class="m-b-20" data-plugin="counterup"><?=!empty($arResource->rating_service) ? $arResource->rating_service : 0?></h2>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="ion-ios7-people pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Anonymity</h6>
                    <h2 class="m-b-20"><span data-plugin="counterup"><?=!empty($arResource->rating_anonymity) ? $arResource->rating_anonymity : 0?></span></h2>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="ion-ribbon-b pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Bonus</h6>
                    <h2 class="m-b-20"><span data-plugin="counterup"><?=!empty($arResource->reting_bonus) ?  $arResource->reting_bonus : 0 ?></span></h2>
                  
                </div>
            </div>

    </div>
    
    
    <div class="row">
         <div class="card-box" style="width:100%;">
             <div style="text-align: center;"> 
                <a style="text-transform: uppercase; text-align: center; width:100%; max-width:500px; display: inline-block;" href="{{$arResource->site}}" type="button" class="btn btn-block btn-lg btn-success waves-effect waves-light">Go to site</a>         
             </div>
         </div>
    </div>
    
    <div class="row">
        
      
       
       
        
        <div class="col-xs-12">
            <div class="card-box">
                <!-- <div class="panel-heading">
                    <h4>Invoice</h4>
                </div> -->
                <div class="panel-body">
                    
                    
                    
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4>Review</h4>
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
                    <div class="pull-xs-left">
                        <h4>Share this:</h4><div class="sharethis-inline-share-buttons"></div>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>

        </div>

    </div>
                        
    @include('elements.comments')  
      
@endsection




@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
@endsection

@section('js')
 <!-- Raty-fa -->
<script src="assets/plugins/raty-fa/jquery.raty-fa.js"></script>
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5a5df21e032b920011311197&product=viral-notifications' async='async'></script>

@endsection