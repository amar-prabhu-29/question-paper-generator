<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
require 'php/db_connect.php';
$username = $_SESSION['username'];
$query = "SELECT * FROM `users` WHERE `username`='$username'";
$result = $user_connection->query($query);
$data = $result->fetch_assoc();
$name = $data['name'];
$department = $data['department'];
$_SESSION['department'] = $department;
?>
<html ng-app="qpPortal">
    <head>
        <title>Question Paper Generator</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-theme.css">
        <link rel="stylesheet" href="css/custom-style.css">
        <script src="js/angular.js"></script>
        <script src="js/angular-route.js"></script>

        <!-- Angular Script -->
        <script src="js/script.js"></script>

        <!-- Angular Controllers -->
        <script src="js/controllers/subjectController.js"></script>
        <script src="js/controllers/qPaperController.js"></script>
        <script src="js/controllers/generatorController.js"></script>
    </head>
    <body class="body">
        <!-- Main Navbar -->
        <div class="nav navbar-custom navbar-fixed-top" id="main-navbar">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><font color="white">Question Paper Generator</font></a>
                </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="navbar-item"><a href="php/logout.php"><font color="white">Logout</font></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Navbar Ends -->

        <!-- Page Body Starts -->
        <div class="row main">
            <!-- Sidebar menu -->
            <div class="col-lg-3 sidebar">
                <center><img src="images/logo.jpg" style="height:200px;border-radius:50%;margin-top:10px"></center>
                <br>
                <div style="color:#2c3e50;width:80%;margin:auto;background-color:white;border-radius:5px;padding:5px">
                    Welcome,<br>
                    <h4><?php echo $name; ?></h4>
                </div>
                <br><br>
                <div style="color:#2c3e50;width:80%;margin:auto;background-color:white;border-radius:5px">
                    <center><h3 style="margin:0;padding:0"><u>Menu</u><br><br></h3></center>
                    <ul class="nav">    
                        <li><a href="#/subject">Subjects Manager</a></li>
                        <li><a href="#/questionManager">Question Paper Manager</a></li>
                        <li><a href="#/generate">Generate Question Paper</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9" >
                <div ng-view></div>
            </div>
        </div>
        <!-- Page Body Ends -->

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>