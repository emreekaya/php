<?php
session_start();
if (isset($_SESSION["user_name"])) {
    include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        .card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            width: 300px;
            display: inline-block;
            cursor: pointer; /* Kartı tıklanabilir yapmak için cursor özelliğini ekledik */
        }
    </style>
</head>
<body>
    <h3><?php echo $_SESSION["user_name"]; ?> WELCOME</h3>
    <div>
        <?php
        $select = "SELECT * FROM products ORDER BY Id";
        $sonuc = $connection->query($select);

        if ($sonuc->num_rows > 0) {
            while ($pull = $sonuc->fetch_assoc()) {
                $id = $pull["Id"];
                $ad = $pull["productName"];
        ?>
        <!-- Kartları tıklanabilir bağlantılara dönüştürdük -->
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
    <a href="exit.php" style="color: red; background-color: yellow;
    border: 1px solid red; padding: 5px 5px;">EXIT</a>
</body>
</html>
<?php
} else {
    echo "You are not authorized to view this page!";
}
?>
