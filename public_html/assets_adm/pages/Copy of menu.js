mainApp.controller("menuController", function ($scope, $http, $document) {
		$scope.Menu = Menu;
		
		/*
		$scope.moveUp = function(){
			
			if(typeof $scope.Menu.selectedIndex == "undefined")
				return false;
			
			if(typeof $scope.Menu.items[$scope.Menu.selectedIndex - 1] == "undefined"){
				$scope.Menu.selectedIndex = $scope.Menu.items.length - 1;
				obPrevItem = $scope.Menu.items[$scope.Menu.selectedIndex];
				$scope.Menu.selectedItem.sort = obPrevItem.sort + 1;
			} else
			{ 
				obPrevItem = $scope.Menu.items[$scope.Menu.selectedIndex];
				$scope.Menu.selectedItem.sort = obPrevItem.sort - 1;
			}

			$scope.Menu.items.sort(function(a, b) {
				return b.sort < a.sort;
			 });		
			 
		}
		
		$scope.moveDown = function(){
			
			if(typeof $scope.Menu.selectedIndex == "undefined")
				return false;
				
				
				console.log($scope.Menu.selectedIndex);
			
			
			if(typeof $scope.Menu.items[$scope.Menu.selectedIndex + 1] == "undefined"){
				$scope.Menu.selectedIndex = 0;
				obNextItem = $scope.Menu.items[$scope.Menu.selectedIndex];
				$scope.Menu.selectedItem.sort = obNextItem.sort - 1;
			} else
			{ 
				itemPlus1 = (typeof $scope.Menu.items[$scope.Menu.selectedIndex + 1] == "undefined") ? $scope.Menu.selectedItem : $scope.Menu.items[$scope.Menu.selectedIndex + 1];
				itemPlus2 = (typeof $scope.Menu.items[$scope.Menu.selectedIndex + 2] == "undefined") ? 1 : 1; 
				
				$scope.Menu.selectedIndex++;
				obNextItem = $scope.Menu.items[$scope.Menu.selectedIndex];
				$scope.Menu.selectedItem.sort = (scope.Menu.selectedItem.sort + obNextItem.sort) / 2	
			}

			$scope.Menu.items.sort(function(a, b) {
				return b.sort < a.sort;
			 });			
		}*/
		
		$scope.selectItem = function(index, item){
			scope.Menu.selectedIndex = index;
			$scope.Menu.selectedItem = item;	
		}
		
		
		$scope.saveMenu = function(){
			
			alert();
			
			console.log($scope.Menu.items);
			
			
			
			/*
			$http.post("/dashboard/updateMenu",  {"data" : JSON.stringify($scope.Menu.items)}, {}).then(function(data){
					console.log("success", data);
					//hidePreloader();
				}, function(data){
					console.log("error", data);
					//hidePreloader();
				}
			);
			
			*/
				
		}
		
		$scope.showAddForm  = function(){
			$scope.Menu.showAddForm = true;
			if($scope.Menu.selectedIndex){
				obCurItem = $scope.Menu.items[$scope.Menu.selectedIndex];
				$scope.Menu.AddForm.sort = obCurItem.sort + 1;
				$scope.Menu.AddForm.level = obCurItem.level;
			}else{
				$scope.Menu.AddForm.sort = $scope.Menu.items.length;
				$scope.Menu.AddForm.level = 1;
			} 
			
		}
		
		$scope.sendAddForm = function(){
			
			
			
			
			
			/*$http.post("/dashboard/addMenu",  $scope.Menu.AddForm, {}).then(function(responce){
					$scope.Menu.showAddForm = false;
					$scope.Menu.AddForm = { id : 0, name : "", level : 0, sort : 0, url : ""};
					$scope.Menu.items.push(responce.data);
					$scope.Menu.items.sort(function(a, b) {
						return b.sort < a.sort;
					 });	
				}, function(data){
					console.log("error", data);
				}
			);*/	
		}
	
});


