angular.module('qpPortal').controller('generatorController', function($scope,$http,$window) {
    $scope.viewSubjects = function(){
        $scope.sem = document.getElementById("sem").value;
        $http.post("php/returnSubjects.php",{'sem':$scope.sem}).then(function(response){  
            $scope.subjects_view = response.data;
        });
    }
    $scope.generate = function(){
        $scope.sem = document.getElementById("sem").value;
        $scope.sub = document.getElementById("subject").value;
        $scope.exam = document.getElementById("exam").value;
        $http.post("php/generate.php",{'sem':$scope.sem,'sub':$scope.sub,'exam':$scope.exam}).then(function(response){  
            $scope.generated = response.data;
        });
        if($scope.exam == 3)
            $window.open('php/semendPaper.php', '_blank');
        else
            $window.open('php/displayPaper.php', '_blank');
    }
});