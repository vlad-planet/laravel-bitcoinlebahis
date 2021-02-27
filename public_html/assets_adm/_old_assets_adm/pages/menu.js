mainApp.controller("menuController", function ($scope, $http, $document) {
		$scope.Menu = Menu;

		$scope.Menu.levels = [
			{'label' : 'Parent', 'value' : 0},
			{'label' : 'Child', 'value' : 1}
		];

		$scope.saveMenu = function() {
			$http.post("/dashboard/updateMenu",  {"data" : JSON.stringify($scope.Menu.items)}, {}).then(function(data){
					console.log("success", data);
					//hidePreloader();
				}, function(data){
					console.log("error", data);
					//hidePreloader();
				}
			);
		}

		$scope.showAddForm  = function(){
			$scope.Menu.showAddForm = true;
			$scope.Menu.AddForm = {
				name : '',
				level : 0,
				sort : 0,
				url : '',
			};
		}

		$scope.remove = function(item){
			var index = $scope.Menu.items.indexOf(item);
  			$http.post("/dashboard/removeMenu",  {"id" : item.id}, {}).then(function(responce){
					$scope.Menu.items.splice(index, 1);
				}, function(data){
					console.log("error", data);
				}
			);

		}

		$scope.sendAddForm = function(){
			$http.post("/dashboard/addMenu",  $scope.Menu.AddForm, {}).then(function(responce){
					$scope.Menu.showAddForm = false;
					$scope.Menu.AddForm = { id : 0, name : "", level : 0, sort : 0, url : ""};
					$scope.Menu.items.push(responce.data);
				}, function(data){
					console.log("error", data);
				}
			);
		}
});




$( document ).on('focus', '.bls-adm-menu input, .bls-adm-menu select',  function() {
	tr = $(this).parents("tr");
	if(!tr.hasClass('bg-primary')){
		$('.bls-adm-menu tr').removeClass('bg-primary')
		tr.addClass('bg-primary')
	}
});