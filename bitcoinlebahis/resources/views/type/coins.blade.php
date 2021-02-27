@extends('layouts.app')

@section('content')

<div  ng-controller="coinsController" class="row" ng-cloak>
     <h1 style="margin: 20px 0 20px 0;">Coins List</h1>
   
      <div style="width: 100%; padding:10px;" class="card">
     
         <div class="card coinItem coinHead">
            
            <div class="row">
                <div class="coinName col-sm-3">
                    <b>Name</b>
                </div>
                <div class="col-sm-3">
                    <b>Price</b>
                </div>
                <div  class="col-sm-3">
                   <b>Canhge 24 hour</b> 
                </div>
                <div class="col-sm-3">
                    <b>Chart</b>
                </div>  
            </div>       
         </div>
         
          
         <div ng-cloak ng-model="Coins" ng-repeat="item in Coins"  class="card coinItem">
            <div class="row">
                
                <div class="coinName col-sm-3">
                    <a href="/content/Coins/@{{item.CoinInfo.Id}}">
                        <img class="coinPreview" src="https://www.cryptocompare.com@{{item.CoinInfo.ImageUrl}}">   
                        <b>[@{{item.CoinInfo.Name}}]</b> @{{item.CoinInfo.FullName}}
                    </a>
                </div>
                <div class="col-sm-3">
                    <span ng-model="item.PRICE_USD.PRICE">@{{item.PriceInfo.PRICE_FORMATED}}<span>
                </div>
                <div ng-model="item.PRICE_USD.CHANGE24HOURPCT" class="col-sm-3">
                   @{{item.PriceInfo.CHANGE24HOURPCT}}
                </div>
                <div class="col-sm-3">
                    <img class="spark-img" src="https://images.cryptocompare.com/sparkchart/@{{item.CoinInfo.Name}}/USD/latest.png">
                </div>  
            </div>       
             
         </div>
         
         <div class="row">
              <button style="text-transform:uppercase; margin: 0 auto;" ng-click="showMore()" class="btn btn-lg btn-primary btn-rounded waves-effect waves-light">show more</button>
         </div>
         
       
        
        
    </div>
    
    
</div>
@endsection




@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<style>

    .coinItem {
        width:100%;
        min-height: 40px;
        padding: 15px 10px 5px 10px;
    }
    
    .coinHead {
        background-color: #2b3d51;
        color: #fff;
         padding: 10px;
    }
    

    .coinHead .coinName b{
        color: #fff;
    }
    
    .coinItem .col-sm-3{
        text-align:center;
    }
    
   
    .coinName.col-sm-3{
        text-align:left;
    }
    .coinName b{
        color:black;
        font-family: monospace;
    }
    
     .coinName > a{
        color: #2b3d51; font-family: fantasy;
         
     }
    
    
    .coinPreview {
        display: inline-block;
        margin: 2px;
        width: 20px;
        height: 20px;
    }
    
    .text-center{
        text-align: center;
    }
    
    @media screen and (max-width: 750px){
       
        .col-sm-3, .col-sm-3.coinName {
            text-align: center;
            display: block;
            flex: none;
            position: static;
            width: 100%;
        }
    }
    
    
    
</style>

@endsection

@section('js')
 <!-- Raty-fa -->
 

<?/*<script src="{{ asset('assets/js/ng-infinite-scroll.min.js?c=1') }}"></script>*/?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.2/socket.io.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cryptoqween.github.io/streamer/ccc-streamer-utilities.js"></script>


<script src="{{ asset('assets/pages/coins.js?c=3') }}"></script>

<script src="assets/plugins/raty-fa/jquery.raty-fa.js"></script>
<script src="assets/plugins/raty-fa/jquery.raty-fa.js"></script>
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5a5df21e032b920011311197&product=viral-notifications' async='async'></script>
@endsection