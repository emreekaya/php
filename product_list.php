<?php
session_start();
if (isset($_GET['id'])) {                                        // get category id from previous page
    $cat_id = $_GET['id'];

    include("connection.php");

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
        $select = "SELECT * FROM products WHERE category_id = $cat_id";   // select the category from the database
        $sonuc = $connection->query($select);

        if ($sonuc->num_rows > 0) {
            while ($pull = $sonuc->fetch_assoc()) {
                $id = $pull["Id"];
                $ad = $pull["productName"];
        ?>
        
        <a href="product_details.php?id=<?php echo $id; ?>" class="card">
            <h2><?php echo $ad; ?></h2>
            <p>ID: <?php echo $id; ?></p>
        </a>
        <?php
            }
        } else {
            echo "There were no results.";
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
