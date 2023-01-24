<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SCROLL Content - Update (BANGLA)</title>
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
function setfocus(){document.frmUpdate.txtScrollHeading.focus();}
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
	$_SESSION["UpdateID"]=$iUpdateID;
	$qUpdate="SELECT * FROM bn_scroll WHERE ScrollID=".$iUpdateID;
	$resultUpdate=mysqli_query($connEMM, $qUpdate);
	$rsUpdate=mysqli_fetch_assoc($resultUpdate); ?>
	<form name="frmUpdate" id="frmUpdate" action="scrollUpdateAction.php?updateid=<?php echo $rsUpdate["ScrollID"]; ?>" enctype="multipart/form-data" method="post">
	<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl98">
		<tr><th>SCROLL - Update (BANGLA)</th></tr>
		<tr><td align="left" valign="middle">
			Scroll:
			<input type="text" name="txtScrollHeading" id="txtScrollHeading" class="inpBN required" value="<?php echo $rsUpdate["ScrollHeading"]; ?>" required autofocus><span class="SpnRequired">*</span>
			<input type="submit" name="btnSubmit" class="inpSubmit" value="Update">
		</td></tr>
		<tr><td colspan="2" align="center" valign="middle"></td></tr>
	</table>
	</form>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>