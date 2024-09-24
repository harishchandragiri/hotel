<?php 
require('incc/dbconfig.php');

$query="select * from contact";
$result=mysqli_query($con,$query);
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $delete_query = "DELETE FROM contact WHERE NO = '$delete_id'";
    if (mysqli_query($con, $delete_query)) {
        $msg = "Record deleted successfully";
    } else {
        $error = "Error deleting record: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account</title>
    <?php require('incc/link.php'); ?>
</head>
<body>
<?php require('header.php'); ?>
    <div class="bg-dark">
        <div class="container">
            <div class="row mt-5">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="display-6 text-center">CONTACT INFO</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered text-center">
                                <tr class="bg-dark text-white">
                                    <td>No</td>
                                    <td>EMAIL</td>
                                    <td>SUBJECT</td>
                                    <td>MESSAGE</td>
                                    <td>EDIT</td>
                                    <td>DELETE</td>
                                </tr>
                                <?php
                                while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['NO']; ?></td>
                                    <td><?php echo $row['EMAIL']; ?></td>
                                    <td><?php echo $row['SUBJECT']; ?></td>
                                    <td><?php echo $row['MESSAGE']; ?></td>
                                    <td><a href="#" class="btn btn-primary">Edit</a></td>
                                    <td> <a href="?delete_id=<?php echo $row['NO']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</body>
</html>