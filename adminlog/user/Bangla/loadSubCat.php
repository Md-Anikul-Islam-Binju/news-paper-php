<?php session_cache_expire(30);session_start(); 
require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");
$parent_cat=$_GET['cboCategory'];
$query=mysqli_query($connEMM,"SELECT SubCategoryID, SubCategoryName FROM bn_bas_subcategory WHERE CategoryID={$parent_cat}");
echo "<option value='1'>None</option>";
while($row=mysqli_fetch_array($query)){
	echo "<option value='$row[SubCategoryID]'>$row[SubCategoryName]</option>";
} ?>