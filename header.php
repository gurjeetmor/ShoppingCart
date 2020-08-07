<?php
session_start();
error_reporting(E_STRICT);
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Simple Cart App</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header">
        <div class="logo"><a href="index.php">Shopping Cart</a></div>
        <div class="cart">
            <a href="cart.php">
                <img src="img/cart-icon.svg" />
                <?php
                if (isset($_SESSION["cart"])) :
                    foreach ($_SESSION["cart"] as $key => $value) :
                        $total += $value["quantity"];
                    endforeach;
                endif;
                echo "<span class='badge'> $total</span>";
                ?>
            </a>
        </div>
    </div>
</body>

</html>