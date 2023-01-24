<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>BREAKING - Insert (BANGLA)</title>
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
function setfocus(){document.frmInsert.txtBreakingHead.focus();}
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

	<form name="frmInsert" id="frmInsert" method="post" action="breakingInsertAction.php" enctype="multipart/form-data">
	<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl98">
		<tr><th>BREAKING - Insert (BANGLA)</th></tr>
		<tr><td>
			BREAKING:
			<input type="text" name="txtBreakingHead" id="txtBreakingHead" class="inpBN required" value="" required autofocus><span class="SpnRequired">*</span>
			<input type="submit" name="btnSubmit" value="Insert" class="inpSubmit">
		</td></tr>
	</table>
	</form>

	<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl98">
		<tr class="TrHeadings">
			<th>BREAKING</th>
			<th>Insert Time</th>
			<th class="Td50">UPDATE</th>
			<th class="Td50">DELETE</th>
		</tr>
		<?php $resultBreaking=mysqli_query($connEMM, "SELECT * FROM bn_breaking WHERE Deletable=1 ORDER BY BreakingID DESC") or die(mysqli_error($connEMM));
		while($rsBreaking=mysqli_fetch_assoc($resultBreaking)){ ?>
		<tr class="TrUpdateListSelect">
			<td align="left" valign="top" class="tdBn"><?php echo $rsBreaking["BreakingHead"]; ?></td>
			<td align="left" valign="top"><?php echo $rsBreaking["DateTimeInserted"]; ?></td>
			<td align="center" valign="top"><a href="breakingUpdate.php?updateid=<?php echo $rsBreaking["BreakingID"]; ?>">Update</a></td>
			<td align="center" valign="top"><a href="breakingDelete.php?deleteid=<?php echo $rsBreaking["BreakingID"]; ?>">Delete</a></td>
		</tr>
	<?php }mysqli_free_result($resultBreaking); ?>
	</table>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>