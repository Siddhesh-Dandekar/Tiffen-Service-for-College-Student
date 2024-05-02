<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['useradmin']))
{
    header("location: admin.php");
    exit;
}
require_once "config.php";

$useradmin = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['useradmin'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter useradmin + password";
    }
    else{
        $useradmin = trim($_POST['useradmin']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT Hotel_id, useradmin, password FROM hotel WHERE useradmin = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_useradmin);
    $param_useradmin = $useradmin;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $Hotel_id, $useradmin, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["useradmin"] = $useradmin;
                            $_SESSION["Hotel_id"] = $Hotel_id;
                            $_SESSION["loggedadmin"] = true;

                            //Redirect user to welcome page
                            header("location: admin.php");
                            
                        }
                    }

                }

    }
}    


}


?>



<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="css/style.css">
	<title>Admin</title>
	<style>
		#login-page {
			border-radius:20px;
			background-color: black;
			margin: auto;
			width: 300px;
			padding: 20px;
		}

		#text {
			font-size:25px;
			height: 30px;
			border-radius: 5px;
			padding: 4px;
			border: solid thin #aaa;
			width: 100%;
		}

		#button {
			cursor: pointer;
			font-weight: 900;
			padding: 10px;
			width: 100%;
			font-size: 20px;
			color: black;
			background-color: lightblue;
			border: none;
		}

		.create {
			color: white;
		}

		.create a {
			text-decoration: none;
			color: yellowgreen;
		}

		.log-in {
			font-weight: 900;
			color: white;
			font-size: 30px;
		}

		h6{
        font-size: 20px;
        color: white;
        font-weight: 500;
        } 
		.back{
			background-image: url('img/login.jpg');    
			height: 100vh; 
			width: 100%;
			background-size: cover; 
			padding: 80px 80px;
		}
	</style>
</head>

<body>

	<section id="header">
		<a href="home.html">
			<img class="logo" src="img/logo.jpg" alt="logo">
			<span class="logoname">GMVIT FOOD</span>
		</a>

		<span class="logoname">START YOUR JOURNEY WITH US</span>

	</section>

	<section class="back">
		<div id="login-page">

			<form method="post">
				<div class="log-in">Admin</div>
				<br>
				<br>

				<h6>YOUR USER-ADMIN</h6>

				<input id="text" type="text" name="useradmin" placeholder="Email" ><br><br>
				<br>
				<h6>PASSWORD</h6>
				<input id="text" type="password" name="password"><br><br>
				<br>

				<input id="button" type="submit" value="Login"><br><br>
				<br>
				<div class="create">
					<span>New to GMVIT?</span>
					<a href="signup_admin.php">Create Account</a><br><br>
				</div>
			</form>
		</div>
	</section>


</body>

</html>