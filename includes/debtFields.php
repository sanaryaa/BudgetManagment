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

  <div class="row mx-2">
            <div class="debt-fields my-5 d-flex align-items-center">
                <div class="col-1 w-50 text-center">
                    <a class="<?php if($activeDebt=='borrow'){echo 'activeDebt';} ?>"  href="./borrow.php">Borrow</a>
                  </div>
                  <div class="col-1 w-50 text-center">
                    <a class="<?php if($activeDebt=='lent'){echo 'activeDebt';} ?>" href="./lent.php">Lent</a>
                  </div>
              </div>
          </div>


     <!-- ionicons link -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- js file -->
    <script src="../index.js"></script>
    <!-- bootstrap js -->
    <script src="../bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>

  </body>
</html>
