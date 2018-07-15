var app = angular.module('qpPortal', ['ngRoute']);
	app.config(function($routeProvider) {
		$routeProvider
			.when('/', {
				templateUrl : 'pages/subject.html',
				controller  : 'subjectController'
			})

			.when('/subject', {
				templateUrl : 'pages/subject.html',
				controller  : 'subjectController'
			})
			.when('/questionManager', {
				templateUrl : 'pages/questionPaper.php',
				controller  : 'qPaperController'
			})
			.when('/generate', {
				templateUrl : 'pages/generator.html',
				controller  : 'generatorController'
			})
			.otherwise({redirectTo:'/'});		
	});