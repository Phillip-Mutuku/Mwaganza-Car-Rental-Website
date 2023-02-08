<?php
include('includes/checklogin.php');
check_login();
if(isset($_GET['delid']))
{
  $rid=intval($_GET['delid']);
  $sql="update tbladmin set Status='0' where ID='$rid'";
  $query=$dbh->prepare($sql);
  $query->bindParam(':rid',$rid,PDO::PARAM_STR);
  $query->execute();
  echo "<script>alert('User blocked');</script>"; 
  echo "<script>window.location.href = 'userregister.php'</script>";
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
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="modal-header">
                  <h5 class="modal-title" style="float: left;">Registered Customers</h5>
                </div>
               <div class="card-body table-responsive p-3">
                <table class="table align-items-center table-bordered  table-hover" id="dataTableHover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th> Name</th>
                      <th>Email </th>
                      <th>Contact no</th>
                      <th>DOB</th>
                      <th>Address</th>
                      <th>City</th>
                      <th>Country</th>
                      <th>Reg Date</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php $sql = "SELECT * from  tblusers ";
                   $query = $dbh -> prepare($sql);
                   $query->execute();
                   $results=$query->fetchAll(PDO::FETCH_OBJ);
                   $cnt=1;
                   if($query->rowCount() > 0)
                   {
                    foreach($results as $result)
                    {  
                      ?>  
                      <tr>
                        <td><?php echo htmlentities($cnt);?></td>
                        <td><?php echo htmlentities($result->FullName);?></td>
                        <td><?php echo htmlentities($result->EmailId);?></td>
                        <td><?php echo htmlentities($result->ContactNo);?></td>
                        <td><?php echo htmlentities($result->dob);?></td>
                        <td><?php echo htmlentities($result->Address);?></td>
                        <td><?php echo htmlentities($result->City);?></td>
                        <td><?php echo htmlentities($result->Country);?></td>
                        <td><?php echo htmlentities($result->RegDate);?></td>
                      </tr>
                      <?php
                      $cnt=$cnt+1;
                    }
                  } ?>
                </tbody>
              </table>
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
<!-- End custom js for this page -->
</body>
</html>
