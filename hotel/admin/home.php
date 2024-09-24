<?php 
require('incc/dbconfig.php');


$totalSimpleRooms = 3;
$totalDeluxeRooms = 20;
$totalSuiteRooms = 10;

$query = "SELECT ROOMTYPE, COUNT(*) as count FROM billinginfo GROUP BY ROOMTYPE";
$result = mysqli_query($con, $query);


if (!$result) {
    die("Query failed: " . mysqli_error($con));
}


$simpleCount = 0;
$deluxeCount = 0;
$suiteCount = 0;

// Fetch the counts
while($row = mysqli_fetch_assoc($result)) {
    if($row['ROOMTYPE'] == 'Simple Room') {
        $simpleCount = $row['count'];
    } elseif($row['ROOMTYPE'] == 'Deluxe Room') {
        $deluxeCount = $row['count'];
    } elseif($row['ROOMTYPE'] == 'Luxury Suite') {
        $suiteCount = $row['count'];
    }
}

// Calculate available rooms
$availableSimpleRooms = $totalSimpleRooms - $simpleCount;
$availableDeluxeRooms = $totalDeluxeRooms - $deluxeCount;
$availableSuiteRooms = $totalSuiteRooms - $suiteCount;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Counts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php require('header.php'); ?>

<div class="container mt-4">
    <div class="row">
        <!-- Booked Simple Room Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Booked Simple Rooms</h5>
                    <p class="display-4"><?php echo $simpleCount; ?></p>
                </div>
            </div>
        </div>

        <!-- Booked Deluxe Room Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Booked Deluxe Rooms</h5>
                    <p class="display-4"><?php echo $deluxeCount; ?></p>
                </div>
            </div>
        </div>

        <!-- Booked Suite Room Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Booked Suite Rooms</h5>
                    <p class="display-4"><?php echo $suiteCount; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Available Simple Room Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Available Simple Rooms</h5>
                    <p class="display-4"><?php echo $availableSimpleRooms; ?></p>
                </div>
            </div>
        </div>

        <!-- Available Deluxe Room Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Available Deluxe Rooms</h5>
                    <p class="display-4"><?php echo $availableDeluxeRooms; ?></p>
                </div>
            </div>
        </div>

        <!-- Available Suite Room Card -->
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Available Suite Rooms</h5>
                    <p class="display-4"><?php echo $availableSuiteRooms; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>