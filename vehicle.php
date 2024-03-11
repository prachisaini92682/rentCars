
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Vehicle</title>
  </head>
  <body>
    <?php include './navbar.php'; ?>

    <?php
        include './dbconnect.php';
        $id = $_GET['id'];
        $sql = "SELECT * FROM cars WHERE number ='".$id."';";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) >0) { // Fetch the first row as an associative array $row =
            $row = mysqli_fetch_assoc($result);
            $agency_mail = $row['agency_mail'];
            $email_array = explode("@", $agency_mail);
            $username = $email_array[0];
            $target = "../images/".$username.$row['image']; // Access the values of the columns in the row
            echo '
            
            <div class="container mt-5 mb-5">
            <div class="card">
              <div class="row g-0">
                <div class="col-md-6 border-end">
                  <div class="d-flex flex-column justify-content-center">
                    <div class="main_image p-4 flex justify-center" style="object-fit:cover;">
                      <img
                        src="'.$target.'"
                        id="main_product_image"
                        width="100%"
                        style="object-fit:cover; my-auto; width:100%; height:100%; "
                      />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="p-3 right-side">
                    <div class="d-flex justify-content-between align-items-center">
                      <h3>'.$row['name'].'</h3>
                      <span class="heart"><i class="bx bx-heart"></i></span>
                    </div>
                    <div class="mt-2 pr-3 content">
                      <p>
                        Introducing the '.$row['name'].' Car with license plate '.$row['number'].', a stylish ride designed for comfort. This car, accommodating up to '.$row['capacity'].' persons, redefines every journey with its sleek design and modern features.
                      </p>
                    </div>
                    <h3>₹'.$row['rentperday'].'/day</h3>
                    <div class="">
                      <p>Vehicle Number : '.$row['number'].'</p>
                      <p>Vehicle Capacity : '.$row['capacity'].'</p>
                      <p>Agency Contact : '.$row['agency_mail'].'</p>
                    </div>';
                    

                    if( isset($_SESSION['loggedin']) && isset($_SESSION['isAgency']) && $_SESSION['isAgency'] == true) {
                      
                      echo '<span class="text-xs text-danger bg-light shadow-lg p-3" >You logged in as Agency, So you can not rent any car.</span>';
                        }else{

                          echo'
                      
                      <div class="buttons d-flex flex-row mt-2 gap-3">
                      <form action="#" method="post" class="needs-validation" novalidate="">
                      <div class="row g-2 mx-auto">
                      <input type="text" value="'.$id.'" name="number" hidden/>
                      <div class="col-md-6">
                      <label for="noofdays" class="form-label">Number Of Days</label>
                      <select class="form-select" id="noofdays" name="noofdays" required="">
                      <option selected value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          </select>
                          
                          <div class="invalid-feedback">
                          Please select a valid country.
                          </div>
                          </div>
                          <div class="col-md-6">
                          <label for="startdate" class="form-label">Start Date</label>
                          <input type="date" class="form-control" id="startdate" min="" name="startdate" placeholder="" required="">
                          </div>
                          </div>
                          
                          <hr class="my-4">
                          
                          <button class="w-100 btn btn-primary btn-lg" value="submit" type="submit">Rent Now</button>
                          </form>
                          
                          </div>
                          ';
                        }

                        echo '
                  </div>
                </div>
              </div>
            </div>
          </div>

            ';
        } 

   
    ?>

    <div>  
    </div>
      <script>
        // Get the current date in the format "YYYY-MM-DD"
        function getCurrentDate() {
            const now = new Date();
            const year = now.getFullYear();
            const month = (now.getMonth() + 1).toString().padStart(2, '0');
            const day = now.getDate().toString().padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // Set the minimum date for the input to today
        document.getElementById('startdate').min = getCurrentDate();
    </script>
  </body>
</html>


<?php

if( $_SERVER["REQUEST_METHOD"] == "POST"  ){
  if($_SESSION['loggedin'] == false){
    echo "<script>window.location = './register-user.php';</script>";
  }

  if(isset($_POST['noofdays'])  && isset($_POST['startdate'])){

    
    $input_date = $_POST['startdate']; // the input date
    $today = time(); // today's timestamp
    
    $input_timestamp = strtotime($input_date);
    
    if ($input_timestamp >= $today) {
      echo "Input date is in the future or present.";
    } else {
      $dateErr = true;
      exit();
      
    }
    
    echo $_POST['number'];
    $startdate = $_POST["startdate"];
    $noofdays = $_POST["noofdays"];
    
    echo $startdate . ' ' . $noofdays;
    $sql = "UPDATE cars SET user_mail='".$_SESSION['email']."', startdate='".$_POST['startdate']."', noofdays=".$_POST['noofdays']." WHERE number='".$_POST['number']."';";
    
    if (mysqli_query($conn, $sql)) {    
      echo "Record updated successfully";
      echo "<script>window.location = './index.php';</script>";
      exit;
    } 
  }
}
    
?>