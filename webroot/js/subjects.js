
var app = angular.module('eduform', []);
	app.controller('AppCtrl',function($scope, $http) {

		$scope.subjects = subjects.subjects;
		$scope.showFilter = false;
		$scope.resultSearch = [];

		$scope.filterSelected = "Nombre";
		$scope.filterType = {
		    types: [
		    {name: 'Nombre'},
		    {name: 'Descripción'}
		    ]
		   };

		$scope.searchUser = function(criteria){
			if ( criteria != ''){
				$scope.showFilter = true;
				var j = 0;
				$scope.resultSearch = [];
				switch($scope.filterSelected) {
				    case "Nombre":
				        for ( var i = 0; i<$scope.subjects.length; i++)
						{
						subjectName = $scope.subjects[i].name.toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( subjectName.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.subjects[i];
		                        j++;
		                    }
						}// end of for filter
				        break;
				    case "Descripción":
				        for ( var i = 0; i<$scope.subjects.length; i++)
						{
						description = $scope.subjects[i].description.toString().toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( description.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.subjects[i];
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