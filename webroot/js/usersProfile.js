var app = angular.module('eduform', []);
	app.controller('AppCtrl',function($scope, $http){ 
		$scope.dataUsers = dataUsers.dataUsers;
	});