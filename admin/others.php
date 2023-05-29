<?php
include '../includes/connect.php';
session_start();
unset($_SESSION['user']);
// checking whether a user is logged in or not. If the user is not logged in, it redirects them to the sign-in page.
if (!isset($_SESSION["admin"])) {
    header("Location: ../signIn.php");
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
    <title>Budget Management</title>
    <link rel="stylesheet"  href="./adminStyle.css"/>
</head>
<body class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex align-items-center justify-content-between">
    <h5 class="fs-4 ms-5">DashBoard</h5>
    <a class="nav-link pro-icon me-5" href="./profile.php"><i class="fa-solid fa-user"></i></a>
    </nav>
    <?php
     $activeTable = 'others';
    include 'buttons.php';
    ?>
    <div class="search-sec  mt-5">
        <form class="d-flex align-items-center justify-content-center" action="admin.php" method="post">
            <div class="form-group d-flex  align-items-center justify-content-center ">

                <label for="exampleInputSearch" class="fs-5">ID</i></label>
                <input type="text" class="form-control " id="exampleInputSearch" aria-describedby="emailHelp" name="user_id">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Search">
        </form>
    </div>
    <div class="table-sec d-flex  align-items-center justify-content-center mt-5">
        <table class="table w-75 ">
            <thead class="thead-light">
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Item ID</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody >
                <?php
                if(isset($_POST['submit'])){
                    $getID = $_POST['user_id'];
                    $get_items = "SELECT * from other_items where user_id='$getID'";
                    $result = mysqli_query($con, $get_items);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $others_id = $row['others_id'];
                            $user_id = $row['user_id'];
                            $item_name = $row['item_name'];
                            $price = $row['price'];
                            $date = $row['date'];
                            echo '
                            <tr>
                            <th scope="row">' . $user_id . '</th>
                            <td>' . $others_id . '</td>
                            <td>' . $item_name . '</td>
                            <td>' . $price . '</td>
                            <td>' . $date . '</td>
                        </tr>';
                        }
                    } else {
                        echo '
                        <tr>
                        <td colspan="5">No result found</td>
                    </tr>';
                    }
                }else {
                    $get_items = "SELECT * from other_items ";
                    $result = mysqli_query($con, $get_items);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $others_id = $row['others_id'];
                        $user_id = $row['user_id'];
                        $item_name = $row['item_name'];
                        $price = $row['price'];
                        $date = $row['date'];
                        echo '
                        <tr>
                        <th scope="row">' . $user_id . '</th>
                        <td>' . $others_id . '</td>
                        <td>' . $item_name . '</td>
                        <td>' . $price . '</td>
                        <td>' . $date . '</td>
                    </tr>';
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