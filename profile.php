<?php
    session_start();

    if(!$_SESSION["email"]){
        //user not logged in
        header("Location: loginForm.php");

    }

    if(isset( $_POST["upload"])){
        $folder = "uploads/";
        $target_dir = $folder.basename( $_FILES["upload"]);
    }

?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my profile</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h3>Profile Page</h3>
        <p class="lead">This site contains powerfull information!!!</p>

        <?php
            
               echo "You're welcome ". $_SESSION['firstname']." ". $_SESSION['lastname']. " your email is: ".
                 $_SESSION['email'];
        ?>
        <br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        Upload cv: <input type="file"  name="file" id="" multiple enctype="multipart/form-data">

        Upload cover letter: <input type="file" name="file" id="" multiple enctype="multipart/form-data">

        Upload result: <input type="file" name="file" id="" multiple enctype="multipart/form-data">

        Upload passport: <input type="file" name="file" id="" multiple enctype="multipart/form-data">
            <input type="submit" class="btn btn-danger" name="upload" value="upload file">

            <a href="loginForm.php" class="btn btn-danger" name="logout">Logout</a>
        </form>

        

    </div>


    <script src="js/bootstrap.min.js"></script>
</body>
</html>