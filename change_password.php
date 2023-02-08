<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['odmsaid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$adminid=$_SESSION['odmsaid'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$sql ="SELECT ID FROM tbladmin WHERE ID=:adminid and Password=:cpassword";
$query= $dbh -> prepare($sql);
$query-> bindParam(':adminid', $adminid, PDO::PARAM_STR);
$query-> bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);

if($query -> rowCount() > 0)
{
$con="update tbladmin set Password=:newpassword where ID=:adminid";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':adminid', $adminid, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();

echo '<script>alert("Your password successully changed")</script>';
} else {
echo '<script>alert("Your current password is wrong")</script>';

}
}
?>
<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
}   

</script>
  <?php @include("includes/head.php");?>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
     <?php @include("includes/header.php");?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
         <?php @include("includes/sidebar.php");?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12">
                <div class="card">
                   <div class="card-body">
                      <form method="post" onsubmit="return checkpass();" name="changepassword">
                          <div class="form-group row">
                              <label class="col-12" for="register1-username">Current Password:</label>
                              <div class="col-12">
                                  <input type="password" class="form-control" name="currentpassword" id="currentpassword"required='true'>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-12" for="register1-email">New Password:</label>
                              <div class="col-12">
                                   <input type="password" class="form-control" name="newpassword"  class="form-control"  required="true">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-12" for="register1-password">Confirm Password:</label>
                              <div class="col-12">
                                  <input type="password" class="form-control"  name="confirmpassword" id="confirmpassword"  required='true'>
                              </div>
                          </div>
                        
                          <div class="form-group row">
                              <div class="col-12">
                                  <button type="submit" class="btn btn-primary" name="submit">
                                      <i class="fa fa-plus "></i> Change
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <?php @include("includes/footer.php");?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
   <?php @include("includes/foot.php");?>
  </body>
</html>
<?php }  ?>