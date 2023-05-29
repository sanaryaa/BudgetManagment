<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css" />
    <script src="./bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" />
    <title>Sign Up | Create an account</title>
</head>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class=" w-50 h-100  d-none d-md-none d-lg-flex align-items-center justify-content-center">
            <img src="./Image/signpage.png" alt="budget-management" width="750px" height="580px">
        </div>
        <div class="form-sec  d-flex align-items-center justify-content-center">
            <div class="backOfForm rounded-3 d-flex align-items-center justify-content-center flex-column">


                <?php $activeSign = 'signin';
                include './includes/sign.php'; ?>


                <form class="needs-validation rounded-3" novalidate action="signIn.php" method="post">

                    <?php
                        if (isset($_POST["signin"])) {
                        $user_name = $_POST["user_name"];
                        $password = $_POST["password"];

                        require_once "./includes/connect.php";

                        // Prepare statement
                        $stmt = mysqli_prepare($con, "SELECT * FROM users WHERE username = ?");

                        // Bind parameter
                        mysqli_stmt_bind_param($stmt, 's', $user_name);

                        // Execute statement
                        mysqli_stmt_execute($stmt);

                        // Get result
                        $result = mysqli_stmt_get_result($stmt);

                        // Fetch user
                        $user = mysqli_fetch_assoc($result);

                        // Check user
                        if ($user) {
                            // Verify password
                            if (password_verify($password, $user["password"])) {
                                // Start session


                                $_SESSION["first_name"] = $user['first_name'];
                                $_SESSION["last_name"] = $user['last_name'];
                                $_SESSION["username"] = $user['username'];
                                $_SESSION["email"] = $user['email'];
                                $_SESSION["user_id"] = $user['user_id'];
                                $_SESSION['myDate'] = date('Y-m');

                                if ($user['role'] == "admin") {
                                    $_SESSION['admin']="yes";
                                    header("Location: ./admin/admin.php");
                                  }
                                  else if($user['role'] == "user"){
                                    $_SESSION["user"] = "yes";
                                    header("Location: home.php");
                                }
                                die();
                            } else {
                                echo "<div class='alert alert-danger'>Password does not match</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>User does not match</div>";
                        }

                        // Close statement
                        mysqli_stmt_close($stmt);

                        // Close connection
                        mysqli_close($con);
                    }

                    ?>
                    <div class="form-group">
                        <label for="UserName">Username</label>
                        <input type="text" class="form-control" name="user_name" placeholder="User21" required>
                    </div>
                    <div class="form-group">
                        <label for="Password1">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="********" required>
                    </div>
                    <button type="submit" class="btn" name="signin">SignIn</button>
                    <h4 class="switching"><a href="./signUp.php">Don't have account?</a></h4>
                </form>
            </div>
        </div>
    </div>

</body>

</html>