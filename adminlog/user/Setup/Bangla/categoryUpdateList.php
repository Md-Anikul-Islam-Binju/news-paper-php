<?php ob_start();session_cache_expire(30);session_start();require_once("../../common/mysqli_conneCT.php");require_once("../../common/config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Category - Update List (Bangla)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<script type="text/javascript">function confirmDelete(){return confirm("Are you sure you wish to delete this entry?");}</script>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><td align="right" valign="middle" colspan="8"><a href="categoryInsert.php">Insert</a></td></tr>
	<tr><th colspan="8">Category - Update List (Bangla)</th></tr>
	<tr class="TrHeadings">
		<td>Serial</td>
		<td>Category Name</td>
		<td>SLUG</td>
		<td>Remarks</td>
		<td>Priority & Show</td>
		<td>Image</td>
		<td class="Td50">UPDATE</td>
		<td class="Td50">DELETE</td>
	</tr>
	<?php $resultCategory=mysqli_query($connEMM, "SELECT * FROM bn_bas_category WHERE Deletable=1 ORDER BY CategoryID") or die(mysqli_error($connEMM));
	while($rsCategory=mysqli_fetch_assoc($resultCategory)){ ?>
	<tr class="TrUpdateListSelect">
		<td align="center"><?php echo $rsCategory["CategoryID"]; ?></td>
		<td align="left" class="tdBn"><?php echo $rsCategory["CategoryName"]; ?></td>
		<td align="left" class="tdBn"><?php echo $rsCategory["Slug"]; ?></td>
		<td align="left" class="tdBn"><?php echo $rsCategory["Remarks"]; ?></td>
		<td align="center">
		<?php echo $rsCategory["Priority"]; ?> &nbsp;
		<?php if($rsCategory["ShowData"]==1){echo "Show";}else{echo "Hide";} ?>
		</td>
		<td align="left"><?php if($rsCategory["ImagePathIcon"]!=""){ ?><img src="<?php echo $sSiteURL; ?>media/category/<?php echo $rsCategory["ImagePathIcon"]; ?>"><?php } ?></td>
		<td align="center"><a href="categoryUpdate.php?updateid=<?php echo $rsCategory["CategoryID"]; ?>">Update</a></td>
		<td align="center"><a href="categoryDelete.php?deleteid=<?php echo $rsCategory["CategoryID"]; ?>" onclick="return confirmDelete();">Delete</a></td>
	</tr>
	<?php }mysqli_free_result($resultCategory); ?>
	</table>
</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>