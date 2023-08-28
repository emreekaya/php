<?php
if (isset($_GET['id'])) {           // i get product id from previous page
    $product_id = $_GET['id'];

    include("connection.php");

    $select = "SELECT * FROM products WHERE Id = $product_id";    // i select the product from the database
    $sonuc = $connection->query($select);

    if ($sonuc->num_rows > 0) {

        $product = $sonuc->fetch_assoc();                         // i am pulling product information
        $productName = $product["productName"];
        $productPrice = $product["productPrice"];
        $productQuantity = $product["productQuantity"];
    } else {
        echo "Product not found.";
    }

    $connection->close();
} else {
    echo "Product ID not specified.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
</head>
<body>
    <?php if (isset($productName)): ?>
        <h2>Product Details</h2>
        <p>Product Name: <?php echo $productName; ?></p>
        <p>Price: <?php echo $productPrice; ?></p>
        <p>Quantity: <?php echo $productQuantity; ?></p>
    <?php else: ?>
        <p>Product details not found.</p>
    <?php endif; ?>
</body>
</html>
