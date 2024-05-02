<?php
session_start();
include('config.php');


if(isset($_POST['amt']) && isset($_POST['name'])){
    $_SESSION['ammt'] = $_POST['amt'];
    $amt=$_SESSION['ammt'];
    $name=$_POST['name'];
    $payment_status="pending";
    $added_on=date('Y-m-d h:i:s');
    mysqli_query($conn,"insert into payment(name,amount,payment_status,added_on) values('$name','$amt','$payment_status','$added_on')");
    $_SESSION['OID']=mysqli_insert_id($conn);
}


if(isset($_POST['payment_id']) && isset($_SESSION['OID'])){
    $payment_id=$_POST['payment_id'];
    $username=$_SESSION['username'];
    $query5= "SELECT * FROM users WHERE username='$username'";
                $resultt = $conn->query($query5);
                while($row = $resultt->fetch_assoc())
                    {
                        $_SESSION['wallet'] = $row["wallet"];
                    }
                    
    $wallet_amount= $_SESSION['wallet'] + $_SESSION['ammt'] ;

    mysqli_query($conn,"update payment set payment_status='complete',payment_id='$payment_id' where id='".$_SESSION['OID']."'");
    mysqli_query($conn,"update users set wallet ='$wallet_amount' where username='$username' ");
    unset($_SESSION['ammt']);

}
 
?>