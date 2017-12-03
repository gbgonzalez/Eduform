var app = angular.module('eduform', []);
	app.controller('AppCtrl',function($scope, $http) {

		$scope.categories = categories.categories;
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

		$scope.getNameSubject = function(subjectsId){
			for ( var i = 0; i< $scope.subjects.length; i++ )
			{
				if( $scope.subjects[i].id == subjectsId)
				{
					return $scope.subjects[i].name;
				}
			}

		}

		$scope.searchCategory = function(criteria){
			console.log("entra");
			if ( criteria != ''){
				$scope.showFilter = true;
				var j = 0;
				$scope.resultSearch = [];
				switch($scope.filterSelected) {
				    case "Nombre":
				        for ( var i = 0; i<$scope.categories.length; i++)
						{
						categoryName = $scope.categories[i].name.toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( categoryName.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.categories[i];
		                        j++;
		                    }
						}// end of for filter
				        break;
				    case "Descripción":
				        for ( var i = 0; i<$scope.categories.length; i++)
						{
						description = $scope.categories[i].description.toString().toLowerCase();
		                criteria = criteria.toLowerCase();
		                if( description.search( criteria ) >= 0)
		                    {
		                       	$scope.resultSearch[j] = $scope.categories[i];
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