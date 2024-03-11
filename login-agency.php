<?php
    
    if(isset($_SESSION['loggedin']) ){
        header("location: ./index.php");
        exit;
    }
    $err = false;
    $blank = false;
    $login = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require './dbconnect.php';
        $email = $_POST["email"];
        $password = $_POST["password"];
        $hash = password_hash($password , PASSWORD_DEFAULT);

            $sql = "SELECT * FROM `agency_acc` WHERE `email` = '$email' ";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if($email=='' || $password==''){
                $blank = true;
            }else if($num == 1){
                while($row=mysqli_fetch_assoc($result)){
                    if(password_verify($password, $row['password'])){

                        $login = true;
                        session_start();
                        $_SESSION['isAgency'] = true;
                        $_SESSION['loggedin'] = true;
                        $_SESSION['email'] = $email;
                        header('location: ./index.php');
                    }else{
                        $err = true;
                    }
                    };
            }else{
              $err = true;
            };
       
    }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <title>rentCars | Agency Login</title>
</head>

<body class="bg-light">
     <?php require './navbar.php' ?>
     <?php
        if($err){echo '
          <div class="alert alert-danger alert-dismissible fade show text-danger bg-light my-1" style="border-radius: 50px;" role="alert">
          <strong>Sorry!</strong> Please Sign Up first.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
         
        };
        if($login){echo '
          <div class="alert alert-success alert-dismissible fade show text-success bg-light my-1" style="border-radius: 50px;" role="alert">
          <strong>Success!</strong> Your account is logged in.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
          
         };
         if($blank){echo '
            <div class="alert alert-success alert-dismissible fade show text-danger bg-light my-1" style="border-radius: 50px;" role="alert">
            <strong>Sorry!</strong> email or Password can not be blank.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
           };

     ?>
    
    <div class="container bg-white text-dark p-4 mt-5 col-md-6" style="border-radius: 15px; ">
        <h1 class="text-center">Agency Log in</h1>
        <form action="#" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" />
                
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" />
            </div>
           
            <div class="mt-4 ">
                <button type="submit" class="btn btn-outline-success ">Log In</button>
                <span class="ml-2 px-3">Not have account? <a href="./register-agency.php" class="text-primary" style="text-decoration: underline;"  >Register</a></p>
            </div>
        </form>
    </div>
    
    
</body>

</html>