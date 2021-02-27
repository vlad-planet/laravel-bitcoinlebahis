/**
Template Name: Uplon Dashboard
Author: CoderThemes
Email: coderthemes@gmail.com
File: Chartjs
*/

/**
Template Name: Uplon Dashboard
Author: CoderThemes
Email: coderthemes@gmail.com
File: Chartjs
*/


var currencyList = {
	items : [
       
	]
};

mainApp.controller("mainController", function ($scope, $http, $document) {
		$scope.setCurrency = function(){
			["BTC-USD","ETH-USD","DASH-USD","ZEC-USD"]
				.forEach(function(currencyPair, index, array) {
				    $http({
						method: 'GET',
						url: '/getHistory/' + currencyPair
					}).then(function successCallback(response) {
						
						currencyList.items[index] = response.data;
						$scope.currencyList = currencyList;	
									
						console.log(response.data.CurrencyPair.name )			
										
						if(response.data.CurrencyPair.name == "BTC-USD")
							$scope.setGraph(response.data.Data);
						
					}, function errorCallback(response) {
			
					});
			});
		}
		
		$scope.setCurrency();
		
		
		$scope.setGraph = function(data, bScroll){
			var arLabels = [];
			var arItems  = [];
			
			data.forEach(function(item, i, arr) {
	    	
	    	var t = new Date(item.time * 1000).toLocaleTimeString().split(":");
		    	if( i % 5 == 0 ){
		    		arLabels.push(t[0] + ":" + t[1]);
		    		arItems.push(item.high);
		    	}	
			});
			
			chart = new Chartist.Line('#course', {
				  labels: arLabels,
				  series: [
				    arItems
				  ]
			}, {
				  low:  Math.min.apply(Math, arItems),
				  showArea: false,
				  showPoint: true,
				  fullWidth: true
			});
			
			if(bScroll){
				$('html, body').animate({
			        scrollTop: $('[data-s-course]').offset().top - 130
			    }, 500);	
			}
		}
		

	
});


var arLabels = [];
var arItems = [];

var bitcoinData = {"Response":"Success","Type":100,"Aggregated":false,"Data":[{"time":1512514800,"close":11667.13,"high":11745.77,"low":11657.28,"open":11729.15,"volumefrom":5289.47,"volumeto":61834984.65},{"time":1512518400,"close":11837.56,"high":11837.8,"low":11661.76,"open":11667.13,"volumefrom":6076.14,"volumeto":71400190.14},{"time":1512522000,"close":11903.13,"high":11906.48,"low":11821.53,"open":11837.38,"volumefrom":6717.43,"volumeto":79643634.28},{"time":1512525600,"close":12152.65,"high":12155.87,"low":11895.51,"open":11901.78,"volumefrom":12123.82,"volumeto":146085543.34},{"time":1512529200,"close":12240.81,"high":12281.69,"low":12151.82,"open":12152.65,"volumefrom":8874.12,"volumeto":108338657.98},{"time":1512532800,"close":12220.31,"high":12263.41,"low":12146.05,"open":12240.81,"volumefrom":5692.85,"volumeto":69520108.87},{"time":1512536400,"close":12264.58,"high":12264.59,"low":12169.73,"open":12220.31,"volumefrom":5499.01,"volumeto":67072246.33},{"time":1512540000,"close":12422.72,"high":12422.78,"low":12266.61,"open":12266.7,"volumefrom":6746.63,"volumeto":83378539.52},{"time":1512543600,"close":12416.22,"high":12491.93,"low":12389.51,"open":12422.72,"volumefrom":8201.8,"volumeto":101958162.96},{"time":1512547200,"close":12471.57,"high":12509.8,"low":12384.16,"open":12416.51,"volumefrom":5138.21,"volumeto":63975197.02},{"time":1512550800,"close":12580.95,"high":12588.79,"low":12443.61,"open":12471.81,"volumefrom":5389.83,"volumeto":67537756.52},{"time":1512554400,"close":12817.93,"high":12818.09,"low":12558.57,"open":12580.95,"volumefrom":6426.79,"volumeto":81590946.28},{"time":1512558000,"close":12629.43,"high":12851.53,"low":12445.13,"open":12818.2,"volumefrom":9770.12,"volumeto":123317164.43},{"time":1512561600,"close":12726.6,"high":12747.51,"low":12625.57,"open":12628.99,"volumefrom":4669.16,"volumeto":59244793.9},{"time":1512565200,"close":12679.9,"high":12779.01,"low":12611.18,"open":12726.95,"volumefrom":6285.2,"volumeto":79799255.61},{"time":1512568800,"close":12796.48,"high":12807.46,"low":12676.58,"open":12680.47,"volumefrom":5494.18,"volumeto":70170718.8},{"time":1512572400,"close":12495.74,"high":12801.02,"low":12480.52,"open":12800.68,"volumefrom":7771.96,"volumeto":98563494.32},{"time":1512576000,"close":12631.27,"high":12636.14,"low":12391.12,"open":12495.55,"volumefrom":8580.18,"volumeto":107588935.58},{"time":1512579600,"close":12692.55,"high":12711.43,"low":12595.07,"open":12632.49,"volumefrom":4658.07,"volumeto":59065329.56},{"time":1512583200,"close":12865.3,"high":12865.3,"low":12688.06,"open":12690.91,"volumefrom":3350.36,"volumeto":42905314.78},{"time":1512586800,"close":13129.6,"high":13129.6,"low":12856.8,"open":12864.83,"volumefrom":11310.51,"volumeto":147160403.24},{"time":1512590400,"close":13195.39,"high":13197.99,"low":13032.97,"open":13126.7,"volumefrom":13535.11,"volumeto":177765719.97},{"time":1512594000,"close":13268.86,"high":13270.12,"low":13114.26,"open":13194.53,"volumefrom":8322.38,"volumeto":109749283.81},{"time":1512597600,"close":13840.52,"high":13841.99,"low":13252.97,"open":13268.99,"volumefrom":15539.29,"volumeto":211065478.67},{"time":1512601200,"close":13552.48,"high":13843.2,"low":13480.3,"open":13838.01,"volumefrom":5634.67,"volumeto":76852536.52}],"TimeTo":1512601200,"TimeFrom":1512514800,"FirstValueInArray":true,"ConversionType":{"type":"direct","conversionSymbol":""}}

!function($) {
    "use strict";
    
    $('[data-s-rating]').each(function(){
    	$(this).raty({
	        number: 5,
	    	readOnly: true,
	    	score: $(this).data("score")
	    });
    })

}(window.jQuery);

