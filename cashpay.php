<?php
session_start();
require_once "config.php";
require 'time.php';

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}

?>

<?php
if($_SESSION['Stock'] == true){
if($_SESSION['wallet'] > 0 ){
    $gtotal = 0;
    foreach($_SESSION["cart"] as $keys => $values) {
        $total = ($values["Quantity"] * $values["price"]);
        $gtotal = $gtotal + $total;
    }
    if($gtotal < $_SESSION['wallet']){
        $amount = $_SESSION['wallet']-$gtotal;
        $username = $_SESSION["username"];

        $query ="UPDATE users SET wallet='$amount' WHERE username='$username'";
        $success = $conn->query($query);

        $item = $_SESSION["cart"][0];
        $Hotel_id = $item["Hotel_id"];
        ;
        $order_status = "PLACED";
        $delivery_address = $_POST["address"];
        $query = "INSERT INTO orders (total, address, username, Hotel_id , order_status) 
            VALUES ('" . $gtotal . "','" . $delivery_address . "','" . $username . "','" . $Hotel_id . "','" . $order_status . "')";

        $success = $conn->query($query);

        $order_id = $conn->insert_id;
        foreach($_SESSION["cart"] as $keys => $values) 
        {
        $Product_id = $values["Product_id"];
        $Quantity = $values["Quantity"];
        $query = "INSERT INTO order_item (order_id, Product_id, Quantity) 
                VALUES ('". $order_id ."','" . $Product_id . "','" . $Quantity . "')";

        $success = $conn->query($query); 
        }
       unset($_SESSION["cart"]);
        echo"<script>
        alert('order placed');
        window.location.href='cart.php';
        </script>";
    }
    else{
        echo"<script>
        alert('Insufficient Balance');
        window.location.href='cart.php';
        </script>";
    }
}
else{
    echo"<script>
        alert('Insufficient Balance: Please recharge Your Wallet');
        window.location.href='cart.php';
        </script>";

}
}
else{

    header("location: category.php");

}
?>