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
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .card {
            border: 1px solid #ccc;
            padding: 10px;
            width: 300px;
            cursor: pointer;
            text-decoration: none;
            color: black;
            background-color: white;
            transition: background-color 0.3s ease;
        }
        .card:hover {
            background-color: #f0f0f0;
        }
        .exit-link {
            color: red;
            background-color: yellow;
            border: 1px solid red;
            padding: 5px 10px;
            text-decoration: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h3>Welcome, <?php echo $_SESSION["user_name"]; ?>!</h3>
    <div class="container">
        <?php
        $select = "SELECT * FROM products ORDER BY Id";
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
