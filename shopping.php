<?php session_start();
require_once "./includes/connect.php";
if (!isset($_SESSION["user"])) {
  header("Location: signIn.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- bootstrap css -->
  <link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css" />
  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- css file -->
  <link rel="stylesheet" href="style.css">
  <title>Budget Management</title>
</head>

<body class="d-flex flex-column flex-lg-row">
  <!-- style expenses page to atcive at navigaion -->
  <?php $activeNav = 'expenses';
  include './includes/nav.php'; ?>
  <section class="body-content">
    <div class="container mt-5 mt-lg-0">
      <!-- style shopping button to atcive  -->
      <?php $activeExpen = 'shopping';
      include './includes/expenses.php'; ?>
      <div class="items d-flex flex-column justify-content-center align-items-center w-100">
        <?php
        // display  shopping items in card that belonging to the user
        $user_id = $_SESSION['user_id'];
        $select_query = "SELECT * FROM shopping_items WHERE user_id = {$_SESSION['user_id']} and month(date)={$_SESSION['month']} and year(date)={$_SESSION['year']}";
        $result_query = mysqli_query($con, $select_query);

        if (mysqli_num_rows($result_query) > 0) {
          while ( $row = mysqli_fetch_assoc($result_query)) {
              $shop_id = $row['shop_id'];
              $item_name = $row['item_name'];
              $price = $row['price'];
              $date = $row['date'];

              // when data-bs-target="#'. $shop_id .'" is clicked, it will open a modal with an id attribute equal to the value of the $shop_id variable.
              echo '
      <div class="cards d-flex align-items-center w-100" style="border-left: 4px solid #ba68c8;">
      <div class="card-body ps-4">
        <h5 class="card-title"> ' . $item_name . '</h5>
        <p class="date pt-2 mb-2 ">' . $date . '</p>
      </div>
      <div class="price me-2 d-flex justify-content-center align-items-center" style="background-color:#f7d8fd;">
        <h4>$' . $price . '</h4>
      </div>
      <div class="cardIcons  pe-sm-4" >
      <a href="#" data-bs-toggle="modal" data-bs-target="#' . $shop_id . '"><ion-icon name="pencil-sharp"></ion-icon></a>
         <a href="deleteItems.php?delete_shop_id=' . $shop_id . '"><ion-icon name="trash-outline" ></ion-icon></a>
      </div>
    </div>



    <div class="modal" id="' . $shop_id . '" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0" >
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body px-5">
            <form id="myForm" class="needs-validation" novalidate action="update.php" method="post">
              <div class="mb-3">
                <label for="updatename" class="form-label fs-4">Item name</label>
                <input type="hidden" name="shop_id" value="' . $shop_id . '"/>
                <input type="text" class="form-control" id="updatename" name="itemName" value="' . $item_name . '" placeholder="item name" >
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="updateprice" class="form-label fs-4">Price</label>
                    <input type="text" class="form-control" id="updateprice" value="' . $price . '" name="price" placeholder="$0" >
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3">
                    <label for="updatedate" class="form-label fs-4">Date</label>
                    <input type="Date" class="form-control" id="updatedate" value="' . $date . '" name="date" >
                  </div>
                </div>
              </div>
              <div class="modal-footer border border-0   d-flex justify-content-center align-item-center mb-3">
        <input type="submit" class="btnModal btn-add" name="updateShopping" value="Save Change">
         </div>
            </form>
          </div>

        </div>
      </div>
    </div>
    ';

          }
        } else {
          echo '<h2 class="no-item">No item</h2>';
        }
        ?>
      </div>

      <!-- add button -->
      <button type="button" class="btn-plus d-flex align-items-center justify-content-center  fixed-bottom-right" data-bs-toggle="modal" data-bs-target="#exampleModal" title="add item"><i class=" fa-regular fa-plus ps-1"></i></button>

      <!-- Add Modal -->
      <div class="modal" id="exampleModal" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header   border-0">
              <form method="post" action="shopping.php">
                <button type="submit" name="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </form>
            </div>
            <div class="modal-body px-5">
              <?php
              if (isset($_POST["close"])) {
                //reloads the current page (by setting the window.location.href to the current URL). This is done to refresh the page and show the newly added item in the list.
                echo '<script>window.location.href = window.location.href;</script>';
              }
              if (isset($_POST["submit"])) {
                $item_name = $_POST['item_name'];
                $price = $_POST['price'];
                $date = $_POST['date'];
                $user_id = $_SESSION['user_id'];
                $errors = array();
                  $insert_query = "INSERT INTO shopping_items (item_name,price,date,user_id) VALUES ( '$item_name', '$price','$date','$user_id')";
                  $sql_execute = mysqli_query($con, $insert_query);
                  if ($sql_execute) {
                    // reloads the current page (by setting the window.location.href to the current URL). This is done to refresh the page and show the newly added item in the list.
                    echo '<script>window.location.href = window.location.href;</script>';
                  } else {
                    die("Something went wrong");
                  }

              }
              ?>
              <form id="myForm" class="needs-validation" novalidate method="post">
                <div class="mb-3">
                  <label for="input1" class="form-label fs-4">Item name</label>
                  <input type="text" class="form-control" id="input1" name="item_name" placeholder="item name" required>
                  <div class="invalid-feedback">
                    please enter item name
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label for="input2" class="form-label fs-4">Price</label>
                      <input type="text" class="form-control" id="input2" name="price" placeholder="$0" required>
                      <div class="invalid-feedback">
                        please enter price
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                      <label for="input3" class="form-label fs-4">Date</label>
                      <input type="Date" class="form-control" id="input3" name="date" required>
                      <div class="invalid-feedback">
                        please select date
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer border border-0   d-flex justify-content-center align-item-center mb-3">
                  <input type="submit" class="btnModal btn-add" name="submit" value="ADD">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- applying custom Bootstrap validation styles to forms and preventing their submission if they are not valid. -->
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
  <script src="bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
</body>

</html>