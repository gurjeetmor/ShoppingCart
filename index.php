<?php
require('header.php');
$add_items = array();

$products = [
    ["name" => "Sledgehammer", "price" => 125.75],
    ["name" => "Axe", "price" => 190.50],
    ["name" => "Bandsaw", "price" => 562.131],
    ["name" => "Chisel", "price" => 12.9],
    ["name" => "Hacksaw", "price" => 18.45],
];

//Add item to cart
if (isset($_GET["action"]) && $_GET["action"] == "add") {
    //Check session cart is set, then add item at the end of $_SESSION["cart"] array. 
    //Else create $_SESSION["cart"] array varaiable and add the item
    if (isset($_SESSION["cart"])) {
        $cart_item_ids = array_column($_SESSION["cart"], "id");
        //Check if item is already in cart. If not then add the new one, else update the existing item quantity
        if (!in_array($_GET["id"], $cart_item_ids)) {
            $count = count($_SESSION["cart"]);
            $add_items = array(
                "id" => $_GET["id"],
                "name" => $_POST["name"],
                "price" => $_POST["price"],
                "quantity" => $_POST["quantity"]
            );
            //Add item detail to session variable
            $_SESSION["cart"][$count] = $add_items;
        } else {
            //Get key of already added item and update the quantity
            $key = array_search($_GET["id"], $cart_item_ids);
            $_SESSION["cart"][$key]["quantity"] += 1;
        }
    } else {
        $add_items = array(
            "id" => $_GET["id"],
            "name" => $_POST["name"],
            "price" => $_POST["price"],
            "quantity" => $_POST["quantity"]
        );
        $_SESSION["cart"][0] = $add_items;
    }
    echo "<script>window.location='index.php'</script>";
}

//Remove item from cart
if (isset($_GET["action"]) && $_GET["action"] == "remove") {
    foreach ($_SESSION["cart"] as $key => $value) {
        if ($value["id"] == $_GET["id"]) {
            unset($_SESSION["cart"][$key]);
            echo "<script>window.location='cart.php'</script>";
        }
    }
}
?>

<!-- Display prodducts -->
<div class="container">
    <div class="product-grid">
        <?php foreach ($products as $key => $value) : ?>
        <div class="product-detail">
            <img class="product-image" src="img/product.png" />
            <div class="product-name"><?php echo $value["name"]; ?></div>
            <p>$<?php echo $value["price"]; ?></p>
            <form method="post" action="?action=add&id=<?php echo ++$key; ?>">
                <input type="hidden" name="quantity" value="1" />
                <input type="hidden" name="price" value="<?php echo $value["price"]; ?>" />
                <input type="hidden" name="name" value="<?php echo $value["name"]; ?>" />
                <input type="submit" name="add_to_cart" class="btn add-button" value="Add to Cart" />
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</div>