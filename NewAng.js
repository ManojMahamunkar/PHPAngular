var app = angular.module('myApp', []);
app.controller('userCtrl', function($scope, $http) {
		
		$http.get("/Angular/call_function.php?request=all")
		.success(function (response) {
		$scope.data = response.records;
	});
	
	$scope.ViewUser = function(id) {
		var edit_id = id;
		
		$scope.SaveUser = true;
		$http.get("/Angular/call_function.php?request=per_id&request_id="+edit_id)
		.success(function (response) {
		$scope.editdata = response.editrecords;
		$scope.name =$scope.editdata[0].name;
		$scope.desig =$scope.editdata[0].desig;
		$scope.doj =$scope.editdata[0].doj;
		
		});
		
		
	};	
	
	$scope.SaveUser = function() {
		
		var dataObj = {
				'id' : $scope.editdata[0].id,
				'name' : $scope.name,
				'desig' : $scope.desig,
				'doj':$scope.doj
					
		};	
		
		
			/*
				var res = $http.post('http://localhost/Angular/call_function.php?request=save_user', dataObj);
				res.success(function(data, status, headers, config) {
				$scope.message = data;
				alert($scope.message);
				});
			*/	
	  
		$.ajax({

          type: "POST",
		  url: "call_function.php?request=save_user",          
		  data:dataObj,         
  		  success: function(result){
 				 alert(result);  
			  }

			});
	};	
	
	
	
});
