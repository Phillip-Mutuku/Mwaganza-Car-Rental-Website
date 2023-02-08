<?php
include('includes/checklogin.php');
check_login();
if(isset($_POST['save']))
{
  $vehicletitle=$_POST['cartitle'];
  $brand=$_POST['brandname'];
  $vehicleoverview=$_POST['description'];
  $priceperday=$_POST['priceperday'];
  $fueltype=$_POST['fueltype'];
  $modelyear=$_POST['modelyear'];
  $seatingcapacity=$_POST['seatingcapacity'];
  $vimage1=$_FILES["img1"]["name"];
  $vimage2=$_FILES["img2"]["name"];
  $vimage3=$_FILES["img3"]["name"];
  $vimage4=$_FILES["img4"]["name"];
  $vimage5=$_FILES["img5"]["name"];
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
  move_uploaded_file($_FILES["img1"]["tmp_name"],"img/vehicleimages/".$_FILES["img1"]["name"]);
  move_uploaded_file($_FILES["img2"]["tmp_name"],"img/vehicleimages/".$_FILES["img2"]["name"]);
  move_uploaded_file($_FILES["img3"]["tmp_name"],"img/vehicleimages/".$_FILES["img3"]["name"]);
  move_uploaded_file($_FILES["img4"]["tmp_name"],"img/vehicleimages/".$_FILES["img4"]["name"]);
  move_uploaded_file($_FILES["img5"]["tmp_name"],"img/vehicleimages/".$_FILES["img5"]["name"]);

  $sql="INSERT INTO tblvehicles(VehiclesTitle,VehiclesBrand,VehiclesOverview,PricePerDay,FuelType,ModelYear,SeatingCapacity,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5,AirConditioner,PowerDoorLocks,AntiLockBrakingSystem,BrakeAssist,PowerSteering,DriverAirbag,PassengerAirbag,PowerWindows,CDPlayer,CentralLocking,CrashSensor,LeatherSeats) VALUES(:vehicletitle,:brand,:vehicleoverview,:priceperday,:fueltype,:modelyear,:seatingcapacity,:vimage1,:vimage2,:vimage3,:vimage4,:vimage5,:airconditioner,:powerdoorlocks,:antilockbrakingsys,:brakeassist,:powersteering,:driverairbag,:passengerairbag,:powerwindow,:cdplayer,:centrallocking,:crashcensor,:leatherseats)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':vehicletitle',$vehicletitle,PDO::PARAM_STR);
  $query->bindParam(':brand',$brand,PDO::PARAM_STR);
  $query->bindParam(':vehicleoverview',$vehicleoverview,PDO::PARAM_STR);
  $query->bindParam(':priceperday',$priceperday,PDO::PARAM_STR);
  $query->bindParam(':fueltype',$fueltype,PDO::PARAM_STR);
  $query->bindParam(':modelyear',$modelyear,PDO::PARAM_STR);
  $query->bindParam(':seatingcapacity',$seatingcapacity,PDO::PARAM_STR);
  $query->bindParam(':vimage1',$vimage1,PDO::PARAM_STR);
  $query->bindParam(':vimage2',$vimage2,PDO::PARAM_STR);
  $query->bindParam(':vimage3',$vimage3,PDO::PARAM_STR);
  $query->bindParam(':vimage4',$vimage4,PDO::PARAM_STR);
  $query->bindParam(':vimage5',$vimage5,PDO::PARAM_STR);
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
  $query->execute();
  $lastInsertId = $dbh->lastInsertId();
  if($lastInsertId)
  {
    echo '<script>alert("Car posted successfuly")</script>';
  }
  else 
  {
    echo '<script>alert("update failed! try again later")</script>'; 
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
          <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class=" col -md-12 card">
              <div class="modal-header">
                <h5 class="modal-title" style="float: left;">Register car</h5>
              </div>
              <div class="col-md-12 mt-4">
                <div class="row ">
                  <div class="form-group col-md-6 ">
                    <label for="exampleInputPassword1">Select Brand<span style="color:red">*</span></label>
                    <select  name="brandname"  class="form-control" required>
                      <option value="">Select </option>
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
                    <input type="text" name="cartitle" class="form-control" value="" id="product" placeholder="Enter Car Name" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="exampleInputName1">Car Description<span style="color:red">*</label>
                     <textarea class="form-control" name="description" rows="3" required></textarea>
                   </div>
                 </div>
                 <div class="row">
                   <div class="form-group col-md-3">
                    <label for="exampleInputName1">Price Per Day(in USD)<span style="color:red">*</label>
                      <input type="text" name="priceperday" value="" placeholder="Enter Price" class="form-control" id="price"required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="exampleInputName1">Model Year<span style="color:red">*</label>
                        <input type="text" name="modelyear" value=""  class="form-control" id="price"required>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputName1">Seating Capacity<span style="color:red">*</span></label>
                        <input type="text" name="seatingcapacity" value="" class="form-control" id="price"required>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputName1">Select Fuel Type<span style="color:red">*</label>
                          <select class="form-control" name="fueltype" required>
                            <option value=""> Select </option>
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                            <option value="CNG">CNG</option>
                          </select>
                        </div>
                      </div>
                      <div class="row ">
                       <div class="form-group col-md-4 pl-md-0">
                        <label class="col-sm-12 pl-0 pr-0 ">Car image1 <span style="color:red">*</label>
                          <div class="col-sm-12 pl-0 pr-0">
                            <input type="file" name="img1" class="file-upload-default">
                            <div class="input-group ">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" style="" type="button">Upload</button>
                              </span>
                            </div>
                          </div>
                        </div> 
                        <div class="form-group col-md-4 pl-md-0">
                          <label class="col-sm-12 pl-0 pr-0 ">Car image2 <span style="color:red">*</label>
                            <div class="col-sm-12 pl-0 pr-0">
                              <input type="file" name="img2" class="file-upload-default">
                              <div class="input-group ">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                  <button class="file-upload-browse btn btn-gradient-primary" style="" type="button">Upload</button>
                                </span>
                              </div>
                            </div>
                          </div> 
                          <div class="form-group col-md-4 pl-md-0">
                            <label class="col-sm-12 pl-0 pr-0 ">Car image3 <span style="color:red">*</label>
                              <div class="col-sm-12 pl-0 pr-0">
                                <input type="file" name="img3" class="file-upload-default">
                                <div class="input-group ">
                                  <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" style="" type="button">Upload</button>
                                  </span>
                                </div>
                              </div>
                            </div> 
                          </div>
                          <div class="row ">
                           <div class="form-group col-md-4 pl-md-0">
                            <label class="col-sm-12 pl-0 pr-0 ">Car image4 <span style="color:red">*</label>
                              <div class="col-sm-12 pl-0 pr-0">
                                <input type="file" name="img4" class="file-upload-default">
                                <div class="input-group ">
                                  <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" style="" type="button">Upload</button>
                                  </span>
                                </div>
                              </div>
                            </div> 
                            <div class="form-group col-md-4 pl-md-0">
                              <label class="col-sm-12 pl-0 pr-0 ">Car image5</label>
                              <div class="col-sm-12 pl-0 pr-0">
                                <input type="file" name="img5" class="file-upload-default">
                                <div class="input-group ">
                                  <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" style="" type="button">Upload</button>
                                  </span>
                                </div>
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
                              <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="airconditioner" name="airconditioner" value="1">
                                <label for="airconditioner"> Air Conditioner </label>
                              </div>
                            </div>
                            <div class="form-group col-md-3">
                              <div class="checkbox checkbox-inline">
                               <input type="checkbox" id="powerdoorlocks" name="powerdoorlocks" value="1">
                               <label for="powerdoorlocks"> Power Door Locks </label>
                             </div>
                           </div>
                           <div class="form-group col-md-3">
                            <div class="checkbox checkbox-inline">
                             <input type="checkbox" id="antilockbrakingsys" name="antilockbrakingsys" value="1">
                             <label for="antilockbrakingsys"> AntiLock Braking System </label>
                           </div>
                         </div>
                         <div class="form-group col-md-3">
                          <div class="checkbox checkbox-inline">
                           <input type="checkbox" id="brakeassist" name="brakeassist" value="1">
                           <label for="brakeassist"> Brake Assist </label>
                         </div>
                       </div>
                     </div>
                     <div class="row">
                      <div class="form-group col-md-3">
                        <div class="checkbox checkbox-inline">
                          <input type="checkbox" id="powersteering" name="powersteering" value="1">
                          <label for="inlineCheckbox5"> Power Steering </label>
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <div class="checkbox checkbox-inline">
                          <input type="checkbox" id="driverairbag" name="driverairbag" value="1">
                          <label for="driverairbag">Driver Airbag</label>
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <div class="checkbox checkbox-inline">
                          <input type="checkbox" id="passengerairbag" name="passengerairbag" value="1">
                          <label for="passengerairbag"> Passenger Airbag </label>
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <div class="checkbox checkbox-inline">
                         <input type="checkbox" id="powerwindow" name="powerwindow" value="1">
                         <label for="powerwindow"> Power Windows </label>
                       </div>
                     </div>

                   </div>
                   <div class="row ">
                    <div class="form-group col-md-3">
                      <div class="checkbox checkbox-inline">
                        <input type="checkbox" id="cdplayer" name="cdplayer" value="1">
                        <label for="cdplayer"> CD Player </label>
                      </div>
                    </div>
                    <div class="form-group col-md-3">
                      <div class="checkbox checkbox-inline">
                        <input type="checkbox" id="centrallocking" name="centrallocking" value="1">
                        <label for="centrallocking">Central Locking</label>
                      </div>
                    </div>
                    <div class="form-group col-md-3">
                      <div class="checkbox checkbox-inline">
                        <input type="checkbox" id="crashcensor" name="crashcensor" value="1">
                        <label for="crashcensor"> Crash Sensor </label>
                      </div>
                    </div>
                    <div class="form-group col-md-3">
                      <div class="checkbox checkbox-inline">
                       <input type="checkbox" id="leatherseats" name="leatherseats" value="1">
                       <label for="leatherseats"> Leather Seats </label>
                     </div>
                   </div>
                 </div>
                 <button type="submit" style="float: right;" name="save" class="btn btn-primary  mr-2 mb-4">Save</button>
               </div>
             </div>
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