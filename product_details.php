<?php
if (isset($_GET['id'])) {                                        //get product id from previous page
    $product_id = $_GET['id'];

    include("connection.php");

    $select = "SELECT * FROM products WHERE Id = $product_id";  // select the product from the database
    $sonuc = $connection->query($select);

    if ($sonuc->num_rows > 0) {

        $product = $sonuc->fetch_assoc();
        $productName = $product["productName"];                 // pulling product information
        $productPrice = $product["productPrice"];
        $productQuantity = $product["productQuantity"];
        $productDescription = $product["productDescription"];
        $productImage = $product["productImage"];
    } else {
        echo "Product not found.";
    }

    $connection->close();
} else {
    echo "Product Id not specified.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Detayları</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if (isset($productName)): ?>
        <div class="card">
            <h2>Product Details</h2>
            <img style="max-width: 300px;" src="<?php echo $productImage; ?>" alt="Ürün Resmi">
            <p>Product Name: <?php echo $productName; ?></p>
            <p>Price: <?php echo $productPrice; ?></p>
            <p>Quantity: <?php echo $productQuantity; ?></p>
            <p>Product Description: <?php echo $productDescription; ?></p>
        </div>
    <?php else: ?>
        <p>Product details not found.</p>
    <?php endif; ?>
</body>
</html>
