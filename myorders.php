<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}
require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <title>GMVIT Food</title>
</head>
<body>
    <section id="header">
        <a href="home.html">
            <img class="logo" src="img/logo.jpg" alt="logo">
            <span class="logoname">GMVIT FOOD</span>
        </a>
        <div>
            <ul id="navbar">
                <li><a><?php echo "". $_SESSION['username']?></a></li>
                <li><a href="wallet.php" >
                <?php 
                $username = $_SESSION['username'];
                $query5= "SELECT * FROM users WHERE username='$username'";
                $resultt = $conn->query($query5);
                while($row = $resultt->fetch_assoc())
                    {
                        $_SESSION['wallet'] = $row["wallet"];
                        echo "₹ " . 
                            $row["wallet"]. "";
                    }
                ?>
                </a></li>
                <li><a href="category.php">Category</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="logout.php">Logout</a></li>
                
            </ul>
        </div>
    </section>

    <section>
    <div class="section-p1" id="pending">
        <h1 class="center">Your Pending Orders</h1>
        <table class="table table-striped table-hover container">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Address</th>
                <th>Order date</th>
                <th>Order Status</th>
                <th>Total price</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $username = $_SESSION['username'];
                $query="select * from users, orders where users.username='$username' and orders.username=users.username and orders.order_status='PLACED' order by orders.order_date";
                $result = $conn->query($query);
                while($row=($result->fetch_assoc())){
                    echo    
                    '
                            <tr class="tab">
                                <td>'.$row['order_id'].'</td>
                                <td>'.$row['address'].'</td>
                                <td>'.$row['order_date'].'</td>
                                <td>'.$row['order_status'].'</td>
                                <td>'.$row['total'].'</td>
                            </tr>
                    ';
                }
            ?>
            <tbody>
        </table>
        </div>
    </section>