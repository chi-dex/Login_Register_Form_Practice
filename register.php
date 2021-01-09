<?php

    include("connection.php");

    $firstnameErr = $lastnameErr = $usernameErr = $emailErr = $passwordErr = "";
    $firstname = $lastname = $email = $username = $password = "";
    if(isset($_POST["signup"])){
        function validate( $formdata){
            $formdata = trim(stripslashes( htmlspecialchars ($formdata)));
            return $formdata;
        }

        if(!$_POST["firstname"]){
            $firstnameErr = "field required";
        } else{
                $firstname = validate ($_POST["firstname"]);
            }

        if(!$_POST['lastname']){
            $lastnameErr = "field required";
        }else{
            $lastname = validate( $_POST["lastname"]);
        }

        if(!$_POST['username']){
            $usernameErr = "field required";
        }else{
            $username = validate( $_POST["username"]);
        }

        if(!$_POST['email']){
            $emailErr = "field required";
        }else{
            $email = validate( $_POST["email"]);
        }

        if(!$_POST['password']){
            $passwordErr = "field required";
        }else{
            $password = validate( $_POST["password"]);
            $password = password_hash( $password, PASSWORD_DEFAULT);
        }

        if(!empty( $firstname && $lastname && $username && $password && $email)){
            //query data base
            $query = "INSERT INTO account (id, firstname, lastname, username, email, password, signup_date)
            VALUES (NULL, '$firstname', '$lastname','$username', '$email','$password',CURRENT_TIMESTAMP)";
            
            //get result if $query was successful
            $result = mysqli_query($conn, $query);
            
            if($result){
            echo "<div class='alert alert-success'>Account has been registered<a href='' class='close'
            data-dismiss='alert'>&times;</a></div>";
            }else{
                 echo "<div class='alert alert-danger'>Check account details</div>";
                // echo "error: ".$query. " ".mysqli_error($conn);
            }
        }else{
            echo "<div class='alert alert-danger'>Check account details</div>";
        }
        
        
    }
    mysqli_close($conn);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
    <div class="container">
        <h3 style="font-weight: bold;"> SignUp Page</h3>
        <p class="lead" >Enter your details</p>
        <div class="row">
            <div class="col-sm-4 col-xs-6">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <small class="text-danger"><?php echo $firstnameErr; ?></small>
                    <input value="<?php echo $firstname; ?>" type="text" class="form-control" name="firstname" placeholder="firstname"><br>

                    <small class="text-danger"><?php echo $lastnameErr; ?></small>
                    <input type="text" value="<?php echo $lastname; ?>" class="form-control" name="lastname" placeholder="lastname"><br>

                    <small class="text-danger"><?php echo $usernameErr; ?></small>
                    <input type="text" value="<?php echo $username; ?>" class="form-control" name="username" placeholder="username"><br>

                    <small class="text-danger"><?php echo $emailErr; ?></small>
                    <input type="email" value="<?php echo $email; ?>" class="form-control" name="email" placeholder="email"><br>

                    <small class="text-danger"><?php echo $passwordErr; ?></small>
                    <input type="password" class="form-control" name="password" placeholder="password"><br>

                    <input type="submit" value="SignUp" name="signup" class="btn btn-primary btn-md">  
                    
                    <a href="loginForm.php" class="btn btn-danger">LogIn </a>

                </form>
            </div>
        </div>
    </div>


<script src="js/bootstrap.min.js"></script>
</body>
</html>