<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Manage Album - Update</title>
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
<script language="javascript">
function setfocus(){document.frmUpdate.txtAlbumName.focus();}
$(document).ready(function(){$("#frmUpdate").validate();});
</script>
</head>
<body onload="setfocus();">
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

	<?php $iUpdateID=$_REQUEST["updateid"];
	$qUpdate="SELECT * FROM p_album WHERE AlbumID=".$iUpdateID;
	$resultUpdate=mysqli_query($connEMM, $qUpdate);
	$rsUpdate=mysqli_fetch_assoc($resultUpdate); ?>
	<form name="frmUpdate" id="frmUpdate" action="albumUpdateAction.php?updateid=<?php echo $iUpdateID; ?>" enctype="multipart/form-data" method="post">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><th colspan="2">Manage Album - Update</th></tr>
	<tr>
		<td align="right" valign="middle">Album Type:</td>
		<td align="left" valign="middle">
			<select name="cboAlbumType">
				<option value="1" <?php if($rsUpdate["AlbumType"]==1) echo "selected='selected'"; ?>>Daily Gallery</option>
				<option value="2" <?php if($rsUpdate["AlbumType"]==2) echo "selected='selected'"; ?>>Photo Album</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right" valign="middle">Album Name:</td>
		<td align="left" valign="middle"><input type="text" name="txtAlbumName" id="txtAlbumName" class="required inpBN" value="<?php echo $rsUpdate["AlbumName"]; ?>" required autofocus></td>
	</tr>
	<tr>
		<td align="right" valign="top">Album Description:</td>
		<td align="left" valign="middle"><textarea name="txtAlbumDescription"><?php echo $rsUpdate["Description"]; ?></textarea></td>
	</tr>
	<tr>
		<td align="right" valign="middle"><?php echo $sMsgImgAlbum; ?></td>
		<td align="left" valign="middle">
			<?php echo $rsUpdate["ImagePath"]; ?><br>
			<?php if($rsUpdate["ImagePath"]!=""){?><img src="<?php echo $sSiteURL; ?>media/PhotoGallery/<?php echo $rsUpdate["ImagePath"]; ?>"><br><?php } ?>
			<input type="file" name="txtImageSMPath"> (jpg, jpeg, jpe, gif, png, bmp)
		</td>
	</tr>
	<tr><td colspan="2" align="center" valign="middle"><input type="submit" name="btnSubmit" value="Update" class="inpSubmit"></td></tr>
	</table>
	</form>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
<script type="text/javascript">
CKEDITOR.replace('txtAlbumDescription');
</script>
</body>
</html>