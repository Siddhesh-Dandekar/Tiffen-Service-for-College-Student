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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<body>
    <section id="header">
        <a href="home.html">
            <img class="logo" src="img/logo.jpg" alt="logo">
            <span class="logoname">GMVIT FOOD</span>
        </a>
        <div>
            <ul id="navbar">
                <li><a>
                        <?php echo "". $_SESSION['username']?>
                    </a></li>
                <li><a href="myorders.php">Orders</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="logout.php">Logout</a></li>

            </ul>
        </div>
    </section>

    <section id="wallet_page"
        style="background-image:url(img/payment.jpg);    background-size: contain; background-repeat:no-repeat;">
        <div class="bal">
            <p>Your Balance Amount is</p>
            <a style="font-size :50px;">
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
            </a>
            <br>
            <br>
            <p style="font-weight:550; font-size:40px">Add Money</p>
            <form>
            <input type="textbox" name="name" id="name" placeholder="Enter your name"/><br/><br/>
            <input type="textbox" name="amt" id="amt" placeholder="Enter amount"/><br/><br/>
            <input type="button" name="btn" id="wallet_button" value="Pay Now" onclick="pay_now()"/>
            </form>
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
            <a href="cart.php">View Cart</a>
            <a href="#">Help</a>

        </div>
    </footer>

    <script>
    function pay_now(){
        var name=jQuery('#name').val();
        var amt=jQuery('#amt').val();
        
         jQuery.ajax({
               type:'post',
               url:'payment_process.php',
               data:"amt="+amt+"&name="+name,
               success:function(result){
                   var options = {
                        "key": "rzp_test_gXrbOYT3URkzac", 
                        "amount": amt*100, 
                        "currency": "INR",
                        "name": "Acme Corp",
                        "description": "Test Transaction",
                        "image": "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
                        "handler": function (response){
                           jQuery.ajax({
                               type:'post',
                               url:'payment_process.php',
                               data:"payment_id="+response.razorpay_payment_id,
                               success:function(result){
                                   window.location.href="thank_you.php";
                               }
                           });
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
               }
           });
        
        
    }
</script>

</body>

</html>