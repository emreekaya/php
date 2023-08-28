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
        $productDescription = $product["productDescription"];
        $productImage = $product["productImage"];
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 300px;
            width: 100%;
            text-align: center;
        }
        h2 {
            margin-top: 0;
        }
        p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <?php if (isset($productName)): ?>
        <div class="card">
            <h2>Product Details</h2>
            <img style="max-width: 300px;" src="<?php echo $productImage; ?>" alt="Product Image">
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
