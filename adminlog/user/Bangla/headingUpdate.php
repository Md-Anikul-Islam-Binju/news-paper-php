<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Content - Update HEADING (Bangla)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsjQueryValidate;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<script language="javascript">
function setfocus(){document.frmUpdate.txtHeading.focus();}
function checkLength(){
var iSubHead=document.frmUpdate.txtSubHeading.value.length;
var iHead=document.frmUpdate.txtHeading.value.length;
var iTotalhead=iSubHead+iHead;
if(iTotalhead>65){
	alert("Type SHORT Heading, Your heading must be within 65 Character...");
	document.frmUpdate.txtHeading.focus();
	return false;
}}
$(document).ready(function(){
	$("#frmUpdate").validate({
	rules:{
	txtHeading:{required:true},
	txtPrevContentID:{required:true,number:true}}
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

<?php
	$iUpdateID=1;

	$iUpdateID=$_REQUEST["updateid"];
	$qUpdate="SELECT ContentHeading, ContentSubHeading, Writers FROM bn_content WHERE ContentID=".$iUpdateID;
	$resultUpdate=mysqli_query($connEMM, $qUpdate);
	$rsUpdate=mysqli_fetch_assoc($resultUpdate); ?>
	<form id="frmUpdate" name="frmUpdate" action="headingUpdateAction.php?updateid=<?php echo $iUpdateID; ?>" method="post">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
		<tr><th colspan="2">Content - Update HEADING (Bangla)</th></tr>
		<tr>
			<td align="right" valign="top">Content Sub-Heading:</td>
			<td align="left" valign="middle"><input type="text" id="txtSubHeading" name="txtSubHeading" maxlength="65" class="inpBN" value="<?php echo $rsUpdate["ContentSubHeading"]; ?>"></td>
		</tr>
		<tr>
			<td align="right" valign="top">Content Heading:</td>
			<td align="left" valign="middle"><input type="text" id="txtHeading" name="txtHeading" maxlength="65" class="inpBN required" value="<?php echo $rsUpdate["ContentHeading"]; ?>" required autofocus></td>
		</tr>
		<tr>
			<td align="right" valign="top">Writer:</td>
			<td align="left" valign="middle"><input type="text" name="txtWriters" class="inpBN" value="<?php echo $rsUpdate["Writers"]; ?>"></td>
		</tr>
		<tr><td colspan="2" align="center" valign="middle"><input type="submit" name="btnSubmit" class="inpSubmit" value="Update"></td></tr>
	</table>
	</form>
	<?php mysqli_free_result($resultUpdate); ?>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>