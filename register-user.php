<?php
    if(isset($_SESSION['loggedin']) ){
        header("location: ./index.php");
        exit;
    }
  
    $blank = false;
    $showErr = false;
    $exists = false;
    $showAlert = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
       include('./dbconnect.php');
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        $contact = $_POST["contact"];
        
        //check user account is already exits or not
        $existSql = "SELECT * FROM `user_acc` WHERE `email` = '$email'";
        $existResult = mysqli_query($conn , $existSql);
        $numExistRows = mysqli_num_rows($existResult);
        if($numExistRows > 0){
            $exists = true;
        }else
        if($email=='' || $password==''){
            $blank = true;
        }else if(($password == $cpassword) && ($exists == false)){
            $hash = password_hash($password , PASSWORD_DEFAULT);

            $sql = "INSERT INTO `user_acc` ( `email`, `password`,`contact`, `created_on`) VALUES ( '$email', '$hash','$contact', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = true;
            }
        }else{
            $showErr = true;
        } 

    }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>iSecure | Sign Up</title>
</head>

<body class="bg-light">
     <?php require './navbar.php' ?>
     <?php
     if($showAlert){echo '
         <div class="alert alert-success alert-dismissible fade show text-success bg-light my-1" style="border-radius: 50px;" role="alert">
         <strong>Success!</strong> Your account is now created and you can login.
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
         $password = "";
        };
        if($blank){echo '
            <div class="alert alert-danger alert-dismissible fade show text-danger bg-light my-1" style="border-radius: 50px;" role="alert">
            <strong>Sorry!</strong> You can not leave your email or password blank.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
           };
           if($showErr){echo '
            <div class="alert alert-danger alert-dismissible fade show text-danger bg-light my-1" style="border-radius: 50px;" role="alert">
            <strong>Sorry!</strong> Your password not match with confirm password.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
           };
           if($exists){echo '
            <div class="alert alert-danger alert-dismissible fade show text-danger bg-light my-1" style="border-radius: 50px;" role="alert">
            <strong>Sorry!</strong> Your email already taken.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
           };
           
     ?>
    <div class="container bg-white text-dark p-4 mt-5 col-md-6" style="border-radius: 15px; ">
        <h1 class="text-center">User Register</h1>
        <form action="#" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" />
                
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" />
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" />
                <small id="emailHelp" class="form-text">
                    Make sure to type the same password.
                </small>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="number" class="form-control" id="contact" name="contact" />
            </div>
            <div class="conatiner ">
                <button type="submit" class="btn btn-outline-success ">Sign Up</button>
                <span class="ml-2 px-3">Already registered? <a href="./login-user.php" class="text-primary" style="text-decoration: underline;">Log In</a></p>
            </div>
        </form>
    </div>

</body>

</html>