<?php
include("connection.php");

$categoryName = "";
$categoryName_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get form data
    $categoryName = $_POST["categoryName"];

    // form validation
    if (empty($categoryName)) {
        $categoryName_error = "Category name cannot be blank";
    } else {
        // check the category name in the database without case sensitivity
        $categoryName = mysqli_real_escape_string($connection, $categoryName); // SQL enjeksiyonlarına karşı koruma
        $check_query = "SELECT 1 FROM categories WHERE LOWER(category_name) = LOWER('$categoryName')";
        $result = mysqli_query($connection, $check_query);

        if (mysqli_num_rows($result) > 0) {
            $categoryName_error = "Category name already exists.";
        }
    }

    if (empty($categoryName_error)) {
        // add the new category to the database
        $add_category_query = "INSERT INTO categories (category_name) VALUES ('$categoryName')";

        if (mysqli_query($connection, $add_category_query)) {
            echo "Category added successfully.";
        } else {
            echo "An error occurred while adding the category: " . mysqli_error($connection);
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
    <title>Add Category</title>
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
        textarea,
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
        <h2>Add Category</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
            <label for="categoryName">Category Name:</label>
            <input type="text" name="categoryName" required>
            <span class="error"><?php echo $categoryName_error; ?></span>

            <button type="submit"> Add Category </button>
            <button type="button" onclick="window.location.href='add_product.php'">Add Product</button>

        </form>
    </div>
</body>
</html>
