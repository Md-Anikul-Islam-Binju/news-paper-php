<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Advertisement Photo - Insert</title>
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

	<form name="frmInsert" method="post" action="AdvtPhotoInsertAction.php" enctype="multipart/form-data">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><th colspan="2">Advertisement Photo - Insert</th></tr>
	<tr>
		<td align="left" valign="middle">Position:</td>
		<td align="left" valign="middle">
		<select name="cboPosition">
			<option value="1">Banner Top (1180px X 90px)</option>
			<option value="2">Banner (Beside Logo - 850px X 300px)</option>
			<!--option value="3">Binodon (330px X 130px)</option-->
		</select>
		</td>
	</tr>
	<tr>
		<td align="left" valign="middle">Caption:</td>
		<td align="left" valign="middle"><input type="text" name="txtCaption" value="" class="inpBN" placeholder="name of company/person" autofocus></td>
	</tr>
	<tr>
		<td align="left" valign="middle">URL:</td>
		<td align="left" valign="middle"><input type="text" name="txtURL" value="" class="inpBN" placeholder="http://www.companywebsite.com/"></td>
	</tr>
	<tr>
		<td align="left" valign="middle">Image:</td>
		<td align="left" valign="middle"><input type="file" name="txtImageSMPath" required> (jpg, jpeg, jpe, gif, png, bmp)</td>
	</tr>
	<tr><td>&nbsp;</td><td align="left" valign="middle"><input type="submit" name="btnSubmit" value="Insert" class="inpSubmit"></td></tr>
	</table>
	</form>


	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><th colspan="6">Advertisement Photo - Update List <span style="float:right;"><a href="AdvtPhotoUpdateListD.php">Deleted Advt</a></span></th></tr>
	<tr class="TrHeadings">
		<th>Position & Caption</th>
		<th>URL</th>
		<th>Image Name & Path</th>
		<th class="Td50">Status</th>
		<th class="Td50">Action</th>
	</tr>
	<?php $resultGallery=mysqli_query($connEMM, "SELECT * FROM p_advt ORDER BY AdvtImageID DESC LIMIT 7") or die(mysqli_error($connEMM));
	while($rsGallery=mysqli_fetch_assoc($resultGallery)){ ?>
	<tr class="TrUpdateListSelect">
		<td align="left" valign="top">
		<b><?php $iPosition=$rsGallery["Position"];
		if($iPosition==1){
			echo "Banner Top (1180X90)";
		}elseif($iPosition==2){
			echo "Banner (Beside Logo - 850px X 300px)";
		} ?></b>
		</td>
		<td align="left" valign="top"><?php echo $rsGallery["Caption"]; ?></td>
		<td align="left" valign="top">
			File Name: <?php echo $rsGallery["ImagePath"]; ?><br>
			<img src="<?php echo $sSiteURL; ?>media/PhotoGallery/<?php echo $rsGallery["ImagePath"]; ?>" style="max-width:700px;">
		</td>
		<td align="left" valign="top"><?php if($rsGallery["Deletable"]==1){echo "Show";}else{echo "Hide";} ?></td>
		<td align="center" valign="top">
			<a href="AdvtPhotoUpdate.php?updateid=<?php echo $rsGallery["AdvtImageID"]; ?>">Update</a><br>
			<?php if($rsGallery["Deletable"]==1){ ?>
				<a href="AdvtPhotoDelete.php?deleteid=<?php echo $rsGallery["AdvtImageID"]; ?>">Hide</a>
			<?php }else{ ?>
				<a href="AdvtPhotoDeleteA.php?deleteid=<?php echo $rsGallery["AdvtImageID"]; ?>">Show</a>
			<?php } ?>
		</td>
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