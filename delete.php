<?php
    session_start();
    if(!isset($_SESSION["id"])){
        echo $_SESSION["id"];
        header('location:admin.php');
    
    }
    else{
        include 'connect.php';
        $id=$_SESSION["id"];
        unset($_SESSION["id"]);
        $sql="DELETE FROM `product` WHERE id=$id";
        $result=mysqli_query($conn,$sql);
        header('location:admin.php');

    }

?>