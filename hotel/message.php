
<?php require('database.php');?>
<?php require('inc/header.php');?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment successful</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>
    <?php

    $userEmail= $_SESSION['userEmail'];

    if (isset($_SESSION['transaction_msg'])) {
        echo $_SESSION['transaction_msg'];
        unset($_SESSION['transaction_msg']);
    }
    ?>

    <div class="mt-5 d-flex justify-content-center">
        <div class="mb-3">
            <img src="payment-success.jpg" class="img-flud" alt="">
            <div class="card">
                <div class="card-body text-white bg-success">
                    <h5 class="card-title">Dear Customer,</h5>
                    <p class="card-text">
                        Your payment has been successfully processed. Thank you for choosing us.
                    </p>
                    <?php
                    // echo $_SESSION['transactionID'].'<br>';
                    // echo $_SESSION['totalAmount'].'<br>';
                    // echo $_SESSION['noofRoom'];

                    $price = $_SESSION['totalAmount'] / 100;
                    $roomNo = $_SESSION['noofRoom'];
                    $price_room = $price / $roomNo;

                    $sql = "INSERT INTO billinginfo (REFERENCENO,ROOMTYPE, PRICE, FULLNAME, ADDRESS, PHONENUMBER, NOOFROOM, CHECKIN, CHECKOUT, TOTALPRICE) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?)";
                     // Initialize the prepared statement
    $stmt = mysqli_stmt_init($con);

      // Check if the statement was prepared correctly
      if (mysqli_stmt_prepare($stmt, $sql)) {

        // Bind the session variables to the statement
        mysqli_stmt_bind_param($stmt, "ssdsssissd",
            $_SESSION['transactionID'],
            $_SESSION['roomType'],
            $price_room,
            $_SESSION['name'],
            $_SESSION['Address'],
            $_SESSION['Phone'],
            $_SESSION['noofRoom'],
            $_SESSION['Checkin'],
            $_SESSION['Checkout'],
            $price
        );

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Data inserted successfully!";
        } else {
            echo "Error inserting data: " . mysqli_error($con);
        }

    } else {
        echo "Error preparing statement: " . mysqli_error($con);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    ?>

<?php


// conformation email

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$sendEmail= $userEmail;
$nameEM= $_SESSION['name'];
$addressEM= $_SESSION['Address'];
$checkINEM= $_SESSION['Checkin'];
$checkOUTEM= $_SESSION['Checkout'];

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->Username   = 'testhotel11111@gmail.com';             //SMTP username
    $mail->Password   = 'wshbfybdeinvqxyg';                     //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // PHPMailer::ENCRYPTION_SMTPS;  and port 465  - Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('testhotel11111@gmail.com', 'Hotel');
    $mail->addAddress($sendEmail, 'User');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Booking Conformation';
    $mail->Body    = '
                    <div>
                        <h2>Booking Details</h2>
                        <div>
                            <h4>Name: '.$nameEM.'</h4>
                            <h4>Address: '.$addressEM.'</h4>
                            <h4>ChechIn: '.$checkINEM.'</h4>    
                            <h4>CheckOut: '.$checkOUTEM.'</h4>
                            <h4>Total Price: '.$price.'</h4>
                        </div>
                    </div>';                             //same like other too.
    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Error: {$mail->ErrorInfo}";
}

    
                    ?>
                </div>
                <div class="card-footer">
                    <a href="index.php" class="btn btn-primary">Back to Home</a>
                </div>
            </div>

        </div>
    </div>

</body>

</html>