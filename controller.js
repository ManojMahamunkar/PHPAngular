var app = angular.module('myApp', []);
app.controller('userCtrl', function($scope, $http) {
	
	
	
	/** function to view All Users **/

		$scope.getUser = function() { 
		
		$http.get("/Angular/call_function.php?request=get_users").success(function(response)
		{
			$scope.data = response.records;
		});
      
    }
	
	
	/** function to Create New Users **/
	$scope.NewUser = function() { 
		$scope.update_user = false;
		$scope.add_user = true;
		
    }
	
	
	/** function to Create New Users **/
	$scope.CreateUser = function() { 
	
		$http.post('/Angular/call_function.php?request=insert_user', 
                    {
                       
                        'create_user_name' : $scope.create_user_name, 
                        'create_user_desig': $scope.create_desig, 
                        'create_user_doj'  : $scope.create_doj
                        
                    }
                  )
        .success(function (data, status, headers, config) {               
			
				alert("Created User Succesfull");
				$('#myModal2').modal('hide');
				$scope.getUser();
			 
        })

        .error(function(data, status, headers, config){
           
		   alert("Problem In Creating User");
        });
      
      
    }
	
	
	   /** function to view data to edit **/

	 $scope.ViewUser = function(index) { 
		$scope.update_user = true;
		$scope.add_user = false;
      $http.post('/Angular/call_function.php?request=view_user', 
            {
                'prod_index'     : index
            }
        )      
        .success(function (data, status, headers, config) {               
			$scope.id          =   data[0]["id"];
			$scope.user_name    =   data[0]["name"];
            $scope.desig        =   data[0]["desig"];
            $scope.doj        =   data[0]["doj"];
			
        })

        .error(function(data, status, headers, config){
           
		   alert("Problem In Fetching Data");
        });
      
    }
	
	/** function to  edit **/
	
     $scope.UpdateUser = function() {  
	
     $http.post('/Angular/call_function.php?request=update_user', 
                    {
                        'id'        : $scope.id ,
                        'user_name' : $scope.user_name, 
                        'desig': $scope.desig, 
                        'doj'  : $scope.doj
                        
                    }
                  )
        .success(function (data, status, headers, config) {               
			
				alert("Updated Succesfull");
				$('#myModal').modal('hide'); 
				$scope.getUser();
			
			 
        })

        .error(function(data, status, headers, config){
           
		   alert("Problem In Updating Data");
        });
      
    }
	
	
	/** function to delete product from list of product referencing php **/

    $scope.DeleteUser = function(index) {  
     var x = confirm("Are you sure to delete the selected user");
     if(x){
      $http.post('/Angular/call_function.php?request=delete_user', 
            {
                'prod_index'     : index
            }
        )      
        .success(function (data, status, headers, config) {               
             
             alert("User has been deleted Successfully");
			 $scope.getUser();
        })

        .error(function(data, status, headers, config){
           
        });
      }else{

      }
    }
	
	
});


