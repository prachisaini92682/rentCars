


<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <title>rentCars | Agency Login</title>
</head>

<body class="bg-light" >
    <?php include('./navbar.php'); ?>

    


    <div class="container bg-white text-dark p-4 mt-5 col-md-6" style="border-radius: 15px; ">
        <h1 class="text-center">Add Car</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="carName">Vehicle Model</label>
                <input type="text" class="form-control" id="carName" name="carName">  
            </div>
            <div class="mb-3">
                <label for="carName">Vehicle Number</label>
                <input type="text" class="form-control" id="carNumber" name="carNumber">  
            </div>
            <div class="mb-3">
                <label for="vcapacity">Vehicle Capacity</label>
                <input type="number" class="form-control" id="carCapacity" name="carCapacity">  
            </div>
            <div class="mb-3">
                <label for="rentperday">Rent Per Day</label>
                <input type="number" class="form-control" id="rentPerDay" name="rentPerDay">  
            </div>
            <div class="mb-3">
                <label for="carimage">Car Image</label>
                <input type="file" class="form-control" id="carImage" name="carImage">
            </div>
           
            <div class="container mt-4 ">
                <button type="submit" class="btn btn-outline-success ">Save Car</button>
                <button type="reset" class="mx-3 px-3 btn btn-outline-dark">Reset</button>
            </div>
        </form>
    </div>
    <h2 class="text-center mt-5" >Cars Status</h2>
    <div class="container mt-5 mb-5">

    <table class="table bg-white  text-center border">
  <thead>
    <tr>
      <th>Vehicle Image</th>
      <th scope="col">Vehicle Number</th>
      <th scope="col">Model</th>
      <th scope="col">Car Status/Booked By</th>
      <th scope="col">No Of Days</th>
      <th scope="col">Start Date</th>
    </tr>
  </thead>
  <tbody>
    <?php

include('./dbconnect.php');
//fetch car table
$sql = "SELECT * FROM cars where agency_mail='".$_SESSION['email']."';";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $number = $row['number'];
        $isNotBooked = $row['user_mail']=="";
        $carStatus = $isNotBooked ? "<p class='text-success' >Available</p>" : $row['user_mail'];
        $noofdays = $row['noofdays'];
        $startdate = $row['startdate'];
        $email_array = explode("@", $row['agency_mail']);
        $username = $email_array[0];
        $target = "../images/".$username.$row['image'];
        
        echo '
        <tr>
          <td> <img height="40" src="'.$target.'" alt="car image" /> </td>
          <th scope="row">'.$number.'</th>
          <td>'.$name.'</td>
          <td>'.$carStatus.'</td>
          <td>'.($noofdays ?? '-').'</td>
          <td>'.($startdate ?? '-').'</td>
        </tr>';

    }

}
      
    ?>
  </tbody>
</table>
</div>

    
</body>

</html>
<?php
  if (isset($_POST['carName']) && isset($_POST['rentPerDay']) && isset($_POST['carNumber']) && isset($_POST['carCapacity']) && isset($_FILES['carImage']) ) {
    $carName = $_POST['carName'];
    $carNumber = $_POST['carNumber'];
    $carCapacity = $_POST['carCapacity'];
    $rentPerDay = $_POST['rentPerDay'];
    $carImage = $_FILES['carImage']['name'];
    $temp_name = $_FILES['carImage']['tmp_name'];
    $agency_mail = $_SESSION['email'];
    $email_array = explode("@", $agency_mail);
    $username = $email_array[0];
    $target = "images/".$username.$carImage;

    include('./dbconnect.php');

    if (move_uploaded_file($_FILES['carImage']['tmp_name'], './'.$target)) {
      $sql = "INSERT INTO cars (name,number, capacity, rentperday, image, agency_mail) VALUES ('$carName','$carNumber','$carCapacity','$rentPerDay', '$carImage','$agency_mail')";
      if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success w-fit mx-4'>Car saved successfully.</div>";
        header("location: ../index.php");
      } else {
        echo "not refresh without press reset button";
        // echo "<div class='alert alert-danger'>Failed to save car: " . mysqli_error($conn) . "</div>";
      }
    } else {
      echo "<div class='alert alert-danger'>Failed to save car image.</div>";
    }

  }
?>

<?php include('./footer.php'); ?>
