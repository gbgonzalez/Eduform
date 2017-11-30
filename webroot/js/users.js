
var app = angular.module('eduform', []);
	app.controller('AppCtrl',function($scope, $http) {

		$scope.users = users.users;
		$scope.showFilter = false;
		$scope.resultSearch = [];

		$scope.filterSelected = "Nombre";
		$scope.filterType = {
		    types: [
		    {name: 'Nombre'},
		    {name: 'DNI'},
		    {name: 'Tipo'},
		    {name: 'Email'},
		    {name: 'Dirección'}
		    ]
		   };

		

		
		$scope.searchUser = function(criteria){
			if ( criteria != ''){
				$scope.showFilter = true;
				var j = 0;
				$scope.resultSearch = [];
				switch($scope.filterSelected) {
				    case "Nombre":
				        for ( var i = 0; i<$scope.users.length; i++)
						{
						userName = $scope.users[i].username.toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( userName.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.users[i];
		                        j++;
		                    }
						}// end of for filter
				        break;
				    case "DNI":
				        for ( var i = 0; i<$scope.users.length; i++)
						{
						dni = $scope.users[i].dni.toString().toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( dni.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.users[i];
		                        j++;
		                    }
						}// end of for filter
				        break;
				    case "Tipo":
				        for ( var i = 0; i<$scope.users.length; i++)
						{
						typeUser = $scope.users[i].role.toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( typeUser.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.users[i];
		                        j++;
		                    }
						}// end of for filter
				        break;
				    case "Email":
				        for ( var i = 0; i<$scope.users.length; i++)
						{
						emailUser = $scope.users[i].email.toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( emailUser.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.users[i];
		                        j++;
		                    }
						}// end of for filter
				        break;
				    case "Dirección":
				        for ( var i = 0; i<$scope.users.length; i++)
						{
						addressUser = $scope.users[i].address.toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( addressUser.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.users[i];
		                        j++;
		                    }
						}// end of for filter
				        break;
				  
				}
			

				
			}else{
				$scope.showFilter = false;
			}
		}// end of function searchUser
	});