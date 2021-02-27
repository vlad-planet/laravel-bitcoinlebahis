<?
use App\Resource;
use App\Wallets;
use App\Reviews;
?>

@extends('layouts.app')

@section('content')

<div ng-controller="mainController">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h2 class="page-title">Popular criptocurrency  </h2>
            </div>
        </div>
    
        <div class="row">
             <div ng-cloak ng-repeat="item in currencies.items" class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one card-course" ng-click="setChar(item.FROMSYMBOL, item.TOSYMBOL, true)">
                    <i class="@{{item.ICON}} pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">@{{item.FROMSYMBOL}}</h6>
                    <h2 class="m-b-20">$<span >@{{item.PRICE}} </span></h2>
                    <span ng-class="{'label label-success' : item.CHANGE24HOURRAW > 0, 'label label-danger' : item.CHANGE24HOURRAW < 0}"> @{{item.CHANGE24HOURPCT}} </span>  <span class="text-muted">last 24h (@{{item.LASTMARKET}})</span>
                </div>
            </div>
        </div>
   
         <div class="row moreWrapper">
                <a href="#">Show more coins >></a>
        </div>
    
       
        
       
         <div class="card-box" data-s-course>
             <div id="container" style="height: 400px; min-width: 310px"></div>
        </div>
        
        
    
    		
    		
    <div class="card-box " >
            <div class="col-sm-12">
                <?$obData = Resource::where("id", "=", "6")->first();?>
                <h2 class="page-title"><?=$obData->name?></h2>
                <p class="text-muted"><?=$obData->text?></p>
            </div>
        </div>
    
    
      <div class="row">
             <?$obData = Resource::where("id", "=", "8")->first();?>                 
            <div style="text-align:center; width: 100%;"><h2><?=$obData->name?></h2></div>
            <div style="text-align:center; width: 100%;"><?=$obData->text?></div><br/><br/>
        
           @include('elements.wallets')            
            
        </div>
    
            
        <div class="row moreWrapper">
                <a href="{{ makeUrl('Wallets') }}">Show more wallets >></a>
        </div>
        
        <br/>

        <div class="row review-cards">
           
            <?$obData = Resource::where("id", "=", "7")->first();?>                 
            <div style="text-align:center; width: 100%;"><h2><?=$obData->name?></h2></div>
            <div style="text-align:center; width: 100%;"><?=$obData->text?></div><br/><br/>
                
                     @include('elements.bookmakers')
                    
                <br/>
            </div>
            <!-- end row -->
                
          <div class="row moreWrapper">
                <a href="{{ makeUrl('Reviews') }}">Show more review >></a>
          </div>

            <br/>
             
             
              <div class="card-box " >
                <div class="col-sm-12">
                    <?$obData = Resource::where("id", "=", "9")->first();?>                 
                    <h2 class="page-title"><?=$obData->name?></h2>
                    <p class="text-muted"><?=$obData->text?></p>
                </div>
            </div>
             
             
             
             <?$obData = Resource::where("id", "=", "10")->first();?>                 
             <div class="row">
                <div class="subscribe-box col-md-6 col-md-offset-3">
                 <h3 class="free"><?=$obData->name?></h3>
                 </hgroup>
                 <div class="well">
                     <form action="#">
                      <div class="input-group">
                         <input class="btn btn-lg" name="email" id="email" type="email" placeholder="Your Email" required>
                         <button class="btn btn-primary btn-lg" type="submit">Submit</button>
                      </div>
                     </form>
                 </div>
                 <small class="promise"><em><?=$obData->text?></em></small>
                </div>
            </div>   
            <br/><br/>
                
    
    
    
         <div id="chartdiv"></div>      
</div>                        
@endsection




@section('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/chartist/dist/chartist.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/subscribe.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<style>
    .moreWrapper{
            text-align: right;
            display: block;
            width: 100%;
            height: 50px;
    }
    
        
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
    
    
</style>
@endsection

@section('js')
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

 <!-- Raty-fa -->
<script src="assets/plugins/raty-fa/jquery.raty-fa.js"></script>
<!--Chartist Chart-->
<script src="{{ asset('assets/plugins/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('assets/plugins/chartist/dist/chartist-plugin-tooltip.min.js') }}"></script>


<?//Crypto compare?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.2/socket.io.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cryptoqween.github.io/streamer/ccc-streamer-utilities.js"></script>
<?//highcharts ?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>

<script src="{{ asset('assets/pages/main.js') }}"></script>

@endsection