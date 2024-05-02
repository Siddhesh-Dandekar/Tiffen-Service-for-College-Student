<?php

session_start();

if(!isset($_SESSION['loggedadmin']) || $_SESSION['loggedadmin'] !==true)
{
    header("location: login_admin.php");
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .modal-dialog {
            top: calc(30%);
        }
    </style>
    <title>GMVIT Food</title>
</head>

<body>
<?php
        if(isset($_GET['id'])){
            $order_id=($_GET['id']);
            
            $query2= "SELECT * FROM orders WHERE order_id='$order_id'";
            $resultt = $conn->query($query2);
            while($row = $resultt->fetch_assoc())
                    {
                        $total = $row['total'];
                    }


            $useradmin = $_SESSION['useradmin'];


            $query5= "SELECT * FROM hotel WHERE useradmin='$useradmin'";
            $resulttt = $conn->query($query5);
            while($row = $resulttt->fetch_assoc())
                        {
                         $_SESSION['wallet'] = $row["wallet"];
                        }

            $wallet = $_SESSION['wallet'] + $total;

            
            $query1= "update hotel set wallet='$wallet' where useradmin='$useradmin'";
            $result = $conn->query($query1);
        
            $query="UPDATE `orders` SET `order_status`='DELIVERED',`Payment`='CONFIRMED' WHERE order_id='$order_id'";
            $success=$conn->query($query);
            if (!$success){
                $msg="Failed to change order status";
                echo   '<script>
                    $(document).ready(function() {
                        $("#dialogMsg").text("'. $msg .'");
                        $("#signupDialog").modal();
                    });
                </script>';
            }
            if($success)
            {
                echo"<script>
                alert('Item Delivered');
                window.location.href='admin.php';
                </script>";
            }
            
            $conn->close();
        }
        
    ?>
</body>

</html>