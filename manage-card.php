<?php
session_start();

if($_SERVER["REQUEST_METHOD"]="POST")
{
    if(isset($_POST['Add_to_Cart']))
    {
        if(isset($_SESSION['cart']))
        {
            $myitems=array_column($_SESSION['cart'],'Product_id');
            if(in_array($_POST['Product_id'],$myitems))
            {
                echo"<Script>
                alert('Item Already Added');
                window.location.href='choose.php';
                </Script>";

            }

            else{
            $count=count($_SESSION['cart']);
            $_SESSION['cart'][$count]=array('Product_id'=>$_POST['Product_id'],'Item_Name'=>$_POST['Item_Name'],'price'=>$_POST['price'],'Hotel_id'=>$_POST['Hotel_id'],'Quantity'=> 1);
            echo"<Script>
                alert('Item Added');
                window.location.href='choose.php';
                </Script>";
            } 
        }
        else
        {
            $_SESSION['cart'][0]=array('Product_id'=>$_POST['Product_id'],'Item_Name'=>$_POST['Item_Name'],'price'=>$_POST['price'],'Hotel_id'=>$_POST['Hotel_id'],'Quantity'=> 1);
            echo"<Script>
                alert('Item Added');
                window.location.href='choose.php';
                </Script>";
        }


    }
    if(isset($_POST['remove-item']))
    {
        foreach($_SESSION['cart'] as $key => $value)
        {
            if($value['Product_id']==$_POST['Product_id'])
            {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart']=array_values($_SESSION['cart']);
                echo"<script>
                alert('Item Removed');
                window.location.href='cart.php';
                </script>";
            }
        }
    }
    if(isset($_POST['mod_quantity']))
    {
        foreach($_SESSION['cart'] as $key => $value)
        {
            if($value['Product_id']==$_POST['Product_id'])
            {
                $_SESSION['cart'][$key]['Quantity']=$_POST['mod_quantity'];
                echo"<script>
                window.location.href='cart.php';
                </script>";
            }
        }

    }
}

?>