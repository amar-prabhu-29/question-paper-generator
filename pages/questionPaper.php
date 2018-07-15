


<br>
<h3 style="color:#2c3e50"><u>Question Paper Manager Menu</u></h3>
<button class="btn btn-info" ng-click="hideShow(1)">Upload Questions</button>
<button class="btn btn-info" ng-click="hideShow(2)">Modify Uploaded Questions</button>
<hr>

<div id="1">
    <form class="form-group" method="post" action="php/UpAndWrite.php" enctype="multipart/form-data"> 
    <label for="sem">Select Semester:</label>
            <select class="form-control" id="v_sem" name="sem" style="width:200px" ng-change="viewSubjects()" ng-model="view_Sub">
                <option selected disabled value="0">Select A Semester</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
            <br>
        <label for="subject">Select Subject:</label>
        <select class="form-control"  id="subject" name="subject" style="width:200px">
            <option selected disabled value="0">Select A Subject</option>
            <option ng-repeat="sub in subjects_view" value="{{sub.code}}">{{sub.name}}</option>
        </select>
    
        <br>
        <label>Upload Questions:</label><br>
        <label class="btn btn-default">
            Browse <input type="file" name="file" hidden>
        </label>
        <br>
        <br>
        <input type="submit" name="submit" class="btn btn-info" value="Upload">
    </form>
    <hr>



</div>


<div id="2">
<table>
    <tr><td>
<label for="sem">Select Semister:</label>
    <select class="form-control" id="s_sem" name="s_sem" style="width:200px" ng-change="showSubjects()" ng-model="select_Sub">
        <option selected disabled value="0">Select A Semester</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select>
</td>
<td>
        <label for="subject">Select Subject:</label>
        <select class="form-control"  id="q_sub" name="sub" style="width:200px">
            <option selected disabled value="0">Select A Subject</option>
            <option ng-repeat="sub in subjects_show" value="{{sub.code}}">{{sub.name}}</option>
        </select>
</td>
<td>
<label for="subject">Select Unit:</label>
        <select class="form-control"  id="unit" name="unit" style="width:200px"  ng-change="showQuestions()" ng-model="question_show">
            <option selected disabled value="0">Select A Unit</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

</td>
</table>

<div class="table-responsive">
<table class="table">
<tr>
    <td style="width:40%"><strong>Question</strong></td>
    <td><strong>Marks</strong></td>
    <td><strong>Modify</strong></td>
    <td><strong>Save</strong></td>
    <td><strong>Delete</strong></td>
</tr>
<tr ng-repeat="q in questions_show" ng-init="en=true">
    <td><textarea style="width:100%" id="{{q.id}}q" ng-disabled="en">{{q.question}}</textarea></td>
    <td><input id="{{q.id}}m" value="{{q.marks}}"  ng-disabled="en"></td>
    <td><button class="btn btn-info" ng-click="en=false">Modify</button></td>
    <td><button class="btn btn-info" ng-disabled="en" ng-click="saveChanges(q.id)">Save</button></td>
    <td><button class="btn btn-danger" ng-click="delQuestion(q.id)">Delete</button></td>
</tr>

</table>


</div>

</div>