<?php require('inc/header.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOTEL</title>
    <?php require('inc/link.php');?>
    <style>
      .c-img{
        height:100%;
        object-fit:cover;
        filter:brightness(0.6);

      }
      .c-item{
      height:400px;
      }
      </style>
  </head>
<body>
 <!-- Carosel  -->
 <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active   c-item">
      <img src="image\carosel\1.jpg" class="d-block w-100  c-img" alt="slide 1">
    </div>
    <div class="carousel-item c-item">
      <img src="image\carosel\2.jpg" class="d-block w-100 c-img" alt="slide 2">
    </div>
    <div class="carousel-item c-item">
      <img src="image\carosel\3.jpg" class="d-block w-100  c-img" alt="slide 3">
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button> 
  </div>
</div>
<div>
</div>

<!-- Carosel  end -->

  <!-- OUR ROOM -->
   <h2   class ="mt-5 pt-4  mb-4 text-center fw-bold h-font">OUR ROOM </h2>
  <div class="container" >
    <div class="row">
      <div class="col-lg-4 col-md-6 my-3">
          <div class="card border-0" style="max-width:350px; margin:auto">
           <img src="image\carosel\1.jpg" class="card-img-top">
            <div class="card-body">
               <h5>Simple room</h5>
                <h6 clas="mb-4">रु 200 per night</h6>
                    <a href="room.php" class="btn btn-primary ml-7" class="popup">Book now</a>
                      <!-- <a href="#" class="btn btn-primary">More detail</a> -->

              </div>
          </div>
  </div>
  <div class="col-lg-4 col-md-6 my-3">
          <div class="card border-0" style="max-width:350px; margin:auto">
           <img src="image\carosel\1.jpg" class="card-img-top">
            <div class="card-body">
               <h5>Double room</h5>
                <h6 clas="mb-4">रु 400 per night</h6>
                <a href="room.php" class="btn btn-primary ml-7" class="popup">Book now</a>
                      <!-- <a href="#" class="btn btn-primary">More detail</a> -->

              </div>
          </div>
  </div>
  <div class="col-lg-4 col-md-6 my-3">
          <div class="card border-0" style="max-width:350px; margin:auto">
           <img src="image\carosel\1.jpg" class="card-img-top">
            <div class="card-body">
               <h5>Double room</h5>
                <h6 clas="mb-4">रु 600 per night</h6>
                    <a href="room.php" class="btn btn-primary ml-7" class="popup">Book now</a>
                      <!-- <a href="#" class="btn btn-primary">More detail</a> -->

              </div>
          </div>
  </div>
    <div class="col-lg-12 text-center mt-5">
    <!-- <button type="button" class="btn btn-primary">More >>>>></button> -->
    </div>
    </div>
    </div>

    
<!-- reach us -->
<?php require('inc/footer.php');?>

<!-- reach us end -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>
