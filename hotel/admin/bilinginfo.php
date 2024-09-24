<?php 
require('incc/dbconfig.php');

$query="SELECT * FROM billinginfo";
$result=mysqli_query($con,$query);
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM billinginfo WHERE REFERENCENO = '$delete_id'";
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
    <title>Billing Information</title>
    <?php require('incc/link.php'); ?>
</head>
<body>
<?php require('header.php'); ?>
    <div class="bg-dark">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="display-6 text-center">BILLING INFORMATION</h2>
                        </div>
                        <form action="" method="GET" class="mt-4">
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="Search by Reference number" name="refno">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                        <th>REFERENCE NO</th>
                                            <th>ROOMTYPE</th>
                                            <th>PRICE</th>
                                            <th>FULLNAME</th>
                                            <th>ADDRESS</th>
                                            <th>PHONENUMBER</th>
                                            <th>NOOFROOM</th>
                                            <th>CHECKIN</th>
                                            <th>CHECKOUT</th>
                                            <th>TOTALPRICE</th>
                                            <th>DELETE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                if (isset($_GET['refno']) && $_GET['refno'] != "") {
                                    $refernce_no= $_GET['refno'];
                                    $search_query = "SELECT * FROM billinginfo WHERE REFERENCENO='$refernce_no'";
                                    $search_result = mysqli_query($con, $search_query);
                                    if (!$search_result) {
                                        die("Search Query Failed: " . mysqli_error($con));
                                    }

                                    if (mysqli_num_rows($search_result) > 0) {
                                        while ($row = mysqli_fetch_assoc($search_result)) {
                                            ?>
                                            <tr>
                                            <td><?php echo $row['REFERENCENO']; ?></td>
                                            <td><?php echo $row['ROOMTYPE']; ?></td>
                                            <td><?php echo $row['PRICE']; ?></td>
                                            <td><?php echo $row['FULLNAME']; ?></td>
                                            <td><?php echo $row['ADDRESS']; ?></td>
                                            <td><?php echo $row['PHONENUMBER']; ?></td>
                                            <td><?php echo $row['NOOFROOM']; ?></td>
                                            <td><?php echo $row['CHECKIN']; ?></td>
                                            <td><?php echo $row['CHECKOUT']; ?></td>
                                            <td><?php echo $row['TOTALPRICE']; ?></td>
                                            <td><a href="?delete_id=<?php echo $row['REFERENCENO']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No record found for this phone number. Displaying all records below:</td></tr>';
                                        $default_result = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_assoc($default_result)) {
                                            ?>
                                            <tr>
                                            <td><?php echo $row['REFERENCENO']; ?></td>
                                            <td><?php echo $row['ROOMTYPE']; ?></td>
                                            <td><?php echo $row['PRICE']; ?></td>
                                            <td><?php echo $row['FULLNAME']; ?></td>
                                            <td><?php echo $row['ADDRESS']; ?></td>
                                            <td><?php echo $row['PHONENUMBER']; ?></td>
                                            <td><?php echo $row['NOOFROOM']; ?></td>
                                            <td><?php echo $row['CHECKIN']; ?></td>
                                            <td><?php echo $row['CHECKOUT']; ?></td>
                                            <td><?php echo $row['TOTALPRICE']; ?></td>
                                            <td><a href="?delete_id=<?php echo $row['REFERENCENO']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                } else {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                        <td><?php echo $row['REFERENCENO']; ?></td>
                                            <td><?php echo $row['ROOMTYPE']; ?></td>
                                            <td><?php echo $row['PRICE']; ?></td>
                                            <td><?php echo $row['FULLNAME']; ?></td>
                                            <td><?php echo $row['ADDRESS']; ?></td>
                                            <td><?php echo $row['PHONENUMBER']; ?></td>
                                            <td><?php echo $row['NOOFROOM']; ?></td>
                                            <td><?php echo $row['CHECKIN']; ?></td>
                                            <td><?php echo $row['CHECKOUT']; ?></td>
                                            <td><?php echo $row['TOTALPRICE']; ?></td>
                                            <td><a href="?delete_id=<?php echo $row['REFERENCENO']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>
                                        <?php
                                    }
                                }
                                ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</body>
</html>