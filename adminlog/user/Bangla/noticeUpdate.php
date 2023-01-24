<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Notice - Update</title>
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
function setfocus(){document.frmUpdate.txtHeading.focus();}
$(document).ready(function(){$("#frmUpdate").validate({});});
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
	$qUpdate="SELECT * FROM bn_notice WHERE NoticeID=".$iUpdateID;
	$resultUpdate=mysqli_query($connEMM, $qUpdate) or die("Cannot run SELECT: ".mysqli_error($connEMM));
	$rsUpdate=mysqli_fetch_assoc($resultUpdate); ?>
	<form id="frmUpdate" name="frmUpdate" method="post" action="noticeUpdateAction.php?updateid=<?php echo $iUpdateID; ?>" enctype="multipart/form-data">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><th colspan="2">Notice - Update</th></tr>
	<tr>
		<td align="right" valign="top">Notice Heading:</td>
		<td align="left" valign="top"><input type="text" id="txtHeading" name="txtHeading" maxlength="65" class="inpBN required" value="<?php echo $rsUpdate["NoticeHeading"]; ?>"><?php echo $sMsgRequired; ?></td>
	</tr>
	<tr>
		<td align="right" valign="top">Brief Notice:<?php echo $sMsgImgAll; ?></td>
		<td align="left" valign="top"><textarea name="txtNoticeBrief" class="txtBN1"><?php echo $rsUpdate["NoticeBrief"]; ?></textarea></td>
	</tr>
	<tr>
		<td align="right" valign="top">Details Notice:<?php echo $sMsgImgAll; ?></td>
		<td align="left" valign="top"><textarea name="txtNoticeDetails" class="txtBN2"><?php echo $rsUpdate["NoticeDetails"]; ?></textarea></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Image (Small):</td>
		<td align="left" valign="middle">
		<?php $sImageSMPath=$rsUpdate["ImageSMPath"];
			echo "Image:<b>".$sImageSMPath."</b> - ";
			$sPos=strrchr($sImageSMPath, "/");
			$sPos=str_replace("/", "", $sPos);
			echo "File Name:<b>".$sPos."</b>"; ?><br>
		<?php if($sImageSMPath!=""){
			$_SESSION["sessImageSMPathBN"]=$sPos; ?>
			<img src="<?php echo $sSiteURL; ?>media/imgAll/<?php echo $sImageSMPath; ?>"><br>
		<?php }else{$_SESSION["sessImageSMPathBN"]="";} ?>
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
CKEDITOR.replace('txtNoticeBrief');
CKEDITOR.replace('txtNoticeDetails');
</script>
</body>
</html>