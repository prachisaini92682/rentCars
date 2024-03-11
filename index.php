<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>rentCars</title>
</head>
<body>
    <?php include('./navbar.php'); ?>
    <div style=" display:flex; flex-direction: column; align-items: center; min-height:82vh; " class="">

        <div class="jumbotron mt-5">
            <div class="container">
                <h1 class="display-3">RentCars</h1>
                <p class="lead text-muted">rentCars is an innovative car rental platform that offers a convenient and seamless car rental experience to its users.  <br/>With a wide range of vehicles available for rent, rentCars caters to the diverse needs of its customers, whether it be for personal or business use.</p>
                <?php
                    if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
                        echo '
                        <p>
                        <a href="/register-user.php" class="btn btn-primary my-2">Rent Car Now!</a>
                        <a href="/register-agency.php" class="btn btn-secondary my-2">Add your Car</a>
                        </p>
                        ';
                    }
                ?>
            </div>
        </div>
        <div class="mx-auto px-auto mt-5" style="display: flex; flex-direction: row; justify-content: space-around;  flex-wrap: wrap;  ">
        
            <?php
                //connect database
                include('./dbconnect.php');
                //fetch car table
                $sql = "SELECT * FROM cars";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $agency_mail = $row['agency_mail'];
                        $email_array = explode("@", $agency_mail);
                        $username = $email_array[0];
                        $target = "images/".$username.$row['image'];
                        $isBooked = $row['user_mail']!=NULL;

                        // echo "Column 1: " . $row["name"] . " - Column 2: " . $row["number"] . " - Column 3: " . $row["capacity"] . "<br>";
                        echo '
                            <div style="max-width:full; min-width:fit; position:relative;" class=" bg-light border mb-3 me-md-2 pt-2 px-3 pt-md-2 px-md-5 text-center overflow-hidden">
                                <div class="my-3 p-3" >
                                    <div class="text-center mb-3">
                                    <img style="height:180px; object-fit:cover; border-radius: 21px 21px 0 0; bottom:0px" src="'.$target.'"  alt="not load" srcset="">
                                    </div>
                                    <h2 class="display-5">'.$row["name"].'</h2>
                                    <p class="lead">Rent Per Day : ₹'.$row["rentperday"].'</p>
                                    <p class="lead">Vehicle Number : '.$row["number"].'</p>
                                    <p class="lead">Vehicle Capacity : '.$row["capacity"].'</p>
                                    ';

                                if($isBooked){
                                    echo '<div class=""><p class="text-white py-2 bg-danger shadow" style="width:100%; position: absolute; left:0;" >Not available!</p></div>';
                                }else{
                                    echo '
                                    <a  class="btn btn-primary px-5" href="./vehicle.php?id='.$row["number"].'" >Rent Car</a>
                                    
                                    ';
                                }
                                echo '    </div>
                            </div>
                        ';
                    }
                } else {
                    echo "<p class='text-light-emphasis'>Oops! No results to show.</p>";
                }
            ?>
            
            
        </div>
    </div>
    
    <?php include('./footer.php'); ?>
    
</body>
</html>