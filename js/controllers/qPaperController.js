angular.module('qpPortal').controller('qPaperController', function($scope,$http) {
    $scope.hideShow = function(id){
        document.getElementById(id).style.display="block";
        for(var i=1;i<=2;i++){
            if(i!=id)
                document.getElementById(i).style.display="none";
        }
    }    
    $scope.viewSubjects = function(){
        $scope.v_sem = document.getElementById("v_sem").value;
        $http.post("php/returnSubjects.php",{'sem':$scope.v_sem}).then(function(response){  
            $scope.subjects_view = response.data;
        });
    }
    $scope.showSubjects = function(){
        $scope.s_sem = document.getElementById("s_sem").value;
        $http.post("php/returnSubjects.php",{'sem':$scope.s_sem}).then(function(response){  
            $scope.subjects_show = response.data;
        });
    }
    $scope.showQuestions = function(){
        $scope.s_sem = document.getElementById("s_sem").value;
        $scope.q_sub = document.getElementById("q_sub").value;
        $scope.unit = document.getElementById("unit").value;
        $http.post("php/returnSubjects.php",{'sem':$scope.s_sem,'sub':$scope.q_sub,'unit':$scope.unit,'type':2}).then(function(response){  
            $scope.questions_show = response.data;
        });

    }
    $scope.saveChanges = function(id){
        $scope.id = id;
        $scope.n_qu = document.getElementById(id+"q").value;
        $scope.n_m = document.getElementById(id+"m").value;
        $http.post("php/returnSubjects.php",{'sem':$scope.s_sem,'id':$scope.id,'nq':$scope.n_qu,'nm':$scope.n_m,'type':3}).then(function(response){  
            
        });
        $scope.showQuestions();

    }
    $scope.delQuestion = function(id){
        $scope.id = id;
        $scope.s_sem = document.getElementById("s_sem").value;
        $http.post("php/returnSubjects.php",{'id':$scope.id,'sem':$scope.s_sem,'type':4}).then(function(response){});
        $scope.showQuestions();
    }


    $scope.hideShow(1);
});