<?php

session_start();
if (isset($_SESSION["user_name"]))
{
    echo "<h3>".$_SESSION["user_name"]." WELCOME </h3>";


    include("connection.php");

    $select= "SELECT * FROM products ORDER BY Id";

    $sonuc= $connection->query($select);

    if ($sonuc->num_rows > 0) 
    {
    // verileri listeleyebiliriz
        while($pull = $sonuc->fetch_assoc()) 
        {
            $id=$pull["Id"];
            $ad=$pull["productName"];

            echo $id."-".$ad."<br>";

        }
    } 
    else 
    {
    echo "Sonuç Bulunamadı.";
    }
    echo "<a href='exit.php' style='color:red; background-color:yellow;
    border:1px solid red; padding:5px 5px;'>EXIT </a>";
}
else
{
    echo "You are not authorized to view this page!";
}




?>