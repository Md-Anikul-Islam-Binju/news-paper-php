<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Notice - Insert</title>
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
function setfocus(){document.frmInsert.txtHeading.focus();}
$(document).ready(function(){$("#frmInsert").validate({});});
</script>
</head>
<body onload="setfocus();">
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

	<form id="frmInsert" name="frmInsert" method="post" action="noticeInsertAction.php" enctype="multipart/form-data" onsubmit="return checkLength();">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
		<tr><td align="right" valign="middle" colspan="2"><a href="noticeUpdateList.php">Update</a></td></tr>
		<tr><th colspan="2">Notice - Insert</th></tr>
		<tr>
			<td align="right" valign="top">Notice Heading:</td>
			<td align="left" valign="top"><input type="text" id="txtHeading" name="txtHeading" maxlength="65" class="inpBN required" value=""><?php echo $sMsgRequired; ?></td>
		</tr>
		<tr>
			<td align="right" valign="top">Brief Notice:<?php echo $sMsgImgAll; ?></td>
			<td align="left" valign="top"><textarea name="txtNoticeBrief" class="txtBN1"></textarea></td>
		</tr>
		<tr>
			<td align="right" valign="top">Details Notice:<?php echo $sMsgImgAll; ?></td>
			<td align="left" valign="top"><textarea name="txtNoticeDetails" class="txtBN2"></textarea></td>
		</tr>
		<tr>
			<td align="right" valign="middle">Image (Small):</td>
			<td align="left" valign="middle"><input type="file" name="txtImageSMPath"> (jpg, jpeg, jpe, gif, png, bmp)</td>
		</tr>
		<tr><td colspan="2" align="center" valign="middle"><input type="submit" name="btnSubmit" class="inpSubmit" value="Insert"></td></tr>
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