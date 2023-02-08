<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['insert']))
{
    $eib= $_SESSION['editbid'];
    $brand=$_POST['brand'];
    $update=date('Y/m/d');
    $sql4="update tblbrands set BrandName=:brand,UpdationDate=:update where id=:eib";
    $query=$dbh->prepare($sql4);
    $query->bindParam(':brand',$brand,PDO::PARAM_STR);
    $query->bindParam(':update',$update,PDO::PARAM_STR);
    $query->bindParam(':eib',$eib,PDO::PARAM_STR);
    $query->execute();
    if ($query->execute())
    {
        echo '<script>alert("updated successfuly")</script>';
    }else{
        echo '<script>alert("update failed! try again later")</script>';
    }
}
?>
<div class="card-body">
    <?php
    $eid=$_POST['edit_id4'];
    $sql2="SELECT * from tblbrands  where tblbrands.id=:eid";
    $query2 = $dbh -> prepare($sql2);
    $query2-> bindParam(':eid', $eid, PDO::PARAM_STR);
    $query2->execute();
    $results=$query2->fetchAll(PDO::FETCH_OBJ);
    if($query2->rowCount() > 0)
    {
        foreach($results as $row)
        {
            $_SESSION['editbid']=$row->id;
            ?>
            <form class="form-sample"  method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-sm-12 pl-0 pr-0">Brand Name</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="brand" id="brand" class="form-control" value="<?php  echo $row->BrandName;?>" required />
                        </div>
                    </div>
                </div>
                <button type="submit" name="insert" class="btn btn-primary btn-sm " style="float: left;">Update</button>
            </form>
            <?php 
        }
    } ?>
</div>