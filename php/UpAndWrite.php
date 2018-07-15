<?php
session_start();
$department = $_SESSION['department'];
if(isset($_POST['submit'])){
    $connect = new mysqli("localhost","root","root","all_questions");
    $sem = $_POST['sem'];
    $subject = $_POST['subject'];
    $tabsem = "sem".$sem;
    $uploaded_file =  $_FILES["file"]["tmp_name"];
        $csvFile = fopen($uploaded_file, 'r');
            while(($line = fgetcsv($csvFile)) !== FALSE){
                $query = "INSERT INTO `$tabsem`(`question`, `marks`, `unit`, `subject`, `department`) 
                VALUES ('$line[0]','$line[1]','$line[2]','$subject','$department')";
                $result = $connect->query($query);   
            }
            echo'<script>alert("Question Uploaded Successfully");</script>';
            header('Location: ../dashboard.php#/questionManager');

    }
?>