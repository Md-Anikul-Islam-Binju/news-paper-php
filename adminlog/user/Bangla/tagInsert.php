<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Tag - Insert (Bangla)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<script language="javascript">
function setfocus(){document.frmInsert.txtTagName.focus();}
$(document).ready(function(){
	$("#frmInsert").validate({
	rules:{
	txtTagName:{required:true}
	}
	});
});
</script>
</head>
<body onload="setfocus();">
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

	<form id="frmInsert" name="frmInsert" method="post" action="tagInsertAction.php" enctype="multipart/form-data">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
		<tr><td align="right" valign="middle" colspan="2"><a href="tagUpdateList.php">Update</a></td></tr>
		<tr><th colspan="2">Tag - Insert (Bangla)</th></tr>
		<?php if(isset($_REQUEST["msg"])){ ?><tr><td colspan="2" class="TdDuplicate">Tag Name Already exist. Please type a different Tag Name.</td></tr><?php } ?>
		<tr>
			<td align="right" valign="middle">Tag Name:</td>
			<td align="left" valign="middle">
			<input type="text" id="txtTagName" name="txtTagName" maxlength="200" class="inpBN required" value="" required autofocus><?php echo $sMsgRequired; ?>
			</td>
		</tr>
		<tr>
			<td align="right" valign="middle">Active?:</td>
			<td align="left" valign="middle">
				<div class="DFloating1">
				<input type="radio" name="rdoActive" value="1" checked="checked">Yes
				<input type="radio" name="rdoActive" value="2">No
				</div>
			</td>
		</tr>
		<tr><td colspan="2" align="center" valign="middle"><input type="submit" name="btnSubmit" value="Insert" class="inpSubmit"></td></tr>
	</table>
	</form>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>