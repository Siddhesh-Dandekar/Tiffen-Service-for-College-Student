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

	<section id="header">
		<a href="#">
			<img class="logo" src="img/logo.jpg" alt="logo">
			<span class="logoname">GMVIT FOOD</span>
		</a>

		<span class="logoname"><?php echo "Welcome....". $_SESSION["useradmin"] ?></span>
        <div>
            <ul id="navbar">
                <li><a href="admin.php">Home</a></li>
                <li><a><?php 
                $useradmin = $_SESSION['useradmin'];
                $query5= "SELECT * FROM hotel WHERE useradmin='$useradmin'";
                $resultt = $conn->query($query5);
                while($row = $resultt->fetch_assoc())
                    {
                        $_SESSION['wallet'] = $row["wallet"];
                        echo "₹ " . 
                            $row["wallet"]. "";
                    }
                ?></a></li>
                <li><a href="logout_admin.php">Logout</a></li>
            </ul>
        </div>

	</section>

    <!-- hotel incoming order -->

        <div class="section-p1" id="pending">
        <h1 class="center">Pending Orders</h1>
        <table class="table table-striped table-hover container">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Order date</th>
                <th>Total price</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $useradmin = $_SESSION['useradmin'];
                $query="select * from hotel, orders where hotel.useradmin='$useradmin' and orders.Hotel_id=hotel.Hotel_id and orders.order_status='PLACED' order by orders.order_date";
                $result = $conn->query($query);
                while($row=($result->fetch_assoc())){
                    echo    
                    '
                            <tr class="tab">
                                <td>'.$row['order_id'].'</td>
                                <td>'.$row['username'].'</td>
                                <td>'.$row['address'].'</td>
                                <td>'.$row['order_date'].'</td>
                                <td>'.$row['total'].'</td>
                                <td><button type="button" class="expand" data-toggle="modal" data-target="#order'.$row['order_id'].'">
                                    Detail
                                </button>
                                </td>
                            </tr>
                    ';
                }
            ?>
            <tbody>
        </table>
        </div>


        <?php
                $useradmin = $_SESSION['useradmin'];
                $query="select * from hotel, orders where hotel.useradmin='$useradmin' and orders.Hotel_id=hotel.Hotel_id and orders.order_status='PLACED'";
                $result = $conn->query($query);
                while($row=($result->fetch_assoc())){
                    echo '
                        <div class="modal fade" id="order'.$row['order_id'].'" tabindex="-1" role="dialog" aria-labelledby="orderLabel'.$row['order_id'].'">
                                    <div class="modal-dialog mw-100 w-75" role="document"  >
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 id="orderLabel'.$row['order_id'].'">DETAILS OF ORDER '.$row['order_id'].'</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body" id="pending-2">
                                            <table class="table table-striped table-hover container">
                                                <tr>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                
                                                </tr>
                            ';
                    $query = "select * from order_item, menu_item where order_item.order_id='".$row['order_id']."' and menu_item.Product_id = order_item.Product_id";
                    $result_item = $conn->query($query);
                    while($row_item=($result_item->fetch_assoc())){
                        echo          
                                    '
                                                <tr>
                                                <td>'.$row_item['name'].'</td>
                                                <td>'.$row_item['Quantity'].'</td>
                                                <td>'.$row_item['price'].'</td>
                                                
                                                </tr>
                                    ';
                    }
                                     
                    echo 
                    '
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="mark_delivered.php?id='.$row['order_id'].'" type="button" class="expand">Mark Delivered</a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                    ' ;
                }
        ?>


  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</body>