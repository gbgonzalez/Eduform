
var app = angular.module('eduform', []);
	app.controller('AppCtrl',function($scope, $http) {

		$scope.users = users.users;
		$scope.showFilter = false;
		$scope.resultSearch = [];

		$scope.filterSelected = "Todos";
		$scope.filterType = {
		    types: [
		    	{name: 'Todos'},
		       {name: 'Administador'},
		      {name: 'Gestor de contenidos'},
		      {name: 'Alumno'}
		    ]
		   };

		

		
		$scope.searchUser = function(criteria){
			if ( criteria != ''){
				$scope.showFilter = true;
				var j = 0;
				$scope.resultSearch = [];
				switch($scope.filterSelected) {
				    case "Administador":
				        for ( var i = 0; i<$scope.users.length; i++)
						{
						userName = $scope.users[i].username.toLowerCase();
						role = $scope.users[i].role;
		                criteria = criteria.toLowerCase();
		               
		                if( userName.search( criteria ) != -1 && role == "Administrator")
		                    {
		                       	$scope.resultSearch[j] = $scope.users[i];
		                        j++;
		                    }

						}// end of for filter
				        break;
				    case "Alumno":
				       for ( var i = 0; i<$scope.users.length; i++)
						{
						userName = $scope.users[i].username.toLowerCase();
						role = $scope.users[i].role;
		                criteria = criteria.toLowerCase();
		               
		                if( userName.search( criteria ) != -1 && role == "Alumno")
		                    {
		                       	$scope.resultSearch[j] = $scope.users[i];
		                        j++;
		                    }

						}// end of for filter
				        break;
				    case "Gestor de contenidos":
				        for ( var i = 0; i<$scope.users.length; i++)
						{
						userName = $scope.users[i].username.toLowerCase();
						role = $scope.users[i].role;
		                criteria = criteria.toLowerCase();
		               
		                if( userName.search( criteria ) != -1 && role == "Gestor de contenidos")
		                    {
		                       	$scope.resultSearch[j] = $scope.users[i];
		                        j++;
		                    }

						}// end of for filter
				        break;
				    default:
				        for ( var i = 0; i<$scope.users.length; i++)
						{
						userName = $scope.users[i].username.toLowerCase();
		                criteria = criteria.toLowerCase();
		               
		                console.log(userName.search(criteria));
		                if( userName.search( criteria ) != -1)
		                    {
		                    	 console.log("entra");
		                       	$scope.resultSearch[j] = $scope.users[i];
		                        j++;
		                    }

						}// end of for filter
				}
			

				
			}else{
				$scope.showFilter = false;
			}
		}// end of function searchUser
	});