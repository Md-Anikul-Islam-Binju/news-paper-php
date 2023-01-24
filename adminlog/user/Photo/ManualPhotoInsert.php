<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Manual Photo - Insert</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMMEn;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
</head>

<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

	<form name="frmInsert" method="post" action="ManualPhotoInsertAction.php" enctype="multipart/form-data">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><th colspan="2">Manual Photo - Insert</th></tr>
	<tr><td align="left" valign="middle">
	Upload Image: <input type="file" name="txtImageSMPath" required> (jpg, jpeg, jpe, gif, png, bmp)
	<input type="submit" name="btnSubmit" value="Insert" class="inpSubmit"></td></tr>
	</table>
	</form>

	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><th colspan="3">Manual Photo - Update List</th></tr>
	<tr class="TrHeadings">
		<th>Image Name & Path</th>
		<th class="Td50">UPDATE</th>
		<th class="Td50">DELETE</th>
	</tr>
	<?php $resultGallery=mysqli_query($connEMM, "SELECT MannualImageID, ImagePath FROM p_manual_photo WHERE Deletable=1 ORDER BY MannualImageID DESC LIMIT 30") or die(mysqli_error($connEMM));
	while($rsGallery=mysqli_fetch_assoc($resultGallery)){ ?>
	<tr class="TrUpdateListSelect">
		<td align="left" valign="top">
			File Name: <b><?php echo $sSiteURL; ?>media/PhotoGallery/<?php echo $rsGallery["ImagePath"]; ?></b><br>
			<img src="<?php echo $sSiteURL; ?>media/PhotoGallery/<?php echo $rsGallery["ImagePath"]; ?>">
		</td>
		<td align="center" valign="top"><a href="ManualPhotoUpdate.php?updateid=<?php echo $rsGallery["MannualImageID"]; ?>">Update</a></td>
		<td align="center" valign="top"><a href="ManualPhotoDelete.php?deleteid=<?php echo $rsGallery["MannualImageID"]; ?>">Delete</a></td>
	</tr>
	<?php }mysqli_free_result($resultGallery); ?>
	</table>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>