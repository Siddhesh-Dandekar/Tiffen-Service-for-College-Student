<?php
require_once "config.php";

$username = $password = $confirm_password = $phone = $branch = $wallet = "";
$username_err = $password_err = $confirm_password_err = $phone_err = $branch_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken";
					echo '<script>alert("Username is already taken")</script>'; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
	
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
	echo '<script>alert("Password cannot be less than 5 characters")</script>';
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
    echo '<script>alert("Password Didnt match")</script>';
}

// Check for phone number field
if(empty(trim($_POST['phone']))){
    $phone_err = "phone cannot be blank";
}
else{
    $phone = trim($_POST['phone']);
}

// Check for Option Field
if(empty(trim($_POST['branch']))){
    $branch_err = "branch cannot be blank";
}
else{
    $branch = trim($_POST['branch']);
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($phone_err) && empty($branch_err))
{
    $sql = "INSERT INTO users (username, password, phone, branch, wallet) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_phone, $param_branch, $param_wallet);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
		$param_phone    = $phone;
		$param_branch   = $branch;
		$param_wallet   = $wallet;

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>


<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="css/style.css">
	<title>Signup</title>
	<style>
		#login-page {
			border-radius:20px;
			background-color: black;
			margin: auto;
			width: 350px;
			padding: 20px;
		}

		#text {
			font-size: 20px;
			height: 30px;
			border-radius: 5px;
			padding: 3px;
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
				<div class="log-in">Sign up</div>
				<br>
				<br>

				<h6>YOUR USERNAME</h6>
				<input id="text" type="text" name="username" placeholder="Email ID"><br><br>
				<br>


				<h6>PHONE NUMBER</h6>
				<input id="text" type="tel" name="phone" pattern="[0-9]{10}"> <br><br>
				<br>


				<h6>BRANCH</h6>
				<select id="text" class="form-control" name="branch">
                  <option>Computer Engineering</option>
				  <option>Mechanical Engineering</option>
				  <option>Civil Engineering</option>
				  <option>Bsc</option>
                </select> <br><br>
				<br>


				<h6>PASSWORD</h6>
				<input id="text" type="password" name="password"><br><br>
				<br>

				<h6>CONFIRM PASSWORD</h6>
				<input id="text" type="password" name="confirm_password"><br><br>
				<br>

				<input id="button" type="submit" value="Create Account"><br><br>
				<br>

				<div class="create">
					<span>Already have an Account?</span>
					<a href="login.php">Log in</a><br><br>
				</div>
			</form>
		</div>
	</section>


</body>

</html>