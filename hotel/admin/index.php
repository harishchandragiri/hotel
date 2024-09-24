<?php
require('incc/dbconfig.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <?php require('incc/link.php'); ?>
    <style>
        div.login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 350px; 
            padding: 30px; 
        }
        .btn {
            background-color: blue; 
        }
        input.form-control {
            width: 300px; 
            height: 40px;  
            font-size: 16px; 
        }
        .custom-alert {
            position: fixed;
            top: 25px;
            right: 25px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="login-form text-center rounded bg-white shadow overflow-none">
        <div class="p-10">
            <form method="POST">
                <h4>ADMIN LOGIN PANEL</h4>
                <div class="mb-3">
                    <input type="name" name="admin_name" class="form-control shadow-none text-center" placeholder="ADMIN NAME">
                </div>
                <div class="mb-4">
                    <input type="password" name="admin_pass" class="form-control shadow-none text-center" placeholder="PASSWORD">
                </div>
                <button type="submit" name="login" class="btn text-white custom-bg">LOGIN</button>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['login'])) {
        $frm_data = filteration($_POST);
        $query = "SELECT * FROM `admin` WHERE `admin_name` = ? AND `admin_pass` = ?";
        $values = [$frm_data['admin_name'], $frm_data['admin_pass']];
        $res = select($query, $values, "ss"); 
        if ($res->num_rows == 1) {
            header("location:home.php");
        } else {
            echo <<<alert
            <div class="alert alert-warning alert-dismissible fade show custom-alert" role="alert">
                <strong>Wrong password</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            alert;
        }
    }
    ?>

    <?php require('incc/script.php'); ?>
</body>
</html>