<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Create Album - Insert</title>
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
function setfocus(){document.frmInsert.txtAlbumName.focus();}
$(document).ready(function(){$("#frmInsert").validate();});
</script>
</head>
<body onload="setfocus();">
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

	<form name="frmInsert" id="frmInsert" method="post" action="albumInsertAction.php" enctype="multipart/form-data">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><td align="right" colspan="2"><a href="albumUpdateList.php">Update</a></td></tr>
	<tr><th colspan="2">Create Album - Insert</th></tr>
	<tr>
		<td align="right" valign="middle">Album Type:</td>
		<td align="left" valign="middle">
			<select name="cboAlbumType">
				<option value="1">Daily Gallery</option>
				<option value="2">Photo Album</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right" valign="middle">Album Name:</td>
		<td align="left" valign="middle"><input type="text" name="txtAlbumName" id="txtAlbumName" class="required inpBN" placeholder="Type name of the album" value="<?php echo fEn2Bn(date("F d,Y")); ?>" required autofocus></td>
	</tr>
	<tr>
		<td align="right" valign="top">Album Description:</td>
		<td align="left" valign="middle"><textarea name="txtAlbumDescription"></textarea></td>
	</tr>
	<tr>
		<td align="right" valign="middle"><?php echo $sMsgImgAlbum; ?></td>
		<td align="left" valign="middle"><input type="file" name="txtImageSMPath"> (jpg, jpeg, jpe, gif, png, bmp)</td>
	</tr>
	<tr><td colspan="2" align="center" valign="middle"><input type="submit" name="btnSubmit" value="Insert" class="inpSubmit"></td></tr>
	<tr>
	<td align="right" valign="middle">Some Albums:</td>
	<td class="TdUpdateCat">
		<?php $qSQL="SELECT AlbumID, AlbumName FROM p_album WHERE Deletable=1 ORDER BY AlbumID DESC LIMIT 20";
			$resultAlbum=mysqli_query($connEMM, $qSQL) or die(mysqli_error($connEMM));
			while($rsAlbum=mysqli_fetch_assoc($resultAlbum)){
				echo $rsAlbum["AlbumName"]."&nbsp;&nbsp;&nbsp;";
			}mysqli_free_result($resultAlbum); ?>
	</td></tr>
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