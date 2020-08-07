<?php
require('header.php');
$total = 0;
?>

<!-- Display cart items -->
<div class="container">
    <?php
    if (!isset($_SESSION["cart"]) || count($_SESSION["cart"]) == 0) :
        echo "<h3 style='text-align:center; margin-top: 50px;'>Your Cart is empty</h3>";
    else :
    ?>
    <div class="order-detail">
        <h3>Order Details</h3>
        <table class="cart-details">
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php if (!empty($_SESSION["cart"])) : ?>
            <?php foreach ($_SESSION["cart"] as $key => $value) : ?>
            <tr>
                <td><?php echo $value["name"]; ?></td>
                <td><?php echo number_format($value["price"], 2); ?></td>
                <td><?php echo $value["quantity"]; ?></td>
                <td><?php echo number_format($value["quantity"] * $value["price"], 2); ?></td>
                <td><a href="index.php?action=remove&id=<?php echo $value["id"]; ?>"
                        class="btn remove-button">Remove</a>
                </td>
            </tr>
            <?php $total = $total + ($value["quantity"] * $value["price"]); ?>
            <?php endforeach; ?>
            <tr>
                <td></td>
                <td></td>
                <td>Total</td>
                <td><?php echo number_format($total, 2); ?></td>
                <td></td>
            </tr>
            <?php endif; ?>
        </table>
    </div>
    <?php endif; ?>
</div>