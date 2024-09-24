<?php 
require('database.php');

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
while($row = mysqli_fetch_assoc($result)) {
    if($row['ROOMTYPE'] == 'Simple Room') {
        $simpleCount = $row['count'];
    } elseif($row['ROOMTYPE'] == 'Deluxe Room') {
        $deluxeCount = $row['count'];
    } elseif($row['ROOMTYPE'] == 'Luxury Suite') {
        $suiteCount = $row['count'];
    }
}
$availableSimpleRooms = $totalSimpleRooms - $simpleCount;
$availableDeluxeRooms = $totalDeluxeRooms - $deluxeCount;
$availableSuiteRooms = $totalSuiteRooms - $suiteCount;
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel-rooms</title>
    <?php include('inc/link.php'); ?>
    <style>
        .filter-section {
            background-color: #f8f9fa; 
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        .filter-section h5 {
            font-size: 20px; 
        }
        .filter-section .form-check-label {
            margin-left: 0.5rem;
        }
        .card {
            width: 100%;
        }
    </style>
</head>
<body class="bg-white">
    <?php require('inc/header.php'); ?>

    <div class="my-3 px-4">
        <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
        <div class="h-line bg-dark"></div>
    </div>
    <div class="container">
        <div class="row">
            <!-- <div class="col-lg-3">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">FILTER</h4>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#filterdropdown" aria-controls="filterdropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column mt-2" id="filterdropdown">
                            <div class="filter-section">
                                <h5 class="mb-3">CHECK AVAILABILITY</h5>
                                <label class="form-label">Check-in</label>
                                <input type="date" class="form-control shadow-none mb-3">
                                <label class="form-label">Check-out</label>
                                <input type="date" class="form-control shadow-none">
                            </div>
                            <div class="filter-section">
                                <h5 class="mb-3">GUEST</h5>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label">Adult</label>
                                        <input type="number" class="form-control shadow-none">
                                    </div>
                                    <div>
                                        <label class="form-label">Children</label>
                                        <input type="number" class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div> -->
            <div class="col-lg-12">
                <!-- Room 1 -->
                <div class="card mb-4">
    <div class="row g-0 p-3 align-items-center">
        <div class="col-md-5">
            <img src="image/carosel/1.jpg" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-5">
            <h5 class="mb-1">Simple Room</h5>
            <div class="feature mb-4">
                <h6 class="mb-1">Features</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">2 rooms</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">1 bathroom</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">1 Balcony</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">3 sofa</span>
            </div>
            <div class="facilities mb-4">
                <h6 class="mb-1">Facilities</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">Television</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">Wifi</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">AC</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">Room Heater</span>
            </div>
            <div class="Guest mb-4">
                <h6 class="mb-1">Guests</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">2 Adults</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">1 Child</span>
            </div>
        </div>
        <div class="col-md-2">
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { 
                if ($availableSimpleRooms > 0 && $availableSimpleRooms <= $totalSimpleRooms) { ?>
                    <h6 class="mb-4">$200 per night</h6>
                    <a class="btn btn-primary" href="billing.php?room=Simple%20Room&price=200" role="button">Book now</a>
                <?php } else { ?>
                    <p class="text-danger">No rooms available.</p>
                <?php } ?>
            <?php } else { ?>
                <p class="text-danger">Please <a href="#" data-bs-toggle="modal" data-bs-target="#login">login</a> to book.</p>
            <?php } ?>
        </div>
    </div>
</div>
                
              <!-- Room 2: Deluxe Room -->
<div class="card mb-4">
    <div class="row g-0 p-3 align-items-center">
        <div class="col-md-5">
            <img src="image/carosel/1.jpg" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-5">
            <h5 class="mb-1">Deluxe Room</h5>
            <div class="feature mb-4">
                <h6 class="mb-1">Features</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">3 rooms</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">2 bathrooms</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">2 Balconies</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">4 sofa</span>
            </div>
            <div class="facilities mb-4">
                <h6 class="mb-1">Facilities</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">Television</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">Wifi</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">AC</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">Room Heater</span>
            </div>
            <div class="Guest mb-4">
                <h6 class="mb-1">Guests</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">3 Adults</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">2 Children</span>
            </div>
        </div>
        <div class="col-md-2">
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { 
                if ($availableDeluxeRooms > 0 && $availableDeluxeRooms <= $totalDeluxeRooms) { ?>
                    <h6 class="mb-4">$300 per night</h6>
                    <a class="btn btn-primary" href="billing.php?room=Deluxe%20Room&price=300" role="button">Book now</a>
                <?php } else { ?>
                    <p class="text-danger">No rooms available.</p>
                <?php } ?>
            <?php } else { ?>
                <p class="text-danger">Please <a href="#" data-bs-toggle="modal" data-bs-target="#login">login</a> to book.</p>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Room 3: Luxury Suite -->
<div class="card mb-4">
    <div class="row g-0 p-3 align-items-center">
        <div class="col-md-5">
            <img src="image/carosel/1.jpg" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-5">
            <h5 class="mb-1">Luxury Suite</h5>
            <div class="feature mb-4">
                <h6 class="mb-1">Features</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">4 rooms</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">3 bathrooms</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">2 Balconies</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">5 sofa</span>
            </div>
            <div class="facilities mb-4">
                <h6 class="mb-1">Facilities</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">Television</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">Wifi</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">AC</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">Room Heater</span>
            </div>
            <div class="Guest mb-4">
                <h6 class="mb-1">Guests</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">4 Adults</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">2 Children</span>
            </div>
        </div>
        <div class="col-md-2">
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { 
                if ($availableSuiteRooms > 0 && $availableSuiteRooms <= $totalSuiteRooms) { ?>
                    <h6 class="mb-4">$400 per night</h6>
                    <a class="btn btn-primary" href="billing.php?room=Luxury%20Suite&price=400" role="button">Book now</a>
                <?php } else { ?>
                    <p class="text-danger">No rooms available.</p>
                <?php } ?>
            <?php } else { ?>
                <p class="text-danger">Please <a href="#" data-bs-toggle="modal" data-bs-target="#login">login</a> to book.</p>
            <?php } ?>
        </div>
    </div>
</div>

        </div>
    </div>

    <?php require('inc/footer1.php'); ?>

  