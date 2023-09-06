<?php
session_start();
if (isset($_GET['id'])) { 
    $cat_id = $_GET['id'];
    include("connection.php");
    
    $page = isset($_GET['page']) ? $_GET['page'] : 1;   // getting page number (default is 1)
   
    $itemsPerPage = 10;              // how many products will be displayed on each page

    $select = "SELECT COUNT(*) as total FROM products WHERE category_id = $cat_id"; // getting total products number
    $result = $connection->query($select);
    $row = $result->fetch_assoc();
    $totalItems = $row['total'];

    $totalPages = ceil($totalItems / $itemsPerPage);   // Calculating the total number of pages

    // getting the data of the page
    $offset = ($page - 1) * $itemsPerPage;
    $select = "SELECT * FROM products WHERE category_id = $cat_id LIMIT $itemsPerPage OFFSET $offset";
    $sonuc = $connection->query($select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Welcome, <?php echo $_SESSION["user_name"]; ?>!</h3>
    <div class="container">

        <?php
        if ($sonuc->num_rows > 0) {
            while ($pull = $sonuc->fetch_assoc()) {
                $id = $pull["Id"];
                $ad = $pull["productName"];
                echo "<a href='product_details.php?id=$id' class='card'>";
                echo "<h2>$ad</h2>";
                echo "<p>ID: $id</p>";
                echo "</a>";
            }
        } else {
            echo "There were no results.";
        }
        ?>

        <!-- pagination links -->
        <?php
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='product_list.php?id=$cat_id&page=$i'>$i</a>";
        }
        ?>
    </div>
    <a href="exit.php" class="exit-link">EXIT</a>
</body>
</html>

<?php
} else {
    echo "You are not authorized to view this page!";
}
?>
