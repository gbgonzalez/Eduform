
var app = angular.module('eduform', []);
	app.controller('AppCtrl',function($scope, $http) {

		$scope.competences = competences.competences;

		$scope.categoriesCompetences = categoriesCompetences.categoriesCompetences;

		$scope.showFilter = false;
		$scope.resultSearch = [];

		$scope.filterSelected = "Nombre";
		$scope.filterType = {
		    types: [
		    {name: 'Nombre'},
		    {name: 'Descripción'}
		    ]
		   };


		$scope.searchCompetence = function(criteria){
			if ( criteria != ''){
				$scope.showFilter = true;
				var j = 0;
				$scope.resultSearch = [];
				switch($scope.filterSelected) {
				    case "Nombre":
				        for ( var i = 0; i<$scope.competences.length; i++)
						{
						competenceName = $scope.competences[i].name.toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( competenceName.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.competences[i];
		                        j++;
		                    }
						}// end of for filter
				        break;
				    case "Descripción":
				        for ( var i = 0; i<$scope.competences.length; i++)
						{
						description = $scope.competences[i].description.toString().toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( description.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.competences[i];
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