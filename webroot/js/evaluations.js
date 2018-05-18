var app = angular.module('eduform', []);
	app.controller('AppCtrl',function($scope, $http) {

		$scope.evaluations = evaluations.evaluations;

		$scope.filterSelected = "Nombre";

		$scope.resultSearch = [];

		$scope.filterType = {
		    types: [
		    {name: 'Nombre'},
		    {name: 'Email'},
		    {name: 'Competencia'}
		    ]
		   };	

		  $scope.searchEvaluation = function(criteria){
			if ( criteria != ''){
				$scope.showFilter = true;
				var j = 0;
				$scope.resultSearch = [];
				switch($scope.filterSelected) {
				    case "Nombre":
				        for ( var i = 0; i<$scope.evaluations.length; i++)
						{
						userName = $scope.evaluations[i].username.toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( userName.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.evaluations[i];
		                        j++;
		                    }
						}// end of for filter
				        break;
				    case "Email":
				        for ( var i = 0; i<$scope.evaluations.length; i++)
						{
						email = $scope.evaluations[i].email.toString().toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( email.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.evaluations[i];
		                        j++;
		                    }
						}// end of for filter
				        break;
				    case "Competencia":
				        for ( var i = 0; i<$scope.evaluations.length; i++)
						{
						name = $scope.evaluations[i].name.toString().toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( name.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.evaluations[i];
		                        j++;
		                    }
						}// end of for filter
				        break;
				  
				}	
			}else{
				$scope.showFilter = false;
			}
		}// end of function searchCategory	

	});