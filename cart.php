<?php
session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}


if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

   
    $cart_item = array(
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => 1
    );

   
    if (array_key_exists($product_id, $_SESSION['cart'])) {
      
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
      
        $_SESSION['cart'][$product_id] = $cart_item;
    }
}

if (isset($_GET['remove_from_cart'])) {
    $product_id = $_GET['remove_from_cart'];
    if (array_key_exists($product_id, $_SESSION['cart'])) {
        unset($_SESSION['cart'][$product_id]);
    }
}


if (isset($_GET['clear_cart'])) {
    $_SESSION['cart'] = array();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Shopping Cart</h1>


    <ul>
        <li>
            Product 1 - $10
            <form action="cart.php" method="post">
                <input type="hidden" name="product_id" value="1">
                <input type="hidden" name="product_name" value="Product 1">
                <input type="hidden" name="product_price" value="10">
                <input type="submit" name="add_to_cart" value="Add to Cart">
            </form>
        </li>
        <li>
            Product 2 - $20
            <form action="cart.php" method="post">
                <input type="hidden" name="product_id" value="2">
                <input type="hidden" name="product_name" value="Product 2">
                <input type="hidden" name="product_price" value="20">
                <input type="submit" name="add_to_cart" value="Add to Cart">
            </form>
        </li>
    </ul>

 
    <h2>Cart Contents</h2>
    <table>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
        <?php
        $total_price = 0;
        foreach ($_SESSION['cart'] as $product_id => $item) :
            $total_item_price = $item['price'] * $item['quantity'];
            $total_price += $total_item_price;
        ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td>$<?php echo number_format($item['price'], 2); ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td>$<?php echo number_format($total_item_price, 2); ?></td>
                <td>
                    <a href="cart.php?remove_from_cart=<?php echo $product_id; ?>">Remove</a>
                    
                    <a href="cart.php?edit_cart=<?php echo $product_id; ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3">Total</td>
            <td>$<?php echo number_format($total_price, 2); ?></td>
            <td><a href="cart.php?clear_cart=1">Clear Cart</a></td>
        </tr>
    </table>
</body>
</html>
