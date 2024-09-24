<?php
session_start();

if (isset($_POST['log'])) {
    $email = trim($_POST['lemail']);
    $password = $_POST['lpassword'];

    require_once "database.php"; 

    $sql = "SELECT * FROM register WHERE EMAIL='$email'";
    $result = mysqli_query($con, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        if (password_verify($password, $user['PASSWORD'])) {

          // setting email in session variable
            $_SESSION['email']= $email;
            $_SESSION['userEmail']= $_SESSION['email'];
            $_SESSION['login_message'] = "<div class='alert alert-success'>Login successful</div>";
            $_SESSION['logged_in'] = true;
        } else {
            $_SESSION['login_message'] = "<div class='alert alert-danger'>Password does not match</div>";
        }
    } else {
        $_SESSION['login_message'] = "<div class='alert alert-danger'>Email does not match</div>";
    }

   
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>




<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand me-5" href="index.php">HOTEL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active me-3" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" aria-current="page" href="room.php">Room</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  me-3" aria-current="page" href="facilities.php">Facilities</a>
        </li>
        <li class="nav-item">
          <a class="nav-link   me-3" aria-current="page" href="contactus.php">Contact us</a>
        </li>
      </ul>
      <?php 
      if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        echo '<div class="d-flex align-items-center">';
        echo '<span class="me-3 text-success fw-bold">You are logged in</span>';
      echo '<a href="logout.php" class="btn btn-primary shadow-none me-lg-3">Logout</a>';
      } else { ?>
      <div class="d-flex">
        <button type="button" class="btn btn-primary shadow-none me-lg-3 me-3" data-bs-toggle="modal" data-bs-target="#login">Login</button>
        <button type="button" class="btn btn-primary shadow-none me-lg-3 me-3" data-bs-toggle="modal" data-bs-target="#register">Register</button>
    </div>
<?php } ?>
    </nav>
<!-- Navbar  End -->



<?php 
$successMessage = "";
$errorMessage = "";

if (isset($_POST['submit'])) {
    $fullname = $_POST['rfullname'];
    $phonenumber = $_POST['rphonenumber'];
    $email = $_POST['remail'];
    $password = $_POST['rpassword'];
    $cpassword = $_POST['rcpassword'];
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);

    $error = array();

    // Validation checks
    if (empty($fullname) || empty($phonenumber) || empty($email) || empty($password) || empty($cpassword)) {
        array_push($error, "All text fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($error, "Email is not valid.");
    }

    if (strlen($password) < 8) {
        array_push($error, "Password must be at least 8 characters.");
    }

    if ($password != $cpassword) {
        array_push($error, "Passwords do not match.");
    }

    require_once "database.php";

    // Check if email already exists
    if (empty($error)) { // Only check for existing email if there are no previous errors
        $sqlp = "SELECT * FROM register WHERE EMAIL='$email'";
        $res = mysqli_query($con, $sqlp); 
        $rowCount = mysqli_num_rows($res);
        if ($rowCount > 0) {
            array_push($error, "Email already exists!");
        }
    }

    // If errors, display them
    if (count($error) > 0) {
        foreach ($error as $errors) {
            $errorMessage .= "<div class='alert alert-danger'>$errors</div>";
        }
    } else {
        // If no errors, proceed with registration
        $sql = "INSERT INTO register (FULLNAME, PHONENUMBER, EMAIL, PASSWORD) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($con);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $fullname, $phonenumber, $email, $pass_hash);
            mysqli_stmt_execute($stmt);
            $successMessage = "<div class='alert alert-success'>You are registered successfully.</div>";
        } else {
            $errorMessage = "<div class='alert alert-danger'>Something went wrong.</div>";
        }
    }
}
?>

<!-- Registration -->
<div class="modal fade" id="register" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="">
        <div class="modal-header">
          <h5 class="modal-title align-items-center" id="staticBackdropLabel"><i class="bi bi-person-fill-down"></i> User Registration</h5>
          <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Only display messages if there are any -->
          <?php 
          if (!empty($successMessage)) {
              echo $successMessage;
          } 
          if (!empty($errorMessage)) {
              echo $errorMessage;
          }
          ?>
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="rfullname" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="number" name="rphonenumber" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="remail" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="rpassword" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="rcpassword" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="submit" class="btn btn-primary">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Registration end -->
<!-- Login -->
<div class="modal fade" id="login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="log" method="post" autocomplete="off"> 
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel align-items-center"><i class="bi bi-people fs-20 me-3"></i>User login</h5>
          <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="lemail" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="lpassword" class="form-control">
          </div>
          <button type="submit" name="log" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Login end -->



 