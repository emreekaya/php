<?php

include("connection.php");

$username_error="";
$email_error="";
$password_error=$passwordre_error="";
if (isset($_POST["submit"])) {
    $userName = "";
    $eMail = "";
    $password = "";

    //username verification

        if (empty($_POST["username"]))
        {
            $username_error="Username cannot be blank";
        }
        elseif (strlen($_POST["username"])<4)
        {
            $username_error="Username must be at least 4 characters";
        }
        else if (!preg_match('/^[a-z\d_]{5,20}$/i', $_POST["username"])) //username format
        {
            $username_error="Username must consist of upper and lower case letters and numbers.";
        }
        else
        {
            $userName=$_POST["username"];

        }
        
    //Email verification

        if (empty($_POST["email"]))
        {
            $email_error="Email cannot be blank";
        }
        else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) //Email format
        {
            $email_error = "Invalid email format";
        }
            else 
            {
                $eMail=$_POST["email"];
            }

    //Password verification
        if (empty($_POST["password"]))
        {
            $password_error="Password cannot be blank";
        }
        else
        {
            $password=password_hash($_POST["password"],PASSWORD_DEFAULT);
        }

    //Re-enter password verification
        if (empty($_POST["passwordre"]))
        {
            $passwordre_error="Re-Enter password cannot be blank";
        }
        else if ($_POST["password"]!=$_POST["passwordre"])
        {
            $password_error="Passwords does not match";
        }

        else
        {
            $passwordre=$_POST["passwordre"];
        }



        if(isset($userName) && ($eMail) && ($password))
        {
            $add="INSERT INTO users (user_name,emaill,passwordd) VALUES ('$userName','$eMail','$password')";
            $run_add= mysqli_query($connection,$add);

            if ($run_add) {
                echo '<div class="alert alert-success" role="alert">
                    Registration was successful!
                    </div>';
            }
            else {
                echo '<div class="alert alert-danger" role="alert">
                    There was a problem adding the registration!
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
    <title>MEMBER REGISTRATION PROCESS</title>

  </head>
  <body>
    <div class="container col-md-4 p-5">
        <div class="card p-5">

                <form action="registration.php" method="POST">
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
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="text" class="form-control 
            <?php
            if(!empty($email_error))
            {
                echo "is-invalid";
            }
            ?>
            
            " id="exampleInputEmail1" name="email">
            <div id="validationServer03Feedback" class="invalid-feedback">
            <?php
            echo $email_error;
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

            <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Re-Enter Password</label>
            <input type="password" class="form-control 
            <?php
            if(!empty($passwordre_error))
            {
                echo "is-invalid";
            }
            ?>
            
            " id="exampleInputPassword1" name="passwordre">
            <div id="validationServer03Feedback" class="invalid-feedback">
            <?php
            echo $passwordre_error;
            ?>
            </div>

        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>

        <a href="login.php" class="btn btn-primary">Sign In</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>