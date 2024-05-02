<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}

// Check if Session is Active
if($_SESSION["malhar"]==true)
{
    header("location: malhar.php");
}
elseif($_SESSION["vatika"]==true)
{
    header("location: vatika.php");
}
elseif($_SESSION["kokan"]==true)
{
    header("location: kokan.php");
}
elseif($_SESSION["canteen"]==true)
{
    header("location: canteen.php");
}



// check the recived messages


if(isset($_POST["vati"])) {
    unset($_SESSION["malhar"]);
    unset($_SESSION["kokan"]);
    unset($_SESSION["canteen"]);
    $_SESSION["vatika"]=true;
    unset($_SESSION["cart"]);
    header("location: vatika.php");
    
}

if(isset($_POST["mal"])) {
    unset($_SESSION["vatika"]);
    unset($_SESSION["kokan"]);
    unset($_SESSION["canteen"]);
    $_SESSION["malhar"]=true;
    unset($_SESSION["cart"]);
    header("location: malhar.php");
}

if(isset($_POST["kok"])) {
    unset($_SESSION["vatika"]);
    unset($_SESSION["malhar"]);
    unset($_SESSION["canteen"]);
    $_SESSION["kokan"]=true;
    unset($_SESSION["cart"]);
    header("location: kokan.php");
}

if(isset($_POST["cant"])) {
    unset($_SESSION["vatika"]);
    unset($_SESSION["malhar"]);
    unset($_SESSION["kokan"]);
    $_SESSION["canteen"]=true;
    unset($_SESSION["cart"]);
    header("location: canteen.php");
}





?>

