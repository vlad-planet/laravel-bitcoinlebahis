<?
use App\Wallets;
use App\Reviews;
?>

@extends('layouts.app')
@section('title', $arResource->title)

@section('content')



<div  ng-controller="coinInfoController" class="coin-detail">
   
   
    <div class="head-box card-box">
        
        <div class="pull-xs-left">
           <div class="coin-box">
               <img width="110" src="<?="https://www.cryptocompare.com".$arResource->ImageUrl?>">
               <h1><?=$arResource->Name?></h1>
               <h3 ng-cloak ng-class="{'up': (Coin.CHANGE24HOURRAW > 0), 'down': (Coin.CHANGE24HOURRAW < 0)}" ng-model="Coin.PREICE" class="price m-b-10">$@{{Coin.PRICE}}</h3> 
           </div>               
        </div>
        
        
        <div class="props text-xs-right">
            
            <div style="min-height:180px;" class="row">
                
              <div class="col-sm-4">
                  
                 
                  <span class="param">Canhge 24 hour:</span>
                  <span ng-cloak ng-model="Coin.LASTUPDATE" ng-class="{'up': (Coin.CHANGE24HOURRAW > 0), 'down': (Coin.CHANGE24HOURRAW < 0)}" class="changed price value">@{{Coin.CHANGE24HOURPCT}} (@{{Coin.CHANGE24HOUR}}) </span><br/>
                  
                  <span class="param">Last update:</span>
                  <span ng-cloak ng-model="Coin.LASTUPDATE"  class="price value">@{{Coin.LASTUPDATE * 1000 | date  : "HH:mm:ss MMM/dd" }}</span><br/>
                  
                  <span ng-cloak class="param">Last market:</span>
                  <span ng-cloak ng-model="Coin.LASTUPDATE" class="value">@{{Coin.LASTMARKET }}</span><br/>
                  
                  
                  
                  
                 
                  
              </div>
              
             
              <div class="col-sm-4">
                  
                  
                   <?/*
                  <span class="param">Block number:</span>
                  <span class="value"><?=!empty($arResource->BlockNumber) ? $arResource->BlockNumber : "-"?></span><br/>
                  
                  <span class="param">Block reward reduction:</span>
                  <span class="value"><?=!empty($arResource->BlockRewardReduction) ? $arResource->BlockRewardReduction : '-' ?></span><br/>
                  
                  
                  <span class="param">Block time:</span>
                  <span class="value"><?=!empty($arResource->BlockTime) ? $arResource->BlockTime : '-'?></span><br/> 
                  
                  <span class="param">Total Coin Supply:</span>
                  <span class="value"><?=!empty($arResource->TotalCoinSupply) ? $arResource->TotalCoinSupply : '-'?></span><br/>
                  
                  */ ?>
                  
                  <span class="param">Algorithm:</span>
                  <span class="value"><?=!empty($arResource->Algorithm) ? $arResource->Algorithm : '-'?></span><br/>
                  
                  <span class="param">Start Date:</span>
                  <span class="value"><?=!empty($arResource->StartDate) ? $arResource->StartDate : '-'?></span><br/>
                  
                  <span class="param">Network P/S:</span>
                  <span class="value"><?=!empty($arResource->NetHashesPerSecond) ? $arResource->NetHashesPerSecond : '-'?></span><br/>
                  
                  <span class="param">Previous Total Coins Mined:</span>
                  <span class="value"><?=!empty($arResource->PreviousTotalCoinsMined) ? $arResource->PreviousTotalCoinsMined : '-'?></span><br/>
                  
                  
              </div>
              
              
              
              <div class="col-sm-4">
                  
                  <span class="param">Website:</span>
                  <span class="value"><?=!empty($arResource->Website) ? $arResource->Website : '-'?></span><br/>
                  
                  <span class="param">Twitter:</span>
                  <span class="value"><?=!empty($arResource->Twitter) ? "<a href='https://twitter.com/".$arResource->Twitter."'>".$arResource->Twitter."</a>" : '-'?></span><br/>
              </div>
              
              
            </div>
            
        </div>
        
        <div ng-init="getChar()" style="clear: both;"></div>
        
    </div> 
    
    
    <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="icon-layers pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Block number</h6>
                    <h2 class="m-b-20" data-plugin="counterup"><?=!empty($arResource->BlockNumber) ? $arResource->BlockNumber : 0?></h2>
               
                </div>
            </div>
            
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="icon-rocket pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Total Coin Supply</h6>
                    <h2 class="m-b-20" data-plugin="counterup"><?=!empty($arResource->TotalCoinSupply) ? $arResource->TotalCoinSupply : 0?></h2>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="icon-clock pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Block time</h6>
                    <h2 class="m-b-20">$<span data-plugin="counterup"><?=!empty($arResource->BlockTime) ? preg_replace('/[^0-9]/', '', $arResource->BlockTime) : 0?></span>%</h2>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="icon-diamond pull-xs-right text-muted"></i>
                    <h6 class="text-muted text-uppercase m-b-20">Block reward reduction</h6>
                    <h2 class="m-b-20"><span data-plugin="counterup"><?=!empty($arResource->BlockRewardReduction) ?  preg_replace('/[^0-9]/', '', $arResource->BlockRewardReduction) : 0 ?></span>%</h2>
                  
                </div>
            </div>

            
    </div>
    
    
  
     <div class="card-box">
         <div class="text">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
        </div>  
    </div>
    
    
      <div class="card-box">
        <div id="container" style="height: 400px; min-width: 310px"></div>
    </div>
  
    
    <div class="row">
        
             @include('elements.coinWallets')           
            
        </div>
    
        
        <div class="row moreWrapper">
                <a href="{{ makeUrl('Wallets') }}">Show more wallets >></a>
        </div>
    
        
        
        <div class="row">  
             @include('elements.bookmakers')
        </div>
        
        
        <div class="row moreWrapper">
            <a href="{{ makeUrl('Reviews') }}">Show more review >></a>
        </div>
     
      
    
</div>


@include('elements.comments')  

        
@endsection


@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

<style>
    
    .moreWrapper{
            text-align: right;
            display: block;
            width: 100%;
            height: 50px;
    }
    
    .coin-detail h1 {
        margin-top:10px;
        text-transform:uppercase;
    }
    
    .coin-detail .coin-box{
        text-align: center;
        margin-left:20px;
    }

    .param{
        font-weight: bold;
        line-height: 30px;
    }
    
    .props {
        margin-top: 30px;
    }
    
    
    .price{
        font-weight: bold;
    }
    
    .price.changed {
        font-size: 16px;
    }
    
    
    .price.up{
        color: #3d9400;
    }
    
    .price.down{
        color: #A11B0A;
    }
    
    @media screen and (max-width: 680px){
        .props .row {
            display: block !important;
        }
        
        .head-box .pull-xs-left, .head-box .text-xs-right{
            float: none !important;
            text-align: center !important;
        }    
    }
    
    
</style>    




@endsection

<script>
var Coin = {
    "FROMSYMBOL" : "<?=$arResource->Symbol?>",
    "TOSYMBOL" : "USD",
    "PRICE" : 0,
};
var subscription = ['5~CCCAGG~<?=$arResource->Symbol?>~USD'];
</script>


@section('js')
 <!-- Raty-fa -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.2/socket.io.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cryptoqween.github.io/streamer/ccc-streamer-utilities.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="/assets/pages/coins.detail.js"></script>
<script src="/assets/plugins/raty-fa/jquery.raty-fa.js"></script>


<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5a5df21e032b920011311197&product=viral-notifications' async='async'></script>



@endsection