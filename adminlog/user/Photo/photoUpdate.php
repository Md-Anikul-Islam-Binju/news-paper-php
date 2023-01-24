<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Create Gallery - Update</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;

echo $jsCkEditorFull;
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#frmUpdate").validate();
});
</script>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">

<div class="DContent">

	<?php $iUpdateID=$_REQUEST["updateid"];
	$qUpdate="SELECT * FROM p_photo WHERE PhotoID=".$iUpdateID;
	$resultUpdate=mysqli_query($connEMM, $qUpdate);
	$rsUpdate=mysqli_fetch_assoc($resultUpdate);

	$resultAlbum=mysqli_query($connEMM, "SELECT AlbumID, AlbumName FROM p_album WHERE Deletable=1 ORDER BY AlbumID DESC LIMIT 10") or die(mysqli_error($connEMM));
	//$resultCategory=mysqli_query($connEMM, "SELECT CategoryID, CategoryName FROM bn_bas_category ORDER BY CategoryName") or die(mysqli_error($connEMM));
	//$resultSubCategory=mysqli_query($connEMM, "SELECT SubCategoryID, SubCategoryName FROM bn_bas_subcategory WHERE CategoryID=$iCategoryID");
	//$resultSpecCat=mysqli_query($connEMM, "SELECT SpecialCategoryID, SpecialCategoryName FROM bn_bas_specialcategory") or die(mysqli_error($connEMM)); ?>
	<form name="frmUpdate" id="frmUpdate" action="photoUpdateAction.php?updateid=<?php echo $iUpdateID; ?>" enctype="multipart/form-data" method="post">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><th colspan="2">Create Gallery - Update</th></tr>
	<tr>
		<td align="right" valign="middle">Album:</td>
		<td align="left" valign="middle">
			<select name="cboAlbum" class="selBN">
			<?php while($rsAlbum=mysqli_fetch_assoc($resultAlbum)){ ?>
				<option value="<?php echo $rsAlbum["AlbumID"]; ?>" <?php if($rsAlbum["AlbumID"]==$rsUpdate["AlbumID"]){echo "selected";} ?> ><?php echo $rsAlbum["AlbumName"]; ?></option>
			<?php }mysqli_free_result($resultAlbum); ?>
			</select>
		</td>
	</tr>
	<!-- tr>
		<td align="right" valign="top">Type of Content:</td>
		<td align="left" valign="top">
			<div class="DFloating1">
			<select name="cboCategory" id="cboCategory" class="selBN">
			<?php /*while($rsCategory=mysqli_fetch_assoc($resultCategory)){ ?>
				<option value="<?php echo $rsCategory["CategoryID"]; ?>" <?php if($rsCategory["CategoryID"]==$rsUpdate["CategoryID"]){echo "selected='selected'";} ?>><?php echo $rsCategory["CategoryName"]; ?></option>
			<?php }mysqli_free_result($resultCategory);*/ ?>
			</select>
			</div>
		</td>
	</tr -->
	<tr>
		<td align="right" valign="top">Caption:</td>
		<td align="left" valign="middle"><textarea id="txtCaption" name="txtCaption" class="txtBN1" autofocus><?php echo $rsUpdate["Caption"]; ?></textarea></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Image:<?php echo $sMsgImgGallery; ?></td>
		<td align="left" valign="middle">
			<?php echo $rsUpdate["ImagePath"]; ?><br>
			<?php if($rsUpdate["ImagePath"]!=""){?><img src="<?php echo $sSiteURL; ?>media/PhotoGallery/<?php echo $rsUpdate["ImagePath"]; ?>"><br><?php } ?>
			<input type="file" name="txtImageSMPath"> (jpg, jpeg, jpe, gif, png, bmp)
		</td>
	</tr>
	<tr><td align="left" valign="top" colspan="2">
		Show At Home:
		<input type="radio" name="rdoShowAtHome" value="1" <?php if($rsUpdate["ShowAtHome"]==1){echo "checked='checked'";} ?>>Show
		<input type="radio" name="rdoShowAtHome" value="2" <?php if($rsUpdate["ShowAtHome"]==2){echo "checked='checked'";} ?>>Don't Show &nbsp;&nbsp;&nbsp;&nbsp;
	</td></tr>
	<tr><td colspan="2" align="center" valign="middle"><input type="submit" name="btnSubmit" value="Update" class="inpSubmit"></td></tr>
	</table>
	</form>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
<script type="text/javascript">
CKEDITOR.replace('txtCaption');
</script>
</body>
</html>