<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}

if(!isset($_SESSION['kokan']) || $_SESSION['kokan'] !==true)
{
    header("location: category.php");
    
}

require 'time.php';
if($_SESSION['Stock'] == false){
     header("location: category.php");
}

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
        <a href="#">
            <img class="logo" src="img/logo.jpg" alt="logo">
            <span class="logoname">GMVIT FOOD</span>
        </a>
        <div>
            <ul id="navbar">
                <li><a><?php echo "". $_SESSION['username']?></a></li>
                <li><a href="wallet.php" ><?php echo "₹ ". $_SESSION['wallet']?></a></li>
                <li><a href="home.html">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="cart.php">Cart</a></li>
                
            </ul>
        </div>
    </section>



    <section id="menu" class="section-p1">
        <div class="pro-container">
            
            <div class="pro">
                <img src="img/img.avif" alt="">
                <h5>Veg. Thali</h5>
            </div>
            <div class="des">
                <ul id ="navbar">
                <li><span class="price"><strong>₹ 90 </strong></span></li>
                <li><form action="manage-card.php" method="post">
                    <button class="btn"type="submit" name="Add_to_Cart">Add to Cart</button> 
                <input type="hidden" name="Product_id" value="300"> 
                <input type="hidden" name="Item_Name" value="Vada Pav">
                <input type="hidden" name="price" Value="90">
                <input type="hidden" name="Hotel_id" Value="1002">
                </form>
                </li>
                </ul>
            </div>
            
        </div>


        <div class="pro-container">
            
            <div class="pro">
                <img src="img/img.avif" alt="">
                <h5>Paneer Rice</h5>
            </div>
            <div class="des">
                <ul id ="navbar">
                <li><span class="price"><strong>₹ 110 </strong></span></li>
                <li><form action="manage-card.php" method="post">
                    <button class="btn"type="submit" name="Add_to_Cart">Add to Cart</button> 
                <input type="hidden" name="Product_id" value="301">   
                <input type="hidden" name="Item_Name" value="misal pav">
                <input type="hidden" name="price" Value="110">
                <input type="hidden" name="Hotel_id" Value="1002">
                </form>
                </li>
                </ul>
            </div>
            
        </div>
        <div class="pro-container">
            
            <div class="pro">
                <img src="img/img.avif" alt="">
                <h5>Veg. Fried Rice</h5>
            </div>
            <div class="des">
                <ul id ="navbar">
                <li><span class="price"><strong>₹ 110 </strong></span></li>
                <li><form action="manage-card.php" method="post">
                    <button class="btn"type="submit" name="Add_to_Cart">Add to Cart</button> 
                <input type="hidden" name="Product_id" value="302"> 
                <input type="hidden" name="Item_Name" value="Vada Pav">
                <input type="hidden" name="price" Value="110">
                <input type="hidden" name="Hotel_id" Value="1002">
                </form>
                </li>
                </ul>
            </div>
            
        </div>




    </section>


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
            <a href="#">View Cart</a>
            <a href="#">Help</a>

        </div>
    </footer>

</body>

</html>