<?php
include '../includes/connect.php';
session_start();
unset($_SESSION['user']);
if (!isset($_SESSION["admin"])) {
    header("Location: ../signin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css" />
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./style.css" />

    <title>Budget Management</title>
</head>

<body class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex align-items-center justify-content-between">
        <h5 class="fs-4 ms-5">DashBoard</h5>
        <a class="nav-link pro-icon me-5" href="./profile.php"><i class="fa-solid fa-user"></i></a>
    </nav>
    <?php
     $activeTable = 'user';
    include 'buttons.php';
    ?>
    <div class="search-sec  mt-5">
        <form class="d-flex align-items-center justify-content-center" action="users.php" method="post">
            <div class="form-group d-flex  align-items-center justify-content-center ">

                <label for="exampleInputSearch" class="fs-5">ID</i></label>
                <input type="text" class="form-control " id="exampleInputSearch" aria-describedby="emailHelp" name="user_id">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Search">
        </form>
    </div>
    <div class="table-sec d-flex  align-items-center justify-content-center mt-5">
        <table class="table w-75">
            <thead class="thead-light">
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Password</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['submit'])) {
                    $getID = $_POST['user_id'];
                    $get_items = "SELECT * from users where user_id='$getID'";
                    $result = mysqli_query($con, $get_items);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $user_id = $row['user_id'];
                            $username = $row['username'];
                            $first_name = $row['first_name'];
                            $last_name = $row['last_name'];
                            $email = $row['email'];
                            $role = $row['role'];
                            $password = $row['password'];
                            echo '
                            <tr>
                            <th scope="row">' . $user_id . '</th>
                            <td>' . $username . '</td>
                            <td>' . $first_name . '</td>
                            <td>' . $last_name . '</td>
                            <td>' . $email . '</td>

                            <td>' . $role . '</td>
                            ';
                            if($_SESSION["user_id"] != $user_id && $user_id != 16){
                                echo '<td><a href="#" data-bs-toggle="modal" data-bs-target="#'.$user_id.'">
                                    <ion-icon name="pencil-sharp"></ion-icon>
                                    </a></td>
                                    <td><a href="deleteUsers.php?delete_users=' . $user_id . '"><ion-icon name="trash-outline" ></ion-icon></a></td>
                                    ';
                            }else{
                                echo '<td>   </td>
                                <td>    </td>
                                ';
                            }
                            echo '



                                <td>'   . $password . '</td>


                        </tr>

                        <div class="modal" id="'. $user_id .'" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-5">

                                    <form id="myForm" class="needs-validation" novalidate action="update.php" method="post">
                                        <div class="mb-3">

                                            <input type="hidden" name="user_id" value="'.$user_id.'" />
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select name="updateRole" class="form-control">
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>
                                            </div>
                                        </div>
                                        <div class="modal-footer border border-0   d-flex justify-content-center align-item-center mb-3">
                                            <input type="submit" class="btnModal btn-save" name="updateRoleBtn" value="Save Change">
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                        ';
                        }
                    } else {
                        echo '
                        <tr>
                        <td colspan="5">No result found</td>
                    </tr>';
                    }
                } else {
                    $get_items = "SELECT * from users ";
                    $result = mysqli_query($con, $get_items);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row['user_id'];
                        $username = $row['username'];
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $email = $row['email'];
                        $password = $row['password'];
                        $role = $row['role'];
                        echo '
                            <tr>
                            <th scope="row">' . $user_id . '</th>
                            <td>' . $username . '</td>
                            <td>' . $first_name . '</td>
                            <td>' . $last_name . '</td>
                            <td>' . $email . '</td>

                            <td>' . $role . '</td>
                            ';
                            if($_SESSION["user_id"] != $user_id && $user_id != 16){
                                echo '<td><a href="#" data-bs-toggle="modal" data-bs-target="#'.$user_id.'">
                                    <ion-icon name="pencil-sharp"></ion-icon>
                                    </a></td>
                                    <td><a href="deleteUsers.php?delete_users=' . $user_id . '"><ion-icon name="trash-outline" ></ion-icon></a></td>
                                    ';
                            }else{
                                echo '<td>   </td>
                                <td>    </td>
                                ';
                            }
                            echo '



                                <td>'   . $password . '</td>


                        </tr>';?>
                         <div class="modal" id="<?php echo $user_id ?>" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5">

                    <form id="myForm" class="needs-validation" novalidate action="update.php" method="post">
                        <div>

                            <input type="hidden" name="user_id" value="<?php echo $user_id?>" />
                            <div class="form-group ">
                                <label>Select role:</label>
                                <select name="updateRole" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                            </div>
                        </div>
                        <div class="modal-footer border border-0   d-flex justify-content-center align-item-center ">
                            <input type="submit" class="btnModal btn-save mt-5" name="updateRoleBtn" value="Save Change">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

                        <?php
                    }
                }


                mysqli_close($con);
                ?>
            </tbody>
        </table>
    </div>



    <!-- ionicons link -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- bootstrap js -->
    <script src="../bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
</body>

</html>