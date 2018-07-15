<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
require 'db_connect.php';
$output = array();
$staff = $_SESSION['username'];
$department = $_SESSION['department'];
$data = json_decode(file_get_contents("php://input"));
if($data->type == 2){
    $sem = $data->sem;
    $sub = $data->sub;
    $unit = $data->unit;
    $tabsem = "sem".$sem;
    $connect = new mysqli("localhost","root","root","all_questions");
    $qu_query = "SELECT * FROM `$tabsem` WHERE `department`='$department' AND `unit`='$unit' AND `subject`='$sub'";
    $q_result = $connect->query($qu_query);
    while($line = mysqli_fetch_array($q_result))  
	{
        $output[] = $line;  
	}  
    echo json_encode($output);
}
else if($data->type == 3){
    $id = $data->id;
    $tabsem = "sem".$data->sem;
    $connect = new mysqli("localhost","root","root","all_questions");
    $qu_query = "UPDATE `$tabsem` SET `question`='$data->nq',`marks`='$data->nm' WHERE `id`='$id'";
    $q_result = $connect->query($qu_query);
}
else if($data->type == 4){
    $id = $data->id;
    $tabsem = "sem".$data->sem;
    $connect = new mysqli("localhost","root","root","all_questions");
    $qu_query = "DELETE FROM `$tabsem` WHERE `id`='$id'";
    $q_result = $connect->query($qu_query);
}
else{
$sem = $data->sem;
$query = "SELECT * FROM `subjects` WHERE `sem`='$sem' AND `department`='$department'";
$result = $user_connection->query($query);
while($row = mysqli_fetch_array($result))  
	{
        $output[] = $row;  
	}  
    echo json_encode($output);

}
?>