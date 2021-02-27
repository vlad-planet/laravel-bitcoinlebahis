
function encodeImageFileAsURL(element) {
	  var file = element.files[0];
	  var reader = new FileReader();
	  reader.onloadend = function() {
	    console.log('RESULT', reader.result)
	  }
  	reader.readAsDataURL(file);
}

mainApp.controller("resourceController", function ($scope, $http, $document) {
		
		$scope.resourceTypes = ResourceTypes;
		$scope.Resource = Resource;		
		$scope.currentType = $scope.resourceTypes[Resource.type];
	
		$scope.changeType =  function() {
			$scope.Resource.type = $scope.currentType.id;
			window.location.replace("/dashboard/editResource/" + $scope.Resource.type + "/0");
		}
		
		$scope.sendAddForm = function() {
			Preloader.show();
			$scope.Resource.text = CKEDITOR.instances.editor.getData();
			
			$http.post("/dashboard/updateResource", $scope.Resource, {}).then(function(responce){
				//if(responce.data.redirect)
				//	window.location.replace("/dashboard/editResource/" + responce.data.resource.id);
					
				Preloader.hide();
					
				}, function(data){
					console.log("error", data);
				}
			);
			
		}
		
		
		
		
});



