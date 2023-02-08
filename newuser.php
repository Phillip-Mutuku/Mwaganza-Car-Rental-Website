<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
  $sectorname=$_POST['sectorname'];
  $sectordes=$_POST['sectordes'];
  $sql="insert into tblservice(ServiceName,SerDes)values(:sectorname,:sectordes)";
  $query=$dbh->prepare($sql);
  $query->bindParam(':sectorname',$sectorname,PDO::PARAM_STR);
  $query->bindParam(':sectordes',$sectordes,PDO::PARAM_STR);
  $query->execute();
  $LastInsertId=$dbh->lastInsertId();
  if ($LastInsertId>0) {
    echo '<script>alert("Sector has been added.")</script>';
    echo "<script>window.location.href ='newsector.php'</script>";
    }
  else
    {
     echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
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
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Sector Form </h4>
                    <form class="forms-sample" method="post">
                      <div class="form-group">
                        <label for="exampleInputName1">Sector Name</label>
                        <input type="text" name="sectorname" class="form-control" id="sectorname" placeholder="Sector Name" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Sector Description</label>
                        <textarea class="form-control" name="sectordes" id="sectordes" rows="4" required></textarea>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary btn-fw mr-2">Submit</button>
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