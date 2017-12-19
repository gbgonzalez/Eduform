var app = angular.module('eduform', []);
	app.controller('AppCtrl',function($scope, $http){ 

		$scope.userSubjects = userSubjects.userSubjects;

		

		$scope.menuCompetences = false;

		$scope.competences = [];

		$scope.showCompetences = function(id){
			var j = 0;
			$scope.menuCompetences = !$scope.menuCompetences;
			
			for (var i = 0; i < userData.usersData.length; i++ ){
				if ( userData.usersData[i][0].subject_id == id )
				{
					
					$scope.competences[j] = userData.usersData[i];
					j++;
				}

			}
			console.log($scope.competences);
		}// end of show competencs

	});