<?php
include('includes/checklogin.php');
check_login();
if(isset($_GET['del']))
{
  $id=$_GET['del'];
  $sql = "delete from  tblsubscribers  WHERE id=:id";
  $query = $dbh->prepare($sql);
  $query -> bindParam(':id',$id, PDO::PARAM_STR);
  $query -> execute();
  $msg="Subscriber info deleted";
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
                  <h5 class="modal-title" style="float: left;">Manage Subscribers</h5>
                </div>
                <div class="card-body table-responsive p-3">
                  <?php 
                  if($error)
                  {
                    ?>
                    <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div>
                    <?php
                  }else if($msg)
                  {
                    ?>
                    <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
                    <?php 
                  }?>
                  <table class="table align-items-center table-bordered  table-hover" id="dataTableHover">
                    <thead>
                      <tr>
                       <th>#</th>
                       <th>Email Id</th>
                       <th>Subscription Date</th>
                       <th>Action</th>
                     </tr>
                   </thead>
                   <tbody>
                    <?php $sql = "SELECT * from tblsubscribers";
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
                        <td><?php echo htmlentities($result->SubscriberEmail);?></td>

                        <td><?php echo htmlentities($result->PostingDate);?></td>

                        <td>
                          <a href="manage_subscribers.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');"><i class="mdi mdi-delete"></i></a>
                        </td>

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
