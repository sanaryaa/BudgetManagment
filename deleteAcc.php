<?php session_start();
require_once "./includes/connect.php";

// Prepare SQL statement and execute
$sql1 = "DELETE FROM users WHERE user_id=" . $_SESSION["user_id"];
$sql2 = "DELETE FROM food_items WHERE user_id=" . $_SESSION["user_id"];
$sql3 = "DELETE FROM shopping_items WHERE user_id=" . $_SESSION["user_id"];
$sql4 = "DELETE FROM health_items WHERE user_id=" . $_SESSION["user_id"];
$sql5 = "DELETE FROM other_items WHERE user_id=" . $_SESSION["user_id"];
$sql6 = "DELETE FROM lent_items WHERE user_id=" . $_SESSION["user_id"];
$sql7 = "DELETE FROM borrow_items WHERE user_id=" . $_SESSION["user_id"];

if (mysqli_query($con, $sql1) and mysqli_query($con, $sql2)  and mysqli_query($con, $sql3) and mysqli_query($con, $sql4) and mysqli_query($con, $sql5) and mysqli_query($con, $sql6) and mysqli_query($con, $sql7)   ) {
    session_destroy();
   header("location: signup.php");
} else {
    echo "Error deleting account: " . mysqli_error($con);
}

// Close database connection
mysqli_close($con);

?>
