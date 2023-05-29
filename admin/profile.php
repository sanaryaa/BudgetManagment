<?php
session_start();
unset($_SESSION['user']);
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
    <!-- css file -->

    <link rel="stylesheet" href="../style.css" />
    <title>Budget Management</title>

<style>
   .back-icon{
  margin-left: 20px;
  border:1px solid #3f5a9f !important;
  color:#3f5a9f  !important;
  width:80px;
  height:40px;
  border-radius:5px;
}

</style>
</head>

<body class="d-flex flex-column">
    <a href="./admin.php" class="back-icon d-flex align-items-center justify-content-center mt-2"><i class="fa-solid fa-arrow-left pe-2"></i>Home</a>
    <section class="body-content p-0">
        <div class="container mt-5 pt-5 d-flex flex-column justify-content-center align-items-center">
            <div class="user-acc  w-100">
                <div class="acc-info user-info d-flex align-items-center p-md-5 ">
                    <div class="pro-img ps-2">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="card-body ps-4 pt-2 ">
                        <h4><?php echo $_SESSION["username"]; ?></h4>
                    </div>
                    <div class="editIcon pe-2">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#<?php echo $_SESSION["user_id"]; ?>">
                            <ion-icon name="pencil-sharp"></ion-icon>
                        </a>
                    </div>
                </div>
                <div class="acc-info acc-setting d-flex align-items-center p-md-5">
                    <ul class="list-unstyled">
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#DarkMode"><i class="fa-solid fa-circle-half-stroke pe-2"></i>Dark mode</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#Language"><i class="fa-solid fa-earth-americas pe-2"></i>Language</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#logoutAcc"><i class="fa-solid fa-arrow-right-from-bracket pe-2"></i>Logout</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#deleteAcc"><i class="fa-solid fa-user-xmark pe-2"></i>Delete account</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="modal" id="<?php echo $_SESSION["user_id"]; ?>" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5">
                <?php
                    if (isset($_GET['error_message'])) {
                        $error_message = $_GET['error_message'];
                        echo "<script>alert('$error_message');</script>";
                    }
                    ?>
                    <form id="myForm" class="needs-validation" novalidate action="update.php" method="post">
                        <div class="mb-3">
                            <label for="input1" class="form-label fs-5">Admin Name</label>
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
                            <div class="form-row d-flex">
                                <div class="col ">
                                    <input type="text" name="username" class="form-control" value="<?php echo $_SESSION['username']; ?>" placeholder="First name" required>
                                    <div class="invalid-feedback">
                                        Please fill your admin name
                                    </div>

                                </div>
                            </div>
                            <label for="input1" class="form-label fs-5">Email</label>
                            <input type="text" class="form-control" id="input1" name="email" value="<?php echo $_SESSION["email"]; ?>" placeholder="email" required>
                            <div class="invalid-feedback">
                                Please fill email
                            </div>
                        </div>
                        <div class="modal-footer border border-0   d-flex justify-content-center align-item-center mb-3">
                            <input type="submit" class="btnModal btn-save" name="updateProfile" value="Save Change">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Logout Account -->
    <div class="modal" id="logoutAcc" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header   border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5 pb-3" style="color: #3f5a9f;">
                    <h5>Are you sure you want to Logout?</h5>
                </div>
                <div class="modal-footer border border-0 align-self-center pb-5">
                    <a href="./logout.php"><button type="submit" class="btnModal btn-delete">Yes</button></a>
                    <a href="./profile.php"><button type="submit" class="btnModal btn-delete" from="myForm">No</button></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account -->
    <div class="modal" id="deleteAcc" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header   border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5 pb-3" style="color: #3f5a9f;">
                    <h5>Are you sure you want to delete your account?</h5>
                </div>
                <div class="modal-footer border border-0 align-self-center pb-5">
                    <form method="POST" action="deleteAcc.php">
                        <button type="submit" name="delete" class="btnModal btn-delete" from="myForm">Yes</button>
                        <button type="submit" name="noDelete" class="btnModal btn-delete" from="myForm">No</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        (() => {
            'use strict'
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')
            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    <!-- ionicons link -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- bootstrap js -->
    <script src="../bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>


</body>

</html>