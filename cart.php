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
        <a href="#">
            <img class="logo" src="img/logo.jpg" alt="logo">
            <span class="logoname">GMVIT FOOD</span>
        </a>
        <div>
            <ul id="navbar">
                <li><a href="home.html">Home</a></li>
                <li><a href="category.php">Category</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="wallet.php" > 
                <?php 
                $username = $_SESSION['username'];
                $query5= "SELECT * FROM users WHERE username='$username'";
                $resultt = $conn->query($query5);
                while($row = $resultt->fetch_assoc())
                    {
                        echo "₹ " . 
                            $row["wallet"]. "";
                    }
                ?>
                    </a></li>

            </ul>
        </div>
    </section>

    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>REMOVE</td>
                    <td>IMAGE</td>
                    <td>FOOD</td>
                    <td>PRICE</td>
                    <td>QUANTITY</td>
                    <td>SUBTOTAL</td>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(isset($_SESSION['cart']))
                {
                    $total ="0";
                foreach($_SESSION['cart'] as $key => $value)
                    {
                        
                        echo"
                        <tr>
                        <td>
                        <form action='manage-card.php' method='post'> 
                        <button class='btn' name='remove-item'><i class='far fa-times-circle'></i></button>
                        <input type='hidden' name='Product_id' value='$value[Product_id]'>
                        </form></td>
                        <td><img src='img/vada.jpg' alt=''></td>
                        <td><strong>$value[Item_Name]</strong></td>
                        <td><strong>$value[price]<input type='hidden' class ='iprice' value='$value[price]'></strong></td>
                        <td>
                        <form action='manage-card.php' method='post'> 
                        <input class='iquantity' type='number' name='mod_quantity' onchange='this.form.submit();' value='$value[Quantity]' min='1' max= '10' >
                        <input type='hidden' name='Product_id' value='$value[Product_id]'>
                        <input type='hidden' name='Hotel_id' Value='$value[Hotel_id]'>
                        <input type='hidden' name='order_status' Value='PLACED'>
                        </form>
                        </td>
                        <td class='itotal'><strong></strong></td>
                        </tr>";
                    }
                    
                }
                ?>
            </tbody>

        </table>
    </section>


    <section id="cart-add" class="section-p1">
        
        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Delivery Charges</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><Strong>Total ₹</Strong></td>
                    <td >
                        <h4 id="gtotal"></h4>
                    </td>
                </tr>

            </table>
            <?php
            if(isset($_SESSION['cart'])&& count($_SESSION['cart'])>0)
            {
            ?>

            
            <form action="cashpay.php" method="POST">

              <input type="hidden" name="total" Value="<?php echo $total?>">
                       
              <h3>Address</h3>
				<select id="text" class="form-control" name="address" required>
                  <option>Engineering College</option>
				  <option>Hostel</option>
                </select> <br><br>
				<br>

             <input name="purchase" id="button" type="submit" value="Proceed to Checkout">
            </form>


            <?php
            }
            ?>
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

    <script>
        var gt=0;
        var iprice=document.getElementsByClassName('iprice');
        var iquantity=document.getElementsByClassName('iquantity');
        var itotal=document.getElementsByClassName('itotal');
        var gtotal=document.getElementById('gtotal');

        function subTotal()
        {
            var gt=0;
            for(i=0;i<iprice.length;i++)
            {
                itotal[i].innerText=(iprice[i].value)*(iquantity[i].value);
                gt=gt+(iprice[i].value)*(iquantity[i].value);
            }
            gtotal.innerText=gt;
            
        }

        subTotal();
        {

        }

    </script>

</body>

</html>