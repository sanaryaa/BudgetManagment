<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css" />
    <script src="./bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css" />
    <title>Sign Up</title>
</head>

<body>

 <div class="pageSection w-100  d-flex align-items-center justify-content-center flex-row">
   <h4 class="w-50 text-center"><a href="./signUp.php" class="text-decoration-none <?php if($activeSign=='signup'){echo 'activeSign';} ?> ">Sign Up</a></h4>
   <h4 class="w-50 text-center"><a href="./signIn.php" class="text-decoration-none <?php if($activeSign=='signin'){echo 'activeSign';} ?>">Sign In</a></h4>
 </div>

</body>

</html>