<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Tag - Update List (Bangla)</title>
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
	<tr><td align="right" valign="middle" colspan="8"><a href="tagInsert.php">Insert</a></td></tr>
	<tr><th colspan="8">Tag - Update List (Bangla)</th></tr>
	<tr class="TrHeadings">
		<td>Serial</td>
		<td>Tag Name</td>
		<td>Active</td>
		<td class="Td50">UPDATE</td>
		<td class="Td50">DELETE</td>
	</tr>
	<?php $resultTag=mysqli_query($connEMM, "SELECT * FROM bn_tag WHERE Deletable=1 ORDER BY TagID") or die(mysqli_error($connEMM));
	while($rsTag=mysqli_fetch_assoc($resultTag)){ ?>
	<tr class="TrUpdateListSelect">
		<td align="center"><?php echo $rsTag["TagID"]; ?></td>
		<td align="left" class="tdBn"><?php echo $rsTag["TagName"]; ?></td>
		<td align="center"><?php if($rsTag["TagActive"]==1){echo "Yes";}else{echo "No";} ?></td>
		<td align="center"><a href="tagUpdate.php?updateid=<?php echo $rsTag["TagID"]; ?>">Update</a></td>
		<td align="center"><a href="tagDelete.php?deleteid=<?php echo $rsTag["TagID"]; ?>" onclick="return confirmDelete();">Delete</a></td>
	</tr>
	<?php }mysqli_free_result($resultTag); ?>
	</table>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>