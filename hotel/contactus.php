<?php
if (isset($_POST['csubmit'])) {
    $name = $_POST['cname'];
    $email = $_POST['cemail'];
    $subject = $_POST['csubject'];
    $message = $_POST['cmessage'];

    require_once "database.php";

    $sql = "INSERT INTO contact(NAME,EMAIL,SUBJECT,MESSAGE) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($con);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $message);
        if (mysqli_stmt_execute($stmt)) {
            
        } else {
            echo "<div class='alert alert-danger'>Error: " . mysqli_stmt_error($stmt) . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($con) . "</div>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>
    <?php require('inc/link.php');?>
</head>
<body>
<?php require('inc/header.php');?>
<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">CONTACT US</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
    Planning your next stay with us? Feel free to reach out for reservations or any inquiries you may have.<br> Our dedicated team is ready to assist you in making your stay memorable.
    </p>
</div>
<div class="row mb-4"> 
    <div class="col-lg-6 ms-lg-5">
        <div class="bg-white rounded shadow p-4 border-top border-4">
            <iframe class="w-100" height="280px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.089216126969!2d85.30405277497424!3d27.683637326537664!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19b9409d44bd%3A0xad577288cb7d3ee9!2sEverest%20Engineering%20College!5e0!3m2!1sen!2snp!4v1719233799932!5m2!1sen!2snp" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <h5 class="mt-3">Address</h5>
            <a href="" class="d-line-block text-decoration-none text-dark">
                Sanepa, Lalitpur
            </a>
            <h5 class="mt-3">Phone number</h5>
            <a href="" class="d-line-block text-decoration-none text-dark">
                999999999
            </a>
            <h5 class="mt-3">Follow us</h5>
            <a href="" class="d-inline-block mb-2 me-2">
                <span class="badge bg-light text-dark fs-6 p-2">
                    <i class="bi bi-facebook me-1"></i>Facebook
                </span>
            </a>
            <a href="" class="d-inline-block mb-2 me-2">
                <span class="badge bg-light text-dark fs-6 p-2">
                    <i class="bi bi-instagram me-1"></i>Instagram
                </span>
            </a>
            <a href="" class="d-inline-block mb-2">
                <span class="badge bg-light text-dark fs-6 p-2">
                    <i class="bi bi-twitter me-1"></i>Twitter
                </span>
            </a>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="bg-white rounded shadow p-4">
           <form method="POST">
            <h5>Send us message</h5 >
            <div class="mt-3">
                <label class="form-label">Name</label>
                <input type="text"  name="cname"class="form-control shadow-none">
            </div> 
            <div class="mt-3">
                <label class="form-label">Email</label>
                <input type="email" name="cemail"class="form-control shadow-none">
            </div> 
            <div class="mt-3">
                <label class="form-label">Subject</label>
                <input type="text" name="csubject" class="form-control shadow-none">
            </div> 
            <div class="mt-3">
                <label class="form-label">Message</label>
                <textarea class="form-control shadow-none" name="cmessage" rows="5"></textarea>
            </div>
            <button type="submit" name="csubmit" class="btn btn-primary  mt-3">Send message </button>     
        </form>
        </div>
    </div>
</div>
</body>
</html>
