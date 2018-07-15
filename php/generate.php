<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
require 'db_connect.php';
$output = array();
$questions = array();
$marks = array();
$staff = $_SESSION['username'];
$department = $_SESSION['department'];
$data = json_decode(file_get_contents("php://input"));
if($data->exam == 1 || $data->exam == 2){
    if($data->exam == 1){
        $start = 1;
        $end = 2;
    }
    else{
        $start = 3;
        $end = 4;
    }
    $sem = $data->sem;
    $sub = $data->sub;
    $tabsem = "sem".$sem;
    $_SESSION['tabsem'] = $tabsem;
    $_SESSION['subcode'] = $sub;
    $connect = new mysqli("localhost","root","root","all_questions");
    for($unit = $start;$unit<=$end;$unit++){
        $query = "SELECT * FROM `$tabsem` WHERE `department`='$department' AND `subject`='$sub' AND `unit`='$unit' AND `marks`<'8'";
        $result = $connect->query($query);
        while($line = mysqli_fetch_array($result))  
	    {
            $questions[] = $line['id'];
            $marks[] = $line['marks'];
        }
        $key1 = array_rand($questions);
        $q1 = $questions[$key1];
        $m1 = $marks[$key1];
        unset($questions[$key1]);unset($marks[$key1]);
        //For Choice Question
        $key2 = array_rand($questions);
        $q2 = $questions[$key2];
        $m2 = $marks[$key2];
        unset($questions[$key2]);unset($marks[$key2]);

        $question2 = array();
        $rem = 10-$m1;
        foreach (array_keys($marks, $rem, false) as $key) {
            $question2[] = $questions[$key];
        }
        $key3 = array_rand($question2);
        $q3 = $question2[$key3];

        $unset_q3 = array_search($q3, $questions);
        unset($questions[$unset_q3]);unset($marks[$unset_q3]);
        unset($question2);
        $rem = 10-$m2;
        foreach (array_keys($marks, $rem, false) as $key) {
            $question2[] = $questions[$key];
        }
        $key4 = array_rand($question2);
        $q4 = $question2[$key4];
        unset($questions);
        unset($question2);
        unset($marks);
        $final = [$q1,$q3,$q2,$q4];
        $output[] = $final;
        
    }
}
else{
    $sem = $data->sem;
    $sub = $data->sub;
    $tabsem = "sem".$sem;
    $_SESSION['tabsem'] = $tabsem;
    $_SESSION['subcode'] = $sub;

    $marks_array = [3,4,5,6,7,8,10];
    $questions = array();
    $rand_array = [
        [3,7,10],
        [4,6,10]
    ];
    $final = array();
    $connect = new mysqli("localhost","root","root","all_questions");
    for($rep_unit = 1;$rep_unit<=5;$rep_unit++){
        foreach($marks_array as $m){
            $query = "SELECT * FROM `$tabsem` WHERE `department`='$department' AND `subject`='$sub' AND `unit`='$rep_unit' AND `marks`='$m'";
            $result = $connect->query($query);
            while($line = mysqli_fetch_array($result))  
                $temp_q[] = $line['id'];
            $questions[''.$m.''] = $temp_q;
            unset($temp_q);
        }
        for($i=0;$i<2;$i++){
            $q_set = $rand_array[array_rand($rand_array)];
            shuffle($q_set);
            foreach($q_set as $q){
                $sel = array_rand($questions[''.$q.'']);
                $q_id = $questions[''.$q.''][''.$sel.''];
                unset($questions[''.$q.''][''.$sel.'']);
                $final[] = $q_id;
            }
        }
    }
    $output = $final;

    
    

}
$details = fopen($_SESSION['username'].".txt",w);
fwrite($details,json_encode($output));
fclose($details);
echo json_encode($output);

?>