<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- bootstrap css -->
  <link rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css"/>
  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!-- css file -->
  <link rel="stylesheet" href="../style.css">
  <title>Budget Management</title>
  </head>
  <body>
      <div class="fields-img d-flex justify-content-center align-items-center w-100">
      <h3>Fields</h3>
    </div>
    <div class="row">
      <div class="fields text-center my-5">
      <a href="./food.php"><button class="<?php if($activeExpen=='food'){echo 'foodActive';}?>">Food</button></a>
      <a href="./shopping.php"><button class="<?php if($activeExpen=='shopping'){echo 'shoppingActive';}?>">Shopping</button></a>
      <a href="./health.php"><button class="<?php if($activeExpen=='health'){echo 'healthActive';}?>">Health</button></a>
      <a href="./others.php"><button class="<?php if($activeExpen=='others'){echo 'othersActive';}?>">Others</button></a>
      </div>
    </div>
    <!-- ionicons link -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- js file -->
    <script src="index.js"></script>
    <!-- bootstrap js -->
    <script src="bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
  </body>
</html>
