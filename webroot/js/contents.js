var app = angular.module('eduform', []);
	app.controller('AppCtrl',function($scope, $http) {

		$scope.contents = contents.contents;

		$scope.showFilter = false;
		$scope.resultSearch = [];

		$scope.filterSelected = "Nombre";
		$scope.filterType = {
		    types: [
		    {name: 'Nombre'},
		    {name: 'Descripción'}
		    ]
		   };

		$scope.searchContent = function(criteria){
			if ( criteria != ''){
				$scope.showFilter = true;
				var j = 0;
				$scope.resultSearch = [];
				switch($scope.filterSelected) {
				    case "Nombre":
				        for ( var i = 0; i<$scope.contents.length; i++)
						{
						contentName = $scope.contents[i].name.toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( contentName.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.contents[i];
		                        j++;
		                    }
						}// end of for filter
				        break;
				    case "Descripción":
				        for ( var i = 0; i<$scope.contents.length; i++)
						{
						description = $scope.contents[i].description.toString().toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( description.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.contents[i];
		                        j++;
		                    }
						}// end of for filter
				        break;
				  
				}
			

				
			}else{
				$scope.showFilter = false;
			}
		}// end of function searchCompetence



	});