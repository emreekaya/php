<?php

include("connection.php");

$username_error=$userName="";
$eMail="";
$password_error=$password="";
if(isset($_POST["login"]))
{
//username verification

    if (empty($_POST["username"]))
    {
        $username_error="Username cannot be blank";
    }
    else
    {
        $userName=$_POST["username"];
    }

//Password verification
    if (empty($_POST["password"]))
    {
        $password_error="Password cannot be blank";
    }
    else
    {
        $password=$_POST["password"];
    }



    if(isset($userName) && ($password))
    {
        
        $selection= "SELECT * FROM users WHERE user_name='$userName' ";
        $run=mysqli_query($connection,$selection);
        $number_of_registers=mysqli_num_rows($run); // 0 or 1 

        if ($number_of_registers>0)
        {
           $logged_user=mysqli_fetch_assoc($run);
           $hidden_password=$logged_user["passwordd"];

           if (password_verify($password,$hidden_password))
           {
                session_start();
                $_SESSION["user_name"]=$logged_user["user_name"];
                $_SESSION["password"]=$logged_user["passwordd"];
                
                // I check the user role.
                if ($logged_user["roles"] == "user") {

                    header("location:add_product.php");
                } 
                elseif ($logged_user["roles"] == "member") {
                    header("location:profile.php");
                } 
                else {

                }
           }
           else
           {
            echo '<div class="alert alert-danger" role="alert">
            Password is wrong!
            </div>';
           }
        }
        else
        {
            echo '<div class="alert alert-danger" role="alert">
                  Username is wrong!
                  </div>';
        }

        mysqli_close($connection);

    }

}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>MEMBER LOGİN PROCESS</title>

  </head>
  <body>
    <div class="container p-5">
        <div class="card p-5">

                <form action="login.php" method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">User Name</label>
            <input type="text" class="form-control 
            <?php
            if(!empty($username_error))
            {
                echo "is-invalid";
            }
            ?>
            
            " id="exampleInputEmail1" name="username">
            <div id="validationServer03Feedback" class="invalid-feedback">
            <?php
            echo $username_error;
            ?>
            </div>
        </div>


        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control 
            <?php
            if(!empty($password_error))
            {
                echo "is-invalid";
            }
            ?>
            
            " id="exampleInputPassword1" name="password">
            <div id="validationServer03Feedback" class="invalid-feedback">
            <?php
            echo $password_error;
            ?>
            </div>
        </div>

        <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>