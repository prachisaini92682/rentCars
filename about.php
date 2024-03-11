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

            $sql = "SELECT * FROM `user_acc` WHERE `email` = '$email' ";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if($email=='' || $password==''){
                $blank = true;
            }else if($num == 1){
                while($row=mysqli_fetch_assoc($result)){
                    if(password_verify($password, $row['password'])){

                        $login = true;
                        session_start();
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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <title>rentCars | User Login</title>
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
    <div class="container mt-5" style="min-height: 78vh;">
        <div class="row">
            <div class="col-lg-8">
                <h2>About Us</h2>
                <p>
                    Welcome to rentCar, your premier destination for hassle-free and reliable car rentals. At rentCar, we take pride in providing a seamless and enjoyable driving experience for every customer. With a diverse fleet of well-maintained vehicles, from compact cars to spacious SUVs, we cater to your every need. <br><br>

                    Our commitment to exceptional customer service ensures that your journey with rentCar is not just about renting a car but creating memorable moments on the road. We prioritize convenience, affordability, and reliability, making us your go-to choice for all your car rental needs. <br><br>

                    Choose rentCar for a smooth ride, unbeatable service, and a commitment to exceeding your expectations. Let us be your trusted partner in making your travels more enjoyable and stress-free. Drive with confidence, drive with rentCar.</p>
                <!-- Add more content as needed -->
            </div>

            <div class="col-lg-4">
                <img src="images/sample.png" alt="About Us Image" class="img-fluid">
            </div>
        </div>
    </div>
    <?php include('./footer.php'); ?>

</body>
</html>