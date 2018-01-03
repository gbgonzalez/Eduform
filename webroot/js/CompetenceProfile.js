var app = angular.module('eduform', []);
	app.controller('AppCtrl',function($scope, $http){ 

		$scope.competencesContentFile = competencesContentFile.competencesContentFile;
		$scope.nota = {nota: 'Sin calificar todavía',
					  style: 'notQualified'}
		booleannote = competencesContentFile.competencesContentFile.userscompetences.competence.booleannote
;
		numericnote = competencesContentFile.competencesContentFile.userscompetences.competence.numericnote;

		console.log(numericnote);

		console.log(booleannote);

		if ( numericnote != null && numericnote != undefined && numericnote != '' )
		{
			$scope.nota.nota = numericnote;
			if ( numericnote < 5 )
			{
				$scope.nota.style = 'failed';
			}else{
				$scope.nota.style = 'passed';
			}
		}

		if ( booleannote != null && booleannote != undefined && booleannote != '' )
		{
			$scope.nota.nota = booleannote;
			if ( booleannote == 'Aprobado' )
			{
				$scope.nota.style = 'passed';
			}else{
				$scope.nota.style = 'failed';
			}
		}



});