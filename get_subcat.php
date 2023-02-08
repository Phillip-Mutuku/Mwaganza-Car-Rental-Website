<?php
include('includes/dbconnection.php');
if(!empty($_POST["cat_id"])) 
{
$id=intval($_POST['cat_id']);
$sql="SELECT * from  expensename WHERE categoryname='$id'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
?>
<option value="">Select expense name</option>
<?php
if($query->rowCount() > 0)
{
foreach($results as $row)
{  ?> 
<option value="<?php  echo $row->expensename;?>"><?php  echo $row->expensename;?></option>
<?php
 }
}
}
?>