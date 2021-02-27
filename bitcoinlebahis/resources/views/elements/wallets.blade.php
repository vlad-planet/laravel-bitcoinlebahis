<?
use App\Wallets;
?> 
        
<?
$obWalleets = Wallets::limit(4)->get();
foreach($obWalleets as $obItem):?>
    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
        <div class="card-box tilebox-three">
            <div class="bg-icon pull-xs-left">
                  <a href="{{ makeUrl('Wallets', $obItem->code) }}">
                    <img class="preview" src="{{$obItem->image}}" height="78">
                  </a>
            </div>
            <div class="text-xs-right">
                
                <a href="{{ makeUrl('Wallets', $obItem->code) }}">
                    <h6 class="text-success text-uppercase m-b-15 m-t-10">{{$obItem->name}}</h6>
                </a>
                                            
                <h2 class="m-b-10">
                    <i class="fa fa-fw fa-star" title="gorgeous" data-score="1"></i> 
                    <span>{{$obItem->rating}}</span>
                </h2>
                
                
                <div class="info-box">
                    <h6>Ease of use</h6>
                    <progress class="progress progress-striped progress-xs progress-warning m-b-0" value="{{$obItem->ease_of_use}}" max="100"></progress>
                </div>
                
                <div class="info-box">
                   <h6>Anonymity</h6>
                    <progress class="progress progress-striped progress-xs progress-warning m-b-0" value="{{$obItem->anonymity}}" max="100"></progress>
                </div>
                
                <div class="info-box">
                    <h6>Supported coins</h6>
                    {{$obItem->coins}}
                </div>
                
                  <div class="info-box">
                    <h6>Platforms</h6>
                    {{$obItem->platforms}}
                </div>
                
            </div>
        </div>
    </div>
<?endforeach?>    