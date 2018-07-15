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
if($data->type == 1){
    $sem = $data->sem;
    $name = $data->name;
    $code = $data->code;
    $query = "INSERT INTO `subjects`( `name`, `code`, `sem`, `department`) 
    VALUES ('$name','$code','$sem','$department')";
    $result = $user_connection->query($query);
}
if($data->type == 2){
    $sem = $data->sem;
    $query = "SELECT * FROM `subjects` WHERE `sem`='$sem' AND `department`='$department'";
    $result = $user_connection->query($query);
    while($row = mysqli_fetch_array($result))  
	{
        $output[] = $row;  
	}  
    echo json_encode($output);
}
if($data->type == 3){
    $id = $data->id;
    $name = $data->name;
    $code = $data->code;
    $query = "UPDATE `subjects` SET `name`='$name',`code`='$code' WHERE `id`='$id'";
    $user_connection->query($query);
}
if($data->type == 4){
    $id = $data->id;
    $query = "DELETE FROM `subjects` WHERE `id`='$id'";
    $user_connection->query($query);
}




?>