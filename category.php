<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}
require 'config.php';
require 'time.php';
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
                <li><a href="wallet.php">
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
                <li><a href="myorders.php">Orders</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="logout.php">Logout</a></li>
                
            </ul>
        </div>
    </section>


    <section id="page-header" style="background-image: url('img/spinach-gfc47f7710_1920.jpg')">
        <div class="inner">
            <h3 style="background-color: azure;border-radius: 10px;">#Don’t starve, just order</h3>
        </div>

    </section>
    <?php
    if($_SESSION['Stock'] == true)
    {
    ?>
    <section id="product1" class="section-p1">
        <div class="pro-container">

           <div class="pro">
             
                <img src="img/vatika.jpg" alt="">
                <div class="des">
                    <span>Tala</span>
                    <h5>Vatika Restaurant</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                    </div>
                    <br>
                    <form action="choose.php" method="post" >
                      <a href="Vatika.php">
                      <button type="submit" name="vati" class="btn">choose</button>
                      </a>
                    </form>
                </div>
             
            </div>


            <div class="pro">
                
                    <img src="img/malhar.jpg" alt="">
                    <div class="des">
                        <span>Tala</span>
                        <h5>Malhar Restaurant</h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <br>
                        <form action="choose.php" method="post" >
                        <a href="malhar.php">
                        <button type="submit" name="mal" class="btn">choose</button>
                        </a>
                        </form> 
                    </div>
                
            </div>

            <div class="pro">
                    <img src="img/Kokan.jpg" alt="">
                    <div class="des">
                        <span>Tala</span>
                        <h5>Hotel Kokan Kinara</h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <br>
                        <form action="choose.php" method="post" >
                        <a href="kokan.php">
                        <button type="submit" name="kok" class="btn">choose</button>
                        </a>
                        </form>
                    </div>
            </div>

            <div class="pro">
                    <img src="img/vada.jpg" alt="">
                    <div class="des">
                        <span>Tala</span>
                        <h5>GMVIT Canteen</h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <br>
                        <form action="choose.php" method="post" >
                        <a href="canteen.php">
                        <button type="submit" name="cant" class="btn">choose</button>
                        </a>
                        </form>
                    </div>
            </div>
        </div>


    </section>
    <?php
    }
    ?>
    

    <?php
    if($_SESSION['Stock'] == False)
    {
    ?>
    <section class="section-p1" id="closed">
        <div class="imgclosed">
            <img src="img/closed.jpg" alt="">
        </div>

        <div class="service">
                <h1>Our Service is only available from 7:00 AM to 10:00 AM</h1>
                <br>
                <h1>Try Again Tomorrow :)</h1>
        </div>

    </section>
    <?php
    }
    ?>


    <footer class="section-p1">

        <div class="col">
            <div class="log">
                <a href="">
                    <img class="logoo" src="img/logo.jpg" alt="">
                    <span class="logoname">GMVIT FOOD</span>
                </a>
            </div>

            <h4>Contact</h4>
            <p><strong>Address: </strong>At Post & Taluka, Tala, Maharashtra 402111</p>
            <p><strong>Phone: </strong>022 1015155</p>
            <div class="follow">
                <h4>Follow us</h4>
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                </div>
            </div>
        </div>


        <div class="col">
            <h4>About</h4>
            <a href="#">About us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>

        </div>
        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="cart.php">View Cart</a>
            <a href="#">Help</a>

        </div>
    </footer>

</body>

</html>