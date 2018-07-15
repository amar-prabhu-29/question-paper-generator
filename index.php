<?php
session_start();
require 'php/db_connect.php';
//Taken as variable $user_connection
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM `users` WHERE `username`=? AND `password`=?";
    $result = $user_connection->prepare($query);
    $result->bind_param('ss', $username, $password);
    $result->execute();
    $result->store_result();
    if($result->num_rows == 0){
        header('Location: index.php?error=1');
    }
    else{
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
    }
}
?>



<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-theme.css">
        <link rel="stylesheet" href="css/custom-style.css">
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
                        <li class="navbar-item active"><a href="#"><font color="white">Login</font></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Main Navbar Ends -->

        <!-- Page Body Starts -->
        <div class="row main">
            <!-- Sidebar menu -->
            <div class="col-lg-3 sidebar">
                <center><img src="images/logo.jpg" style="height:200px;border-radius:50%;margin-top:10px"></center>
            </div>
            <div class="col-lg-9" >
                <div class="login-box">
                    <div class="box-header">
                        <h3 style="margin:0;padding:0"><strong>LOGIN</strong></h3>
                    </div>    
                    <form action="" method="post" style="padding:20px;">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="Username" class="form-control" max-length="25"/>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Password" class="form-control" max-length="25"/>
                        </div>
                        <input type="submit" name="submit" value="Login" class="btn btn-info">
                    </form>
                    <?php
                        if($_GET['id'] == 1){
                            echo'<div style="color:white;background-color:red;padding:15px;border-radius:5px"><b><u>ERROR</u><br>Invalid Username And/Or Password.</b></div>';
                        }
                        if($_GET['id'] == 2){
                            echo'<div style="color:white;background-color:orange;padding:15px;border-radius:5px"><b>Thank You For Using Question Paper Generator</b></div>';
                        }

                    ?>
                </div>
            </div>
        </div>
        <!-- Page Body Ends -->

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>