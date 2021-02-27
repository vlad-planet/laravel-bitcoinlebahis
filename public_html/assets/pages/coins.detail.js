//angular.module("mainApp").requires.push('chart.js');

mainApp.controller("coinInfoController", function ($scope, $http, $document) {
	$scope.Coin = Coin;
	
	console.log($scope.Coin);
	
	$scope.getChar = function() {		
		$http.get("https://min-api.cryptocompare.com/data/histohour?fsym="+ $scope.Coin.FROMSYMBOL + "&tsym=USD&limit=2000&aggregate=17&e=CCCAGG", {}, {}).then( function(responce) {
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
		                    text: $scope.Coin.FROMSYMBOL + ' in ' + $scope.Coin.TOSYMBOL 
		                },
		        
		                series: [{
		                    name: $scope.Coin.TOSYMBOL ,
		                    data: data,
		                    tooltip: {
		                        valueDecimals: 2
		                    }
		                }]
		            });
				
			}
				
			},  function(data){ console.log("error", data); }
		);
	}
	
	var currentPrice = {};
    var socket = io.connect('https://streamer.cryptocompare.com/');
    //Format: {SubscriptionId}~{ExchangeName}~{FromSymbol}~{ToSymbol}
    //Use SubscriptionId 0 for TRADE, 2 for CURRENT and 5 for CURRENTAGG
    //For aggregate quote updates use CCCAGG as market
    socket.emit('SubAdd', { subs: subscription });
    socket.on("m", function(message) {
        var messageType = message.substring(0, message.indexOf("~"));
        var res = {};
        if (messageType == CCC.STATIC.TYPE.CURRENTAGG) {
            res = CCC.CURRENT.unpack(message);
            dataUnpack(res);
        }
    });

    var dataUnpack = function(data) {
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
        currentPrice[pair]['CHANGE24HOURRAW'] = currentPrice[pair]['PRICE'] - currentPrice[pair]['OPEN24HOUR'];
        currentPrice[pair]['CHANGE24HOUR'] = CCC.convertValueToDisplay(tsym, (currentPrice[pair]['PRICE'] - currentPrice[pair]['OPEN24HOUR']));
        currentPrice[pair]['CHANGE24HOURPCT'] = ((currentPrice[pair]['PRICE'] - currentPrice[pair]['OPEN24HOUR']) / currentPrice[pair]['OPEN24HOUR'] * 100).toFixed(2) + "%";;
        $scope.displayData(currentPrice[pair], from, tsym, fsym);
    };
    	
    	
    $scope.displayData = function(current, from, tsym, fsym) {
    	$scope.$apply(function () {
    		$scope.Coin = current;
        });
    };
});	


