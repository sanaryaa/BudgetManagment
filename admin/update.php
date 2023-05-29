<?php
session_start();
require_once '../includes/connect.php';

if (isset($_POST['updateRoleBtn'])) {
	$user_id = $_POST['user_id'];
	$role = $_POST['updateRole'];

	mysqli_query($con, "UPDATE users SET  role= '$role' WHERE user_id = '$user_id'");

if($role == "admin"){

	$sql2 = "DELETE FROM food_items WHERE user_id='$user_id'";
	$sql3 = "DELETE FROM shopping_items WHERE user_id='$user_id'";
	$sql4 = "DELETE FROM health_items WHERE user_id='$user_id'";
	$sql5 = "DELETE FROM other_items WHERE user_id='$user_id'";
	$sql6 = "DELETE FROM lent_items WHERE user_id='$user_id'";
	$sql7 = "DELETE FROM borrow_items WHERE user_id='$user_id'";


	if (mysqli_query($con, $sql2)  and mysqli_query($con, $sql3) and mysqli_query($con, $sql4) and mysqli_query($con, $sql5) and mysqli_query($con, $sql6) and mysqli_query($con, $sql7)) {
		header("location: users.php");
	} else {
		echo "Error deleting account: " . mysqli_error($con);
	}
}else{
	header("Location: users.php");
}


}

if (isset($_POST['updateProfile'])) {
	$user_id = $_POST['user_id'];
	$username = $_POST['username'];
	$email = $_POST['email'];

	$errors = array();

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		array_push($errors, "Email is not valid");
	}

	$sql = "SELECT * FROM users WHERE email = ? AND email != ?";
	$stmt = mysqli_prepare($con, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $email, $_SESSION['email']);
	mysqli_stmt_execute($stmt);
	$result1 = mysqli_stmt_get_result($stmt);
	$rowCount1 = mysqli_num_rows($result1);

	if ($rowCount1 > 0) {
		array_push($errors, "Email already exists!");
	}
	$sql = "SELECT * FROM users WHERE username = ? AND username != ?";
	$stmt = mysqli_prepare($con, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $username, $_SESSION['username']);
	mysqli_stmt_execute($stmt);
	$result2 = mysqli_stmt_get_result($stmt);
	$rowCount2 = mysqli_num_rows($result2);

	if ($rowCount2 > 0) {
		array_push($errors, "username already exists!");
	}
	if (count($errors) > 0) {
		// Concatenate the elements of the $errors array into a single string
		$error_string = implode(" & ", $errors);

		// urlencode() is a PHP function that is used to encode a string for use in a URL query string
		header("Location: profile.php?error_message=" . urlencode($error_string));
	} else {
		$sql = "UPDATE users SET  username= ?, email= ? WHERE user_id = ?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, "ssi", $username, $email, $user_id);
		mysqli_stmt_execute($stmt);
		session_destroy();
		header("Location: ../signIn.php");
	}
}
