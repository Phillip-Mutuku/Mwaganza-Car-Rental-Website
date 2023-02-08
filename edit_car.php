<?php
include('includes/checklogin.php');
check_login();

if(isset($_POST['save']))
{
  $vehicletitle=$_POST['car'];
  $brand=$_POST['brand'];
  $vehicleoverview=$_POST['description'];
  $priceperday=$_POST['priceperday'];
  $fueltype=$_POST['fueltype'];
  $modelyear=$_POST['modelyear'];
  $seatingcapacity=$_POST['seatingcapacity'];
  $airconditioner=$_POST['airconditioner'];
  $powerdoorlocks=$_POST['powerdoorlocks'];
  $antilockbrakingsys=$_POST['antilockbrakingsys'];
  $brakeassist=$_POST['brakeassist'];
  $powersteering=$_POST['powersteering'];
  $driverairbag=$_POST['driverairbag'];
  $passengerairbag=$_POST['passengerairbag'];
  $powerwindow=$_POST['powerwindow'];
  $cdplayer=$_POST['cdplayer'];
  $centrallocking=$_POST['centrallocking'];
  $crashcensor=$_POST['crashcensor'];
  $leatherseats=$_POST['leatherseats'];
  $id=intval($_GET['id']);

  $sql="update tblvehicles set VehiclesTitle=:vehicletitle,VehiclesBrand=:brand,VehiclesOverview=:vehicleoverview,PricePerDay=:priceperday,FuelType=:fueltype,ModelYear=:modelyear,SeatingCapacity=:seatingcapacity,AirConditioner=:airconditioner,PowerDoorLocks=:powerdoorlocks,AntiLockBrakingSystem=:antilockbrakingsys,BrakeAssist=:brakeassist,PowerSteering=:powersteering,DriverAirbag=:driverairbag,PassengerAirbag=:passengerairbag,PowerWindows=:powerwindow,CDPlayer=:cdplayer,CentralLocking=:centrallocking,CrashSensor=:crashcensor,LeatherSeats=:leatherseats where id=:id ";
  $query = $dbh->prepare($sql);
  $query->bindParam(':vehicletitle',$vehicletitle,PDO::PARAM_STR);
  $query->bindParam(':brand',$brand,PDO::PARAM_STR);
  $query->bindParam(':vehicleoverview',$vehicleoverview,PDO::PARAM_STR);
  $query->bindParam(':priceperday',$priceperday,PDO::PARAM_STR);
  $query->bindParam(':fueltype',$fueltype,PDO::PARAM_STR);
  $query->bindParam(':modelyear',$modelyear,PDO::PARAM_STR);
  $query->bindParam(':seatingcapacity',$seatingcapacity,PDO::PARAM_STR);
  $query->bindParam(':airconditioner',$airconditioner,PDO::PARAM_STR);
  $query->bindParam(':powerdoorlocks',$powerdoorlocks,PDO::PARAM_STR);
  $query->bindParam(':antilockbrakingsys',$antilockbrakingsys,PDO::PARAM_STR);
  $query->bindParam(':brakeassist',$brakeassist,PDO::PARAM_STR);
  $query->bindParam(':powersteering',$powersteering,PDO::PARAM_STR);
  $query->bindParam(':driverairbag',$driverairbag,PDO::PARAM_STR);
  $query->bindParam(':passengerairbag',$passengerairbag,PDO::PARAM_STR);
  $query->bindParam(':powerwindow',$powerwindow,PDO::PARAM_STR);
  $query->bindParam(':cdplayer',$cdplayer,PDO::PARAM_STR);
  $query->bindParam(':centrallocking',$centrallocking,PDO::PARAM_STR);
  $query->bindParam(':crashcensor',$crashcensor,PDO::PARAM_STR);
  $query->bindParam(':leatherseats',$leatherseats,PDO::PARAM_STR);
  $query->bindParam(':id',$id,PDO::PARAM_STR);
  $query->execute();

  $msg="Data updated successfully";
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
          <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class=" col -md-12 card">
              <div class="modal-header">
                <h5 class="modal-title" style="float: left;">Edit car</h5>
              </div>
              <?php 
              if($msg){
                ?>
                <div class="succWrap">
                  <strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> 
                </div>
                <?php 
              } ?>
              <?php 
              $id=intval($_GET['id']);
              $sql ="SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:id";
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
                  <div class="col-md-12 mt-4">
                    <div class="row ">
                      <div class="form-group col-md-6 ">
                        <label for="exampleInputPassword1">Select Brand<span style="color:red">*</span></label>
                        <select  name="brand"  class="form-control" required>
                          <option value="<?php echo htmlentities($result->bid);?>"><?php echo htmlentities($bdname=$result->BrandName); ?> </option>
                          <?php
                          $sql="SELECT * from  tblbrands";
                          $query = $dbh -> prepare($sql);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          if($query->rowCount() > 0)
                          {
                            foreach($results as $row)
                            {
                              ?> 
                              <option value="<?php  echo $row->id;?>"><?php  echo $row->BrandName;?></option>
                              <?php 
                            }
                          } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Car Title<span style="color:red">*</span></label>
                        <input type="text" name="car" class="form-control"  value="<?php echo htmlentities($result->VehiclesTitle)?>"  id="product" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-12">
                        <label for="exampleInputName1">Car Description<span style="color:red">*</label>
                         <textarea class="form-control" style=" font-family: fontawesome;
                         font-size: 17px; line-height: 25px;" name="description" rows="6" required><?php echo htmlentities($result->VehiclesOverview);?></textarea>
                       </div>
                     </div>
                     <div class="row">
                      <div class="form-group col-md-3">
                        <label for="exampleInputName1">Price Per Day(in USD)<span style="color:red">*</label>
                          <input type="text" name="priceperday" value="<?php echo htmlentities($result->PricePerDay);?>" class="form-control" id="price"required>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="exampleInputName1">Model Year<span style="color:red">*</label>
                            <input type="text" name="modelyear" value="<?php echo htmlentities($result->ModelYear);?>"   class="form-control" id="price"required>
                          </div>
                          <div class="form-group col-md-3">
                            <label for="exampleInputName1">Seating Capacity<span style="color:red">*</span></label>
                            <input type="text" name="seatingcapacity" value="<?php echo htmlentities($result->SeatingCapacity);?>" class="form-control" id="price"required>
                          </div>
                          <div class="form-group col-md-3">
                            <label for="exampleInputName1">Select Fuel Type<span style="color:red">*</label>
                              <select class="form-control" name="fueltype" required>
                                <option value="<?php echo htmlentities($result->FuelType);?>"> <?php echo htmlentities($result->FuelType);?> </option>
                                <option value="Petrol">Petrol</option>
                                <option value="Diesel">Diesel</option>
                                <option value="CNG">CNG</option>
                              </select>
                            </div>
                          </div>
                          <div class="row ">
                            <div class="form-group col-md-4 pl-md-0">
                              <label class="col-sm-12 pl-0 pr-0 ">Car image1 </label>
                              <div class="col-sm-12 pl-0 pr-0">
                               <img src="img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" width="300" height="200" style="border:solid 1px #000">
                               <a href="changeimage1.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 1</a>
                             </div>
                           </div> 
                           <div class="form-group col-md-4 pl-md-0">
                            <label class="col-sm-12 pl-0 pr-0 ">Car image2 </label>
                            <div class="col-sm-12 pl-0 pr-0">
                              <img src="img/vehicleimages/<?php echo htmlentities($result->Vimage2);?>" width="300" height="200" style="border:solid 1px #000">
                              <a href="changeimage2.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 2</a>
                            </div>
                          </div> 
                          <div class="form-group col-md-4 pl-md-0">
                            <label class="col-sm-12 pl-0 pr-0 ">Car image3 </label>
                            <div class="col-sm-12 pl-0 pr-0">
                             <img src="img/vehicleimages/<?php echo htmlentities($result->Vimage3);?>" width="300" height="200" style="border:solid 1px #000">
                             <a href="changeimage3.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 3</a>
                           </div>
                         </div> 
                       </div>
                       <div class="row ">
                         <div class="form-group col-md-4 pl-md-0">
                          <label class="col-sm-12 pl-0 pr-0 ">Car image4 </label>
                          <div class="col-sm-12 pl-0 pr-0">
                            <img src="img/vehicleimages/<?php echo htmlentities($result->Vimage4);?>" width="300" height="200" style="border:solid 1px #000">
                            <a href="changeimage4.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 4</a>
                          </div>
                        </div> 
                        <div class="form-group col-md-4 pl-md-0">
                          <label class="col-sm-12 pl-0 pr-0 ">Car image5</label>
                          <div class="col-sm-12 pl-0 pr-0">
                            <?php if($result->Vimage5=="")
                            {
                              echo htmlentities("File not available");
                            } else {?>
                              <img src="img/vehicleimages/<?php echo htmlentities($result->Vimage5);?>" width="300" height="200" style="border:solid 1px #000">
                              <a href="changeimage5.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 5</a>
                              <?php 
                            } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="">&nbsp;</div>
                  <div class=" col -md-12 card">
                    <div class="modal-header">
                      <h5 class="modal-title" style="float: left;">Accessories</h5>
                    </div>
                    <div class="col-md-12 mt-4">

                      <div class="row ">
                        <div class="form-group col-md-3">
                         <?php if($result->AirConditioner==1)
                         {
                           ?>
                           <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="airconditioner" checked value="1">
                            <label for="inlineCheckbox1"> Air Conditioner </label>
                          </div>
                          <?php
                        } else { ?>
                          <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="airconditioner" value="1">
                            <label for="inlineCheckbox1"> Air Conditioner </label>
                          </div>
                          <?php 
                        } ?>
                      </div>
                      <div class="form-group col-md-3">
                        <?php if($result->PowerDoorLocks==1)
                        {
                          ?>
                          <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="powerdoorlocks" checked value="1">
                            <label for="inlineCheckbox2"> Power Door Locks </label>
                          </div>
                          <?php 
                        } else {?>
                          <div class="checkbox checkbox-success checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="powerdoorlocks" value="1">
                            <label for="inlineCheckbox2"> Power Door Locks </label>
                          </div>
                          <?php 
                        }?>
                      </div>
                      <div class="form-group col-md-3">
                        <?php if($result->AntiLockBrakingSystem==1)
                        {
                          ?>
                          <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="antilockbrakingsys" checked value="1">
                            <label for="inlineCheckbox3"> AntiLock Braking System </label>
                          </div>
                          <?php 
                        } else {?>
                          <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="antilockbrakingsys" value="1">
                            <label for="inlineCheckbox3"> AntiLock Braking System </label>
                          </div>
                          <?php 
                        } ?>
                      </div>
                      <div class="form-group col-md-3">
                        <?php if($result->BrakeAssist==1)
                        {
                          ?>
                          <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="brakeassist" checked value="1">
                            <label for="inlineCheckbox3"> Brake Assist </label>
                          </div>
                          <?php
                        } else {?>
                          <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="brakeassist" value="1">
                            <label  for="inlineCheckbox3"> Brake Assist </label>
                          </div>
                          <?php
                        } ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-3">
                        <?php if($result->PowerSteering==1)
                        {
                          ?>
                          <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="powersteering" checked value="1">
                            <label for="inlineCheckbox1"> Power Steering </label>
                          </div>
                          <?php 
                        } else {
                          ?>
                          <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="powersteering" value="1">
                            <label for="inlineCheckbox1"> Power Steering </label>
                          </div>
                          <?php
                        } ?>
                      </div>
                      <div class="form-group col-md-3">
                        <?php if($result->DriverAirbag==1)
                        {
                          ?>
                          <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="driverairbag" checked value="1">
                            <label for="inlineCheckbox2">Driver Airbag</label>
                          </div>
                          <?php
                        } else { ?>
                          <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="driverairbag" value="1">
                            <label for="inlineCheckbox2">Driver Airbag</label>
                          </div>
                          <?php 
                        } ?>
                      </div>
                      <div class="form-group col-md-3">
                        <?php if($result->DriverAirbag==1)
                        {
                          ?>
                          <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="passengerairbag" checked value="1">
                            <label for="inlineCheckbox3"> Passenger Airbag </label>
                          </div>
                          <?php 
                        } else { ?>
                          <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="passengerairbag" value="1">
                            <label for="inlineCheckbox3"> Passenger Airbag </label>
                          </div>
                          <?php 
                        } ?>
                      </div>
                      <div class="form-group col-md-3">
                       <?php if($result->PowerWindows==1)
                       {
                        ?>
                        <div class="checkbox checkbox-inline">
                          <input type="checkbox" id="inlineCheckbox1" name="powerwindow" checked value="1">
                          <label for="inlineCheckbox3"> Power Windows </label>
                        </div>
                        <?php 
                      } else { ?>
                        <div class="checkbox checkbox-inline">
                          <input type="checkbox" id="inlineCheckbox1" name="powerwindow" value="1">
                          <label for="inlineCheckbox3"> Power Windows </label>
                        </div>
                        <?php
                      } ?>
                    </div>

                  </div>
                  <div class="row ">
                    <div class="form-group col-md-3">
                     <?php if($result->CDPlayer==1)
                     {
                      ?>
                      <div class="checkbox checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" name="cdplayer" checked value="1">
                        <label for="inlineCheckbox1"> CD Player </label>
                      </div>
                      <?php 
                    } else {?>
                      <div class="checkbox checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" name="cdplayer" value="1">
                        <label for="inlineCheckbox1"> CD Player </label>
                      </div>
                      <?php 
                    } ?>
                  </div>
                  <div class="form-group col-md-3">
                   <?php if($result->CentralLocking==1)
                   {
                    ?>
                    <div class="checkbox  checkbox-inline">
                      <input type="checkbox" id="inlineCheckbox1" name="centrallocking" checked value="1">
                      <label for="inlineCheckbox2">Central Locking</label>
                    </div>
                    <?php 
                  } else { ?>
                    <div class="checkbox checkbox-success checkbox-inline">
                      <input type="checkbox" id="inlineCheckbox1" name="centrallocking" value="1">
                      <label for="inlineCheckbox2">Central Locking</label>
                    </div>
                    <?php 
                  } ?>
                </div>
                <div class="form-group col-md-3">
                  <?php if($result->CrashSensor==1)
                  {
                    ?>
                    <div class="checkbox checkbox-inline">
                      <input type="checkbox" id="inlineCheckbox1" name="crashcensor" checked value="1">
                      <label for="inlineCheckbox3"> Crash Sensor </label>
                    </div>
                    <?php 
                  } else {?>
                    <div class="checkbox checkbox-inline">
                      <input type="checkbox" id="inlineCheckbox1" name="crashcensor" value="1">
                      <label for="inlineCheckbox3"> Crash Sensor </label>
                    </div>
                    <?php 
                  } ?>
                </div>
                <div class="form-group col-md-3">
                  <?php if($result->LeatherSeats==1)
                  {
                    ?>
                    <div class="checkbox checkbox-inline">
                      <input type="checkbox" id="inlineCheckbox1" name="leatherseats" checked value="1">
                      <label for="inlineCheckbox3"> Leather Seats </label>
                    </div>
                  <?php } else { ?>
                    <div class="checkbox checkbox-inline">
                      <input type="checkbox" id="inlineCheckbox1" name="leatherseats" value="1">
                      <label for="inlineCheckbox3"> Leather Seats </label>
                    </div>
                    <?php 
                  } ?>
                </div>
              </div>
              <button type="submit" style="float: right;" name="save" class="btn btn-primary btn-sm  mr-2 mb-4">Save</button>
            </div>
          </div>
          <?php 
        }
      }?>
    </form>
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