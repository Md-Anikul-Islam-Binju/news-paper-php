<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Poll - Update</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMMEn;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<!-- DatePicker -->
<?php echo $jsjQueryUI; ?>
<?php echo $cssjQueryUI; ?>
<script type="text/javascript">
function setfocus(){document.frmInsert.txtQuestionBN.focus();}
$(document).ready(function(){$("#frmUpdate").validate();});
$(function(){$("#txtTodayDate").datepicker();});
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
	$qUpdate="SELECT * FROM poll_question WHERE PollID=".$iUpdateID;
	$resultUpdate=mysqli_query($connEMM, $qUpdate);
	$rsUpdate=mysqli_fetch_assoc($resultUpdate);
	$sPollDate=fFormatDateR($rsUpdate["PollDate"]); ?>
	<form id="frmUpdate" name="frmUpdate" action="pollDetailsUpdateAction.php?updateid=<?php echo $iUpdateID; ?>" enctype="multipart/form-data" method="post">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><td align="right" valign="middle" colspan="2"><a href="pollDetailsInsert.php">Insert</a></td></tr>
	<tr><th colspan="2">Poll - Update</th></tr>
	<tr>
		<td align="right" valign="middle">Visible Date:</td>
		<td align="left" valign="middle">
		<input type="Text" id="txtTodayDate" name="txtTodayDate" maxlength="10" size="25" value="<?php echo $sPollDate; ?>" required autofocus><?php echo $sMsgRequired; ?>
		</td>
	</tr>
	<tr>
		<td align="right" valign="middle">Question (Bangla):</td>
		<td align="left" valign="middle"><input type="text" id="txtQuestionBN" name="txtQuestionBN" maxlength="300" class="inpBN required" value="<?php echo $rsUpdate["PollQuestionBN"]; ?>"><?php echo $sMsgRequired; ?></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Question (English):</td>
		<td align="left" valign="middle"><input type="text" id="txtQuestionEN" name="txtQuestionEN" maxlength="300" value="<?php echo $rsUpdate["PollQuestionEN"]; ?>"></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Remarks:</td>
		<td align="left" valign="middle"><textarea name="txtRemarks" class="txtBN1"><?php echo $rsUpdate["Remarks"]; ?></textarea></td>
	</tr>
	<tr><td colspan="2" align="center"><input type="submit" name="btnSubmit" value="Update" class="inpSubmit"></td></tr>
	</table>
	</form>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>