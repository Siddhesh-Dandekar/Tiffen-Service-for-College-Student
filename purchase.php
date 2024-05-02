<?php
session_start();
require_once "config.php";

$address = $rn = $total ="";


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $address = trim($_POST['address']);
    if(isset($_POST['purchase']))
    {
        $contact= $_SESSION['phone'];
        $rn = $_SESSION['username'];
        $query1="INSERT INTO `orders`(`Item_Name`, `price`,`total`, `Quantity`, `Product_id`, `Hotel_id`, `address`, `username`, `contact`, `order_status`) VALUES (?,?,?,?,?,?,?,'$rn','$contact','PLACED')";
        $stmt=mysqli_prepare($conn,$query1);
        if($stmt)
        {
        mysqli_stmt_bind_param($stmt,"sssssss",$Item_Name, $price, $total, $Quantity, $Product_id, $Hotel_id, $param_address);
        foreach($_SESSION['cart'] as $key => $values)
        {
            $total = $values['price']*$values['Quantity'];
            $Hotel_id = $values['Hotel_id'];
            $param_total = $total;
            $param_address = $address;
            $Item_Name = $values['Item_Name'];
            $Product_id = $values['Product_id'];
            $price = $values['price'];
            $Quantity= $values['Quantity'];
            mysqli_stmt_execute($stmt);
        }

        unset($_SESSION['cart']);
        echo"<script>
        alert('order placed');
        window.location.href='cart.php';
        </script>";
        }
    }

    else
    {
            echo"<script>
            alert('SQl error');
            window.location.href='cart.php';
            </script>";
    }
       
        
    
}
?>
