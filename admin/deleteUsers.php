<?php
require_once "../includes/connect.php";
if(isset($_GET['delete_users'])){
    $id=$_GET['delete_users'];

    $sql="DELETE FROM users WHERE user_id=$id";
    $sql2 = "DELETE FROM food_items WHERE user_id=" . $id;
$sql3 = "DELETE FROM shopping_items WHERE user_id=" . $id;
$sql4 = "DELETE FROM health_items WHERE user_id=" . $id;
$sql5 = "DELETE FROM other_items WHERE user_id=" . $id;
$sql6 = "DELETE FROM lent_items WHERE user_id=" . $id;
$sql7 = "DELETE FROM borrow_items WHERE user_id=" . $id;


    if(mysqli_query($con,$sql) and mysqli_query($con, $sql2)  and mysqli_query($con, $sql3) and mysqli_query($con, $sql4) and mysqli_query($con, $sql5) and mysqli_query($con, $sql6) and mysqli_query($con, $sql7)){

        header('location:users.php');
    }else{
        die(mysqli_error($con));
    }
}
?>