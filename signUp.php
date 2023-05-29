
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
    <div class="container-fluid  d-flex align-items-center justify-content-center">
        <div class=" w-50 h-100  d-none d-md-none d-lg-flex align-items-center justify-content-center">
            <img src="./Image/signpage.png" alt="budget-management" width="700px" height="580px">
        </div>
        <div class="form-sec d-flex align-items-center justify-content-center">
            <div class="backOfForm rounded-3 d-flex align-items-center justify-content-center flex-column my-4">
                <?php
                $activeSign = 'signup';
                include './includes/sign.php';
                ?>
                <form class="needs-validation rounded-3" novalidate action="signUp.php" method="post">
                    <?php
                    if (isset($_POST["submit"])) {
                        $first_name = $_POST["first_name"];
                        $last_name = $_POST["last_name"];
                        $user_name = $_POST["user_name"];
                        $email = $_POST["email"];
                        $role=$_POST["role"];
                        $password = $_POST["password"];
                        $passwordRepeat = $_POST["con_password"];
                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);



                        $errors = array();

                        if (empty($first_name) or empty($last_name) or empty($user_name) or empty($email) or empty($password) or empty($passwordRepeat)) {
                            array_push($errors, "All fields are required");
                        }
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            array_push($errors, "Email is not valid");
                        }
                        if (strlen($password) < 8) {
                            array_push($errors, "Password must be at least 8 charactes long");
                        }
                        if ($password !== $passwordRepeat) {
                            array_push($errors, "Password does not match");
                        }
                        require_once "./includes/connect.php";
                        $sql = "SELECT * FROM users WHERE email = '$email'";
                        $result1 = mysqli_query($con, $sql);
                        $rowCount1 = mysqli_num_rows($result1);
                        if ($rowCount1 > 0) {
                            array_push($errors, "Email already exists!");
                        }

                        $sql = "SELECT * FROM users WHERE username='$user_name'";
                        $result2 = mysqli_query($con, $sql);
                        $rowCount2 = mysqli_num_rows($result2);
                        if ($rowCount2 > 0) {
                            array_push($errors, "username already exists!");
                        }

                        if (count($errors) > 0) {
                            foreach ($errors as  $error) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        }


                        else {

                            require_once "./includes/connect.php";

                            // Prepare statement
                            $stmt = mysqli_prepare($con, "INSERT INTO users (first_name, last_name, username, email,role, password) VALUES (?, ?, ?, ?,?,?)");

                            // Bind parameters
                            mysqli_stmt_bind_param($stmt, 'ssssss', $first_name, $last_name, $user_name, $email,$role, $passwordHash);

                            // Execute statement
                            $result = mysqli_stmt_execute($stmt);

                            if ($result) {
                                // Get the inserted user
                                $stmt = mysqli_prepare($con, "SELECT * FROM users WHERE username = ?");
                                mysqli_stmt_bind_param($stmt, 's', $user_name);
                                mysqli_stmt_execute($stmt);
                                $r = mysqli_stmt_get_result($stmt);
                                $user = mysqli_fetch_assoc($r);

                                // Start session
                                session_start();
                                $_SESSION["user"] = "yes";
                                $_SESSION["first_name"] = $user['first_name'];
                                $_SESSION["last_name"] = $user['last_name'];
                                $_SESSION["username"] = $user['username'];
                                $_SESSION["email"] = $user['email'];
                                $_SESSION["user_id"] = $user['user_id'];
                                $_SESSION['myDate'] = date('Y-m');
                                header("location: home.php");

                                die();
                            } else {
                                echo "Error: " . mysqli_error($con);
                            }

                            // Close statement
                            mysqli_stmt_close($stmt);

                            // Close connection
                            mysqli_close($con);
                        }
                    }

                    ?>
                    <div class="form-group ">
                        <label for="FullName">Full Name</label>
                        <div class="form-row d-flex">
                            <div class="col ">
                                <input type="text" name="first_name" class="form-control" placeholder="First name" required>
                            </div>
                            <div class="col">
                                <input type="text" name="last_name" class="form-control" placeholder="Last name" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="UserName">Username</label>
                        <input type="text" name="user_name" class="form-control" id="UserName" placeholder="User21" required>
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" name="email" class="form-control" id="Email" placeholder="user@gmail.com" required>
                    </div>

                    <div class="form-group">
                        <label for="Password1">Password</label>
                        <input type="password" name="password" class="form-control" id="Password1" placeholder="********" required>
                    </div>
                    <div class="form-group">
                        <label for="password2">Confirm your password</label>
                        <input type="password" name="con_password" class="form-control" id="password2" placeholder="********" required>
                    </div>

                    <input type="hidden" name="role" value="user">

                    <input type="submit" name="submit" class="btn" value="SignUp">
                    <h4 class="switching"><a href="./signIn.php">I have an account.</a></h4>
                </form>
            </div>
        </div>
    </div>
</body>

</html>