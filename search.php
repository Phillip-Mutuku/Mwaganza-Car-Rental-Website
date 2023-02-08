<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Car Rental | Search Car</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <meta content="Author" name="WebThemez">
  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet"> 
</head>

<body id="body"> 
 <?php include('includes/header.php');?>
 <section id="innerBanner"> 
  <div class="inner-content">
    <h2><span > <h1 style="color: #ffffff; font-size: 35px;">Search Result of keyword "<?php echo $_POST['searchdata'];?>"</h1></span><br>We provide high quality cars!</h2>
    <div> 
    </div>
  </div> 
</section><!-- #Page Banner -->

<main id="main">
 <!--Listing-->
 <section class="listing-page">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
        <div class="result-sorting-wrapper">
          <div class="sorting-count">
            <?php 
               //Query for Listing count
            $searchdata=$_POST['searchdata'];
            $sql = "SELECT tblvehicles.id from tblvehicles 
            join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand 
            where tblvehicles.VehiclesTitle=:search || tblvehicles.FuelType=:search || tblbrands.BrandName=:search || tblvehicles.ModelYear=:search";
            $query = $dbh -> prepare($sql);
            $query -> bindParam(':search',$searchdata, PDO::PARAM_STR);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=$query->rowCount();
            ?>
            <p><span><?php echo htmlentities($cnt);?> Listings found againt search</span></p>
          </div>
        </div>

        <?php 
        $sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles 
        join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand 
        where tblvehicles.VehiclesTitle=:search || tblvehicles.FuelType=:search || tblbrands.BrandName=:search || tblvehicles.ModelYear=:search";
        $query = $dbh -> prepare($sql);
        $query -> bindParam(':search',$searchdata, PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {
          foreach($results as $result)
          {  
            ?>
            <div class="product-listing-m gray-bg" >
              <div class="product-listing-img"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="Image" style="width: 380px; height: 250px;" /> </a> 
              </div>
              <div class="product-listing-content">
                <h5><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h5>
                <p class="list-price">$<?php echo htmlentities($result->PricePerDay);?> Per Day</p>
                <ul>
                  <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
                  <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?> model</li>
                  <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
                </ul>
                <a href="car_details.php?vhid=<?php echo htmlentities($result->id);?>" class="btn" style="background-color: #49a3ff;">View Details <span class="angle_arrow"><i class="fa fa-angle-right" style="color: #49a3ff; "  aria-hidden="true"></i></span></a>
              </div>
            </div>
            <?php 
          }
        } ?>
      </div>

      <!--Side-Bar-->
      <aside class="col-md-3 col-md-pull-9">
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-car" aria-hidden="true"></i> Recently Listed Cars</h5>
          </div>
          <div class="recent_addedcars">
            <ul>
              <?php $sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand order by id desc limit 4";
              $query = $dbh -> prepare($sql);
              $query->execute();
              $results=$query->fetchAll(PDO::FETCH_OBJ);
              $cnt=1;
              if($query->rowCount() > 0)
              {
                foreach($results as $result)
                {  
                  ?>

                  <li class="gray-bg">
                    <div class="recent_post_img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image"></a> </div>
                    <div class="recent_post_title"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a>
                      <p class="widget_price">$<?php echo htmlentities($result->PricePerDay);?> Per Day</p>
                    </div>
                  </li>
                  <?php 
                }
              } ?>

            </ul>
          </div>
        </div>
      </aside>
      <!--/Side-Bar--> 
    </div>
  </div>
</section>
<!-- /Listing--> 
<section id="call-to-action" class="wow fadeInUp">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 text-center text-lg-left">
        <h3 class="cta-title">Get Our Service</h3>
        <p class="cta-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores quae porro consequatur aliquam, incidunt fugiat culpa esse aute nulla cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      <div class="col-lg-3 cta-btn-container text-center">
        <a class="cta-btn align-middle" href="contact.php">Contact Us</a>
      </div>
    </div>

  </div>
</section><!-- #call-to-action -->


</main>

  <!--==========================
    Footer
    ============================-->
    <?php include('includes/footer.php');?><!-- #footer -->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!--Login-Form -->
    <?php include('includes/login.php');?>
    <!--/Login-Form --> 

    <!--Register-Form -->
    <?php include('includes/registration.php');?>

    <!--/Register-Form --> 

    <!--Forgot-password-Form -->
    <?php include('includes/forgotpassword.php');?>

    <!-- JavaScript  -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/superfish/hoverIntent.js"></script>
    <script src="lib/superfish/superfish.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/magnific-popup/magnific-popup.min.js"></script>
    <script src="lib/sticky/sticky.js"></script> 
    <script src="contact/jqBootstrapValidation.js"></script>
    <script src="contact/contact_me.js"></script>
    <script src="js/main.js"></script>

  </body>
  </html>
