<?php

require_once './includes/connect.php';
if(isset($_GET['delete_food_id'])){
    $id=$_GET['delete_food_id'];

    $sql="DELETE FROM food_items WHERE food_id=$id";
    $result=mysqli_query($con,$sql);
    if($result){

        header('location:food.php');
    }else{
        die(mysqli_error($con));
    }
}else if(isset($_GET['delete_shop_id'])){
    $id=$_GET['delete_shop_id'];

    $sql="DELETE FROM shopping_items WHERE shop_id=$id";
    $result=mysqli_query($con,$sql);
    if($result){

        header('location:shopping.php');
    }else{
        die(mysqli_error($con));
    }
}else if(isset($_GET['delete_health_id'])){
    $id=$_GET['delete_health_id'];

    $sql="DELETE FROM health_items WHERE health_id=$id";
    $result=mysqli_query($con,$sql);
    if($result){

        header('location:health.php');
    }else{
        die(mysqli_error($con));
    }
}else if(isset($_GET['delete_others_id'])){
    $id=$_GET['delete_others_id'];

    $sql="DELETE FROM other_items WHERE others_id=$id";
    $result=mysqli_query($con,$sql);
    if($result){

        header('location:others.php');
    }else{
        die(mysqli_error($con));
    }
}else if(isset($_GET['delete_lent_id'])){
    $id=$_GET['delete_lent_id'];

    $sql="DELETE FROM lent_items WHERE lent_id=$id";
    $result=mysqli_query($con,$sql);
    if($result){
        header('location:lent.php');
    }else{
        die(mysqli_error($con));
    }
}else if(isset($_GET['delete_borrow_id'])){
    $id=$_GET['delete_borrow_id'];

    $sql="DELETE FROM borrow_items WHERE borrow_id=$id";
    $result=mysqli_query($con,$sql);
    if($result){
        header('location:borrow.php');
    }else{
        die(mysqli_error($con));
    }
}
?>