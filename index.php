<?php
session_start();

//connect database
    include("connection.php");

    $usernameErr = $passwordErr = $lastname = "";
    if(isset($_POST['login'])){
        function validate( $formdata){
            $formdata = trim(stripslashes( htmlspecialchars ($formdata)));
            return $formdata;
        }

        if(!$_POST["username"]){
            $usernameErr = "field required";
        } else{
                $username = validate ($_POST["username"]);
            }

        if(!$_POST['password']){
            $passwordErr = "field required";
        }else{
            $password = validate( $_POST["password"]);
        }

        //query database
        $query = "SELECT username, password, firstname, lastname, email FROM account WHERE username ='$username'";

        //get result row value from database if query was successful
        $result = mysqli_query( $conn, $query);

        if(mysqli_num_rows( $result) > 0){
            //fetch row
            while( $rows = mysqli_fetch_assoc($result)){
                //store data
                $user = $rows["username"];
                $firstname = $rows["firstname"];
                $lastname = $rows["lastname"];
                $email = $rows["email"];
                $hashedpassword = $rows["password"];

            }

            

            //verify password
            if(password_verify($password, $hashedpassword)){

                //create session
                session_start();

                $_SESSION["lastname"] = $lastname;
                $_SESSION["firstname"] = $firstname;
                $_SESSION["email"] = $email;

                header("Location: profile.php");
            }else{
                $passwordErr = "incorrect password";
            }

        }
        else{
            echo "<div class='alert alert-danger'>You don't have an account, please register<a href=''
                    class='close' data-dismiss='alert'>&times;</a></div>";
        }
    }

    mysqli_close($conn);


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginPage</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
    <div class="container">
        <h3 style="font-weight: bold;"> Login Page</h3>
        <p class="lead" >Enter your login details</p>
        <div class="row">
            <div class="col-sm-4 col-xs-6">
                <form action="" method="POST">
                    <small class="text-danger"><?php echo $usernameErr; ?></small>
                    <input type="text" class="form-control" name="username" placeholder="username"><br>

                    <small class="text-danger"><?php echo $passwordErr; ?></small>
                    <input type="password" class="form-control" name="password" placeholder="password"><br>

                    <input type="submit" value="LogIn" name="login" class="btn btn-primary btn-md">

                    <a href="register.php" class="btn btn-danger">Register</a>

                </form>
            </div>
        </div>
    </div>


<script src="js/bootstrap.min.js"></script>
</body>
</html>