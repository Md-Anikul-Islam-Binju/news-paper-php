<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Advertisement Photo - Update</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMMEn;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

	<?php $iUpdateID=$_REQUEST["updateid"];
	$qUpdate="SELECT * FROM p_advt WHERE AdvtImageID=".$iUpdateID;
	$resultUpdate=mysqli_query($connEMM, $qUpdate);
	$rsUpdate=mysqli_fetch_assoc($resultUpdate);
	$iPosition=$rsUpdate["Position"];
	?>

	<form action="AdvtPhotoUpdateAction.php?updateid=<?php echo $iUpdateID; ?>" name="frmUpdate" enctype="multipart/form-data" method="post">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><td align="right" colspan="2"><a href="AdvtPhotoInsert.php">List</a></td></tr>
	<tr><th colspan="2">Advertisement Photo - Update</th></tr>
	<tr>
		<td align="left" valign="middle">Position:</td>
		<td align="left" valign="middle">
		<select name="cboPosition">
			<option value="1" <?php if($iPosition==1){echo 'selected="selected"';} ?>>Banner Top (1180px X 90px)</option>
			<option value="2" <?php if($iPosition==2){echo 'selected="selected"';} ?>>Banner (Beside Logo - 850px X 300px)</option>
		</select>
		</td>
	</tr>
	<tr>
		<td align="left" valign="middle">Caption:</td>
		<td align="left" valign="middle"><input type="text" name="txtCaption" value="<?php echo $rsUpdate["Caption"]; ?>" class="inpBN" autofocus></td>
	</tr>
	<tr>
		<td align="left" valign="middle">URL:</td>
		<td align="left" valign="middle"><input type="text" name="txtURL" value="<?php echo $rsUpdate["URL"]; ?>" class="inpBN" placeholder="http://www.companywebsite.com/"></td>
	</tr>
	<tr>
		<td align="left" valign="middle">Image:</td>
		<td align="left" valign="middle">
		<?php if($rsUpdate["ImagePath"]!=""){?><img src="<?php echo $sSiteURL; ?>media/PhotoGallery/<?php echo $rsUpdate["ImagePath"]; ?>"><br><?php } ?>
		<input type="file" name="txtImageSMPath" required> (jpg, jpeg, jpe, gif, png, bmp)
		</td>
	</tr>
	<tr><td>&nbsp;</td><td align="left" valign="middle"><input type="submit" name="btnSubmit" value="Update" class="inpSubmit"></td></tr>
	</table>
	</form>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>