<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="style.css">
  <title>navigation</title>
</head>
<body class="d-flex flex-column flex-lg-row">
  <section class="content fixed-top">
    <nav
      class="navbar navbar-expand-lg bg-body-tertiary w-100 h-100 d-flex align-items-center justify-content-center flex-row flex-lg-column">
      <div class="container-fluid w-100  d-flex align-items-start justify-content-between align-items-lg-center justify-content-lg-center flex-row flex-lg-column">
        <a class="navbar-brand mt-3" href="#"><img src="./Image/wallet.png" alt="logo" width="50" /></a>
        <button class="navbar-toggler mt-4 mt-lg-0 " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent" >
          <ul class="navbar-nav  mb-2 mb-lg-0  w-100  d-flex align-items-center justify-content-center flex-column" >
          <li class="nav-item mt-0 mt-lg-5">
              <a class="nav-link <?php if($activeNav=='home'){echo 'activeNav';} ?>" href="./home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($activeNav=='expenses'){echo 'activeNav';} ?>"  href="./food.php">Expenses</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link <?php if($activeNav=='debt'){echo 'activeNav';} ?>" href="./borrow.php">Debt</a>
            </li>
            <li class="nav-item pro-page <?php if($activeNav=='profile'){echo 'activeNav';} ?>">
              <a class="nav-link pro-icon " href="./profile.php"><i class="fa-solid fa-user"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </section>
  <script src="../bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
</body>

</html>