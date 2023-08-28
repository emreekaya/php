<?php
include("connection.php");

$productName = $productPrice = $productQuantity = $productDescription = "";
$productName_error = $productPrice_error = $productQuantity_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get form data
    $productName = $_POST["productName"];
    $productPrice = $_POST["productPrice"];
    $productQuantity = $_POST["productQuantity"];
    $productDescription = $_POST["productDescription"];

    // Form verification
    if (empty($productName)) {
        $productName_error = "Product name can not be blank";
    }

    if (empty($productPrice)) {
        $productPrice_error = "Price can not be blank.";
    }

    if (empty($productQuantity)) {
        $productQuantity_error = "Quantity can not be blank.";
    }

    if (empty($productName_error) && empty($productPrice_error) && empty($productQuantity_error)) {
        // upload image
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
        move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file);

        // Add product to database
        $add_product_query = "INSERT INTO products (productName, productPrice, productQuantity, productDescription, productImage) VALUES ('$productName', '$productPrice', '$productQuantity', '$productDescription', '$target_file')";

        if (mysqli_query($connection, $add_product_query)) {
            echo "product added successfully.";
        } else {
            echo "An error occurred while adding the product: " . mysqli_error($connection);
        }

        mysqli_close($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Ekle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        h2 {
            margin-bottom: 20px;
        }
        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 80%;
            padding: 10px;
            
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        span.error {
            color: red;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ürün Ekle</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
            <label for="productName">Product Name:</label>
            <input type="text" name="productName" required>
            <span class="error"><?php echo $productName_error; ?></span>

            <label for="productPrice">Price (TL):</label>
            <input type="number" name="productPrice" required>
            <span class="error"><?php echo $productPrice_error; ?></span>

            <label for="productQuantity">Quantity:</label>
            <input type="number" name="productQuantity" required>
            <span class="error"><?php echo $productQuantity_error; ?></span>

            <label for="productDescription">Description:</label>
            <textarea name="productDescription" rows="4" cols="50"></textarea>

            <label for="productImage">Upload Image:</label>
            <input type="file" name="productImage" accept="image/*">

            <input type="submit" value="Add Product">
        </form>
    </div>
</body>
</html>
