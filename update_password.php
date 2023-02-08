<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{ 
  header('location:index.php');
}
else{
  if(isset($_POST['updatepass']))
  {
    $password=md5($_POST['password']);
    $newpassword=md5($_POST['newpassword']);
    $email=$_SESSION['login'];
    $sql ="SELECT Password FROM tblusers WHERE EmailId=:email and Password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    if($query -> rowCount() > 0)
    {
      $con="update tblusers set Password=:newpassword where EmailId=:email";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
      $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      $msg="Your Password succesfully changed";
    }
    else {
      $error="Your current password is wrong";  
    }
  }

  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Car Rental Portal | Update Password</title>
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
    <script type="text/javascript">
      function valid()
      {
        if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
        {
          alert("New Password and Confirm Password Field do not match  !!");
          document.chngpwd.confirmpassword.focus();
          return false;
        }
        return true;
      }
    </script>
    <style>
      .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
      }
      .succWrap{
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
      }
    </style>
  </head>

  <body id="body">
   <?php include('includes/header.php');?>
   <section id="innerBanner"> 
    <div class="inner-content">
      <h2><span>My Profile</span><br>We create the opportunities!</h2>
      <div> 
      </div>
    </div> 
  </section><!-- #Page Banner -->

  <main id="main">

    <?php 
    $useremail=$_SESSION['login'];
    $sql = "SELECT * from tblusers where EmailId=:useremail";
    $query = $dbh -> prepare($sql);
    $query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;
    if($query->rowCount() > 0)
    {
      foreach($results as $result)
        { ?>
          <section class="user_profile inner_pages">
            <div class="container">
              <div class="user_profile_info gray-bg padding_4x4_40">
                <div class="upload_user_logo"> <img src="admin/img/vehicleimages/dealer-logo.jpg" alt="image">
                </div>

                <div class="dealer_info">
                  <h5><?php echo htmlentities($result->FullName);?></h5>
                  <p><?php echo htmlentities($result->Address);?><br>
                    <?php echo htmlentities($result->City);?>&nbsp;<?php echo htmlentities($result->Country);}}?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3 col-sm-3">
                    <?php include('includes/sidebar.php');?>
                    <div class="col-md-6 col-sm-8">
                      <div class="profile_wrap">
                        <form name="chngpwd" method="post" onSubmit="return valid();">

                          <div class="gray-bg field-title">
                            <h6>Update password</h6>
                          </div>
                          <?php 
                          if($error)
                          {
                            ?>
                            <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div>
                            <?php 
                          } else if($msg)
                          {
                            ?>
                            <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
                            <?php
                          }?>
                          <div class="form-group">
                            <label class="control-label">Current Password</label>
                            <input class="form-control white_bg" id="password" name="password"  type="password" required>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Password</label>
                            <input class="form-control white_bg" id="newpassword" type="password" name="newpassword" required>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Confirm Password</label>
                            <input class="form-control white_bg" id="confirmpassword" type="password" name="confirmpassword"  required>
                          </div>

                          <div class="form-group">
                            <input type="submit" value="Update" name="updatepass" id="submit" class="btn btn-primary" style="background-color: #49a3ff;">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

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
            <!--/Forgot-password-Form --> 

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
          <?php 
        } ?>
