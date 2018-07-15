angular.module('qpPortal').controller('subjectController', function($scope,$http) {
    $scope.hideShow = function(id){
        document.getElementById(id).style.display="block";
        for(var i=1;i<=3;i++){
            if(i!=id)
                document.getElementById(i).style.display="none";
        }
    }
    $scope.subjectAdd = function(){
        var sem = document.getElementById("sem").value;
        var subname = document.getElementById("sub-name").value;
        var subcode = document.getElementById("sub-code").value;
        if(sem != 0 && subcode.length != 0 && subname.length != 0){
            $scope.sem=sem;
            $scope.name=subname;
            $scope.code=subcode;
            $http.post("php/subject.php",{'sem':$scope.sem,'name':$scope.name,'code':$scope.code,'type':1}).then(function(response){  
                $scope.details = response.data;
            });
            document.getElementById("sem").value = 0;
            document.getElementById("sub-name").value = null;
            document.getElementById("sub-code").value = null;
            alert("Subject Added Successfully");
        }
        else{
            alert("Errors Exists in Input Data.Please Check Data And Try Again");
        }
    }
    $scope.viewSubjects = function(){
        $scope.v_sem = document.getElementById("v_sem").value;
        $http.post("php/subject.php",{'sem':$scope.v_sem,'type':2}).then(function(response){  
            $scope.subjects_view = response.data;
        });
    }
    $scope.modifySubjectsView = function(){
        $scope.sem = document.getElementById("m_sem").value;
        $http.post("php/subject.php",{'sem':$scope.sem,'type':2}).then(function(response){  
            $scope.subjects = response.data;
        });
    }

    $scope.saveChanges = function(subId){
        $scope.subId = subId;
        var newName = document.getElementById("sn"+subId).value;
        var newCode = document.getElementById("sc"+subId).value;
        if(newName.length != 0 & newCode.length != 0){
            $scope.newName = newName;
            $scope.newCode = newCode;
            $http.post("php/subject.php",{'id':$scope.subId,'name':$scope.newName,'code':$scope.newCode,'type':3}).then(function(response){  
                $scope.details = response.data;
                $scope.modifySubjectsView();
                alert("Changes Saved Successfully");    
            });
        }
        else{
            alert("Errors Exists in Input Data.Please Check Data And Try Again");
        }
    }

    $scope.deleteSubject = function(subId){
        $scope.subId = subId;
        $http.post("php/subject.php",{'id':$scope.subId,'type':4}).then(function(response){  
            $scope.details = response.data;
            $scope.modifySubjectsView();
            alert("Subject Deleted Successfully");    
        });
    }
});