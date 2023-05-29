<?php
include './includes/connect.php';
session_start();
// checking whether a user is logged in or not. If the user is not logged in, it redirects them to the sign-in page.
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
    <link rel="stylesheet" href="./bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css" />
    <script src="./bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Budget Management</title>
</head>

<body class="d-flex flex-column flex-lg-row ">
    <!-- style home page to atcive at navigaion -->
    <?php $activeNav = 'home';
    include './includes/nav.php'; ?>
    <section class="body-content mt-3">
        <div class="header-content d-flex align-items-center justify-content-between ">

            <h5>Hi,<?php echo $_SESSION["first_name"]; ?></h5>


            <?php
            // If the form has been submitted, the value of the myDate input field is stored in a session variable $_SESSION['myDate']. This will be used to remember the date that the user selected.
            if (isset($_POST["myDate"])) {
                $_SESSION['myDate'] = $_POST['myDate'];
            }
            ?>
            <form id="myForm" method="post" action="home.php">

                <?php
$firefox = strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false;
if ($firefox) {
    // For Firefox browser
    echo ' <input type="date" id="myDate" name="myDate" value="' . $_SESSION["myDate"] . '">';
} else {
    // For other browsers
    echo ' <input type="date" id="myDate" name="myDate" value="' . $_SESSION["myDate"] . '">';
}
?>

            </form>
            <script>
                document.getElementById("myDate").addEventListener("change", function() {
                    document.getElementById("myForm").submit();
                });
            </script>


        </div>



        <div class="welcome-content d-flex  flex-column flex-md-row align-items-center  align-items-md-start justify-content-between">
            <div class="left-sec d-flex align-items-center justify-content-between">
                <h6>Manage your money!</h6>
                <img src="./Image/Savings-pana.png" alt="saveMoneyImage">
            </div>
            <div class="right-sec d-flex flex-column align-items-center justify-content-around text-center">
                <h5 class="fs-4">Your total expenses</h5>
                <?php
                // extract the year and month from the selected date stored in the $_SESSION['myDate'] variable.
                $_SESSION['year'] = date("Y", strtotime($_SESSION['myDate']));;
                $_SESSION['month'] = date('m', strtotime($_SESSION['myDate']));

                $sql = "SELECT SUM(price) AS total_price FROM (
                      SELECT price FROM food_items WHERE user_id = {$_SESSION['user_id']} and month(date) = {$_SESSION['month']} and year(date)={$_SESSION['year']}
                         UNION ALL
                         SELECT price FROM shopping_items WHERE user_id = {$_SESSION['user_id']} and month(date) = {$_SESSION['month']} and year(date)={$_SESSION['year']}
                         UNION ALL
                         SELECT price FROM health_items WHERE user_id = {$_SESSION['user_id']} and month(date) = {$_SESSION['month']} and year(date)={$_SESSION['year']}
                         UNION ALL
                         SELECT price FROM other_items WHERE user_id = {$_SESSION['user_id']} and month(date) = {$_SESSION['month']} and year(date)={$_SESSION['year']}
                         ) t";
                $result = mysqli_query($con, $sql);
                $totalExp = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $totalExp += $row['total_price'];
                }
                echo " <h3 class='fs-1'>" . $totalExp . "$</h3>";
                ?>

                <p class="fs-6"><?php echo $_SESSION['myDate']; ?></p>
            </div>
        </div>
        <div class="container pages-data d-flex flex-column flex-lg-row align-items-center justify-content-between ">
            <div class="field-debt d-flex flex-column align-items-center justify-content-between">
                <div class="field-container d-flex flex-column align-items-center justify-content-center ">
                    <div class="fields d-flex flex-column flex-sm-row  align-items-center justify-content-around">
                        <div class=" box food">
                            <?php
                            $query = "SELECT SUM(price) as total_food FROM food_items WHERE user_id = {$_SESSION['user_id']} and  month(date)={$_SESSION['month']} and year(date)={$_SESSION['year']}";
                            $result = mysqli_query($con, $query);
                            $row = mysqli_fetch_assoc($result);
                            $total_food = $row['total_food'];
                            ?>
                            <a href="./food.php">
                                <div class=" content">
                                    <h3 class="fs-4">Food</h3>
                                    <p class="fs-6"><span>Total:</span>
                                        <?php
                                        if ($total_food > 0) {
                                            echo $total_food;
                                        } else {
                                            $total_food = 0;
                                            echo $total_food;
                                        }
                                        ?>$</p>
                                </div>
                            </a>
                        </div>
                        <div class="box health">
                            <?php
                            $query = "SELECT SUM(price) as total_health FROM health_items WHERE user_id = {$_SESSION['user_id']} and month(date)={$_SESSION['month']} and year(date)={$_SESSION['year']}";
                            $result = mysqli_query($con, $query);
                            $row = mysqli_fetch_assoc($result);
                            $total_health = $row['total_health'];
                            ?>
                            <a href="./health.php">
                                <div class="content">
                                    <h3 class="fs-4">Health</h3>
                                    <p class="fs-6"><span>Total: </span>
                                        <?php
                                        if ($total_health > 0) {
                                            echo $total_health;
                                        } else {
                                            $total_health = 0;
                                            echo $total_health;
                                        }
                                        ?>$
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="box shopping">
                            <?php
                            $query = "SELECT SUM(price) as total_shopping FROM shopping_items WHERE user_id = {$_SESSION['user_id']} and month(date)={$_SESSION['month']} and year(date)={$_SESSION['year']}";
                            $result = mysqli_query($con, $query);
                            $row = mysqli_fetch_assoc($result);
                            $total_shopping = $row['total_shopping'];
                            ?>
                            <a href="./shopping.php">
                                <div class=" content">
                                    <h3 class="fs-4">shopping</h3>
                                    <p class="fs-6"><span>Total:</span>
                                        <?php
                                        if ($total_shopping > 0) {
                                            echo $total_shopping;
                                        } else {
                                            $total_shopping = 0;
                                            echo $total_shopping;
                                        }
                                        ?>$</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                    $query = "SELECT SUM(price) as total_others FROM other_items WHERE user_id = {$_SESSION['user_id']} and month(date)={$_SESSION['month']} and year(date)={$_SESSION['year']}";
                    $result = mysqli_query($con, $query);
                    $row = mysqli_fetch_assoc($result);
                    $total_others = $row['total_others'];
                    if (!($total_shopping > 0)) {
                        $total_shopping = 0;
                    }
                    ?>
                    <a href="./others.php">more>></a>
                </div>

                <div class="debt d-flex flex-column flex-sm-row align-items-center justify-content-around">
                    <?php
                    $query = "SELECT SUM(amount) as total_lent FROM lent_items WHERE user_id = {$_SESSION['user_id']} and month(date)={$_SESSION['month']} and year(date)={$_SESSION['year']}";
                    $result = mysqli_query($con, $query);
                    $row = mysqli_fetch_assoc($result);
                    $total_lent = $row['total_lent'];
                    ?>
                    <a href="./lent.php" style="color:#3f5a9f;">
                        <div class="lent box d-flex align-items-center justify-content-center ">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <img src="./Image/money.png" alt="lent" width="45px">
                            </div>
                            <div class="detail">
                                <p>Lent</p>
                                <p class="fs-3 fw-bold">
                                    <?php
                                    if ($total_lent > 0) {
                                        echo $total_lent;
                                    } else {
                                        $total_lent = 0;
                                        echo $total_lent;
                                    }
                                    ?>$</p>
                            </div>
                        </div>
                    </a>
                    <?php
                    $query = "SELECT SUM(amount) as total_borrow FROM borrow_items WHERE user_id = {$_SESSION['user_id']} and month(date)={$_SESSION['month']} and year(date)={$_SESSION['year']}";
                    $result = mysqli_query($con, $query);
                    $row = mysqli_fetch_assoc($result);
                    $total_borrow = $row['total_borrow'];
                    ?>
                    <a href="./borrow.php" style="color:#3f5a9f;">
                        <div class="borrow box  d-flex align-items-center justify-content-center ">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <img src="./Image/money.png" alt="lent" width="45px">
                            </div>
                            <div class="detail">
                                <p>Borrow</p>
                                <p class="fs-3 fw-bold">
                                    <?php
                                    if ($total_borrow > 0) {
                                        echo $total_borrow;
                                    } else {
                                        $total_borrow = 0;
                                        echo $total_borrow;
                                    }
                                    ?>$</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="chart d-flex align-items-center justify-content-center">
                <?php
                // Your dynamic data array
                if ($total_food == 0 and $total_shopping == 0 and $total_health == 0 and $total_others == 0) {
                    $empty = 1;
                } else {
                    $empty = 0;
                }
                $dataVal = [$empty, $total_food, $total_shopping, $total_health, $total_others];
                // Generate the Chart.js configuration options in PHP
                $options = [
                    "type" => 'doughnut',
                    'data' => [
                        'labels' => ['Empty', 'Food', 'shopping', 'Health', 'others'],
                        'datasets' => [
                            [
                                'data' => $dataVal,
                                'backgroundColor' => [
                                    '#eceef9',
                                    '#FCE1CA',
                                    '#EAD1EE',
                                    '#DEF7E5',
                                    '#FFF5DE'
                                ],
                                'borderColor' => [
                                    '#eceef9',
                                    '#FCE1CA',
                                    '#EAD1EE',
                                    '#DEF7E5',
                                    '#FFF5DE'
                                ],

                            ]
                        ]
                    ],
                    'options' => [
                        'responsive' => 'false',
                        'plugins' => [
                            'legend' => [
                                'display' => 'true',
                                'position' => 'bottom',
                                'labels' => [
                                    'usePointStyle' => 'true'
                                ],
                                'padding' => [
                                    'top' => 15,
                                ]
                            ]
                        ]
                    ]

                ];

                // Convert the PHP options array to a JSON string
                $options_json = json_encode($options);
                ?>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </section>




    <!-- chart js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./jquery-3.6.0.min.js"></script>
    <!-- <script src="index.js"></script> -->
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var options = <?php echo $options_json; ?>; // Pass the options from PHP to JavaScript
        var myChart = new Chart(ctx, options);
    </script>

</body>

</html>