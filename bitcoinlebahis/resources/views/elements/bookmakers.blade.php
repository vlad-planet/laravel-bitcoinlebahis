<?
use App\Reviews;
?> 
        
        
<?$obReviews = Reviews::limit(4)->get();
foreach($obReviews as $obItem):?>
     <div class="col-sm-4 col-lg-3 col-xs-12">
        <div class="card">
            <a href="{{ makeUrl('Reviews', $obItem->code) }}">
                <div class="bg-preview" style="background-image: url('{{$obItem->image}}');"></div>
            </a>                
            <div class="card-block">                           
               <div class="text-xs-center">
                    
                    <a href="/content/Reviews/{{$obItem->code}}">
                        <h4 class="card-title">{{$obItem->name}}</h4>
                    </a>
                    <h6 class="card-subtitle text-muted">{{$obItem->bonus}}</h6>
                    <br>
                    <h3>
                        <i class="fa fa-fw fa-star" title="gorgeous" data-score="1"></i> 
                        <span>{{$obItem->rating}}</span>
                    </h3>
                </div>
                <br>
                <p>{{$obItem->anonce}}</p>
                <br/>
                <div class="text-xs-center">
                    <a href="{{ makeUrl('Reviews', $obItem->code) }}" class="btn btn-primary">Read review</a>
                    <a href="{{$obItem->site}}" class="btn btn-success">Go to site</a>
                </div>
            </div>
        </div>
    </div>
<?endforeach;?> 
        