<?php
include('includes/checklogin.php');
check_login();
include('includes/config.php');
if(isset($_POST['update']))
{
  $vimage1=$_FILES["img1"]["name"];
  $id=intval($_GET['imgid']);
  move_uploaded_file($_FILES["img1"]["tmp_name"],"img/vehicleimages/".$_FILES["img1"]["name"]);
  $sql="update tblvehicles set Vimage1=:vimage1 where id=:id";
  $query = $dbh->prepare($sql);
  $query->bindParam(':vimage1',$vimage1,PDO::PARAM_STR);
  $query->bindParam(':id',$id,PDO::PARAM_STR);
  $query->execute();

  $msg="Image updated successfully";
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
            <div class="col-md-10">
              <div class="panel panel-default">
                <div class="panel-body">
                  <form method="post" class="form-horizontal" enctype="multipart/form-data">


                    <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                    else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>



                    <div class="form-group">
                      <label class="col-sm-4 control-label">Current Image1</label>
                      <?php 
                      $id=intval($_GET['imgid']);
                      $sql ="SELECT Vimage1 from tblvehicles where tblvehicles.id=:id";
                      $query = $dbh -> prepare($sql);
                      $query-> bindParam(':id', $id, PDO::PARAM_STR);
                      $query->execute();
                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                      $cnt=1;
                      if($query->rowCount() > 0)
                      {
                        foreach($results as $result)
                        { 
                          ?>
                          <div class="col-sm-8">
                            <img src="img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" width="300" height="200" style="border:solid 1px #000">
                          </div>
                          <?php
                        }
                      }?>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-4 control-label">Upload New Image 1<span style="color:red">*</span></label>
                      <div class="col-sm-8">
                        <input type="file" name="img1" required>
                      </div>
                    </div>
                    <div class="hr-dashed"></div>
                    <div class="form-group">
                      <div class="col-sm-8 col-sm-offset-4">

                        <button class="btn btn-primary" name="update" type="submit">Update</button>
                      </div>
                    </div>

                  </form>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
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