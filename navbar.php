<?php
 session_start();
 echo '
<nav class=" shadow bg-white sticky-top navbar navbar-expand-lg py-4 ">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">
    <img src="./public/logo.png" height="40" alt="" srcset=""> rentCars
    </a>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <div style="display:flex; ">
      <div style="display:flex" >
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/about.php">About Us</a>
        </li>
      </div>
          ';
        
        if(isset($_SESSION['loggedin']) ){
          echo '
          <div style="display:flex;" >
          <li class="nav-item">
            <a href="./logout.php" class="nav-link">Log out</a>
          </li>
          ';
        }
        if(isset($_SESSION['loggedin']) && isset($_SESSION['isAgency']) && $_SESSION['isAgency'] == true){
          echo '
          <li class="nav-item">
            <a href="./dashboard.php" class="nav-link">Dashboard</a>
          </li>
          ';
        }
        echo '
          </div>
        </div>
      </ul>
      
    </div>
  </div>
</nav>
'
?>
