<?php
include '../includes/connect.php';
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
    <link rel="stylesheet"  href="./adminStyle.css"/>

    <title>Budget Management</title>
</head>

<body>

    <div class="btns container mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <a href="admin.php"><button class="bt <?php if($activeTable=='food'){echo 'foodActive';}?>">Foods</button></a>
                    <a href="shopping.php"><button class="bt <?php if($activeTable=='shopping'){echo 'shoppingActive';}?>">Shopping</button></a>
                    <a href="health.php"><button class="bt <?php if($activeTable=='health'){echo 'healthActive';}?>">Health</button></a>
                    <a href="others.php"><button class="bt <?php if($activeTable=='others'){echo 'othersActive';}?>">Others</button></a>
                    <a href="borrow.php"><button class="bt <?php if($activeTable=='borrow'){echo 'borrowActive';}?>">Borrows</button></a>
                    <a href="lent.php"><button class="bt <?php if($activeTable=='lent'){echo 'lentActive';}?>">Lents</button></a>
                    <a href="users.php"><button class="bt <?php if($activeTable=='user'){echo 'userActive';}?>">List Users</button></a>
                </div>

            </div>
        </div>
    </div>


    <!-- ionicons link -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- bootstrap js -->
    <script src="../bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>


</body>

</html>