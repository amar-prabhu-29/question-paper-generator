<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: ../index.php');
}
$indi_nos = ['1',null,'2',null,'3',null,'4',null];
$subq_nos = ['a','b','a','b','a','b','a','b'];
require 'db_connect.php';
$staff = $_SESSION['username'];
$department = $_SESSION['department'];
$file = fopen($_SESSION['username'].".txt","r");
$retrived = fread($file,filesize($_SESSION['username'].".txt"));
$question = json_decode($retrived);
fclose($file);
$tabsem = $_SESSION['tabsem'];
$subcode = $_SESSION['subcode'];
$sub_query = "SELECT * FROM `subjects` WHERE `code`='$subcode'";
$sub_sem_result = $user_connection->query($sub_query);
$sub_sem_details = $sub_sem_result->fetch_assoc();
$p_sub = $sub_sem_details['name'];
$i = 0;
$connect = new mysqli("localhost","root","root","all_questions");
switch($tabsem){
    case 'sem1':
    $p_sem = 'I';
    break;
    case 'sem2':
    $p_sem = 'II';
    break;
    case 'sem3':
    $p_sem = 'III';
    break;
    case 'sem4':
    $p_sem = 'IV';
    break;
    case 'sem5':
    $p_sem = 'V';
    break;
    case 'sem6':
    $p_sem = 'VI';
    break;
    case 'sem7':
    $p_sem = 'VII';
    break;
    case 'sem8':
    $p_sem = 'VIII';
    break;
}
echo'
<style>
.box{
    border:1px solid black;
    display:inline-block;
    width:20px;
    height:20px;
}
</style>
<div style="right:0px">
<span>USN </span>';
for($rep = 0;$rep<=9;$rep++)
echo'<span class="box"></span>';
echo'
</div>
<center>
<h2 style="padding:0;margin:0"><b>NMAM INSTITUTE OF TECHNOLOGY,NITTE</b></h2> 
<h3 style="padding:0;margin:0"><i>(An Autonomous Institute affiliated to VTU, Belagavi)</i></h3>
<h2 style="padding:0;margin:0"><b>'.$p_sem.' Sem B.E. ('.$department.') Mid Semester Examinations-I,'.date('F Y').' </b></h2>
<h3 style="padding:0;margin-top:10px"><b>'.$subcode.' - '.$p_sub.'</b></h3>
</center>
<div style="float:left">Duration: 1 Hour</div>
<div style="float:right">Max. Marks: 20</div>
<br>
<center><i><h3 style="padding:0;margin:0">Note: Answer any <b>One</b> full question from <b>each unit</b></h3></i></center>
<br><center><table border=0>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td></td>
<td style="width:80vw"><center><strong>Unit - I</strong></center></td>
<td><strong>Marks</strong></td>
<td><strong>BT*</strong></td>
</tr>
';
foreach($question as $q){
    foreach($q as $qno){
    
    $query = "SELECT * FROM `$tabsem` WHERE `id`='$qno'";
    $result = $connect->query($query);
    $line = mysqli_fetch_array($result);
if($i == 4){
    echo'
    <tr>
<td></td>
<td></td>
<td><center><strong>Unit - II</strong></center></td>
<td></td>
<td></td>
</tr>

    ';
}

echo'
<tr>
<td>'.$indi_nos[$i].'</td>
<td>'.$subq_nos[$i].')</td>
<td>'.$line['question'].'</td>
<td>'.$line['marks'].'</td>';
$bt_arr = explode(' ',trim($line['question']));
$bt_verb = $bt_arr[0];
$bt_query = "SELECT * FROM `blooms_taxonomy` WHERE `verb`='$bt_verb'";
$bt_result = $user_connection->query($bt_query);
$bt_final_array = $bt_result->fetch_assoc();
echo'<td>L'.$bt_final_array['level'].'</td>
</tr>'
;

$i+=1;
}
}
echo'</table></center>
<br>
BT* Bloom\'s Taxanomy,L* Level<br>
<center>*****************</center>';
unlink($_SESSION['username'].".txt");
?>