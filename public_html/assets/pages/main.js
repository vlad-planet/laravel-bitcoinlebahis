var currentPrice = {};
var socket = io.connect('https://streamer.cryptocompare.com/');

mainApp.controller("mainController", function ($scope, $http, $document) {
	
	$scope.currencies = {
		items : {
			"BTC" : {
				"FROMSYMBOL" : "BTC",
				"TOSYMBOL" : "USD",
				"ICON" : "cf cf-btc",
			},
			"ETH" : {
				"FROMSYMBOL" : "ETH",
				"TOSYMBOL" : "USD",
				"ICON" : "cf cf-eth",
			},
			"DASH" : {
				"FROMSYMBOL" : "DASH",
				"TOSYMBOL" : "USD",
				"ICON" : "cf cf-dash",
			},
			"ZEC" : {
				"FROMSYMBOL" : "ZEC",
				"TOSYMBOL" : "USD",
				"ICON" : "cf cf-zec",
				
			},
		},
		
		subscribe : ["5~CCCAGG~BTC~USD", "5~CCCAGG~ETH~USD", "5~CCCAGG~DASH~USD", "5~CCCAGG~ZEC~USD"]
	};
	
	
	
	$scope.dataUnpack = function(data) {
        var from = data['FROMSYMBOL'];
        var to = data['TOSYMBOL'];
        var fsym = CCC.STATIC.CURRENCY.getSymbol(from);
        var tsym = CCC.STATIC.CURRENCY.getSymbol(to);
        var pair = from + to;

        if (!currentPrice.hasOwnProperty(pair)) {
            currentPrice[pair] = {};
        }

        for (var key in data) {
            currentPrice[pair][key] = data[key];
        }

        if (currentPrice[pair]['LASTTRADEID']) {
            currentPrice[pair]['LASTTRADEID'] = parseInt(currentPrice[pair]['LASTTRADEID']).toFixed(0);
        }
        
        
        currentPrice[pair]['PRICE_FORMATED'] = CCC.convertValueToDisplay(tsym, currentPrice[pair]['PRICE']);
        currentPrice[pair]['CHANGE24HOURRAW'] = currentPrice[pair]['PRICE'] - currentPrice[pair]['OPEN24HOUR'];
        currentPrice[pair]['CHANGE24HOUR'] = CCC.convertValueToDisplay(tsym, (currentPrice[pair]['PRICE'] - currentPrice[pair]['OPEN24HOUR']));
        currentPrice[pair]['CHANGE24HOURPCT'] = ((currentPrice[pair]['PRICE'] - currentPrice[pair]['OPEN24HOUR']) / currentPrice[pair]['OPEN24HOUR'] * 100).toFixed(2) + "%";;
        
        return currentPrice[pair];
    };
	
    	
    $scope.updatePrice = function(res) {
    	current = $scope.dataUnpack(res);
    	$scope.$apply(function () {
    		if(current.FROMSYMBOL in $scope.currencies.items){
    			$scope.currencies.items[current.FROMSYMBOL] = Object.assign($scope.currencies.items[current.FROMSYMBOL] , current);
    		}
        });
    };
    
    
    $scope.setChar = function(fromCurrency, toCurrency, bScroll) {
			$http.get("https://min-api.cryptocompare.com/data/histohour?fsym=" + fromCurrency + "&tsym=USD&limit=2000&aggregate=17&e=CCCAGG", {}, {})
				.then(function(responce) {
					if('Data' in responce.data){
						var data = [];
						responce.data.Data.forEach(function(item, i, arr) {
							data.push([item.time * 1000, item.close]);
						});
						Highcharts.stockChart('container', {
			                rangeSelector: {
			                    selected: 1
			                },
			                title: {
			                    text: fromCurrency + ' in ' + toCurrency 
			                },
			                series: [{
			                    name: toCurrency ,
			                    data: data,
			                    tooltip: {
			                        valueDecimals: 2
			                    }
			                }]
			            });
			            
			            if(bScroll){
							$('html, body').animate({
						        scrollTop: $('[data-s-course]').offset().top - 130
						    }, 500);	
						}
			            
					}
					
				},  function(data){ console.log("error", data); }
			);
		}
		
    
	$scope.setChar('BTC', 'USD', false);
	
	socket.on("m", function(message) {
        var messageType = message.substring(0, message.indexOf("~"));
        var res = {};
        if (messageType == CCC.STATIC.TYPE.CURRENTAGG) {
            res = CCC.CURRENT.unpack(message);
            $scope.updatePrice(res);
        }
        
    });
	
	socket.emit('SubAdd', { subs: $scope.currencies.subscribe });
	
});	
	