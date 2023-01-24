<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Currency - Update</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMMEn;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<script language="javascript">
function setfocus(){document.frmInsert.txtDollar.focus();}
$(document).ready(function(){
	$("#frmInsert").validate({
	rules:{
	txtDollar:{required:true},
	txtPound:{required:true},
	txtEuro:{required:true}
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

	<form id="frmInsert" name="frmInsert" method="post" action="currencyInsert.php" enctype="multipart/form-data">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
		<tr><td valign="middle" colspan="8"><a href="currencyUpdateList.php">Currency - Update</a></td></tr>
		<tr class="TrHeadings">
			<th>&nbsp;</th>
			<th>Dollar</th>
			<th>Pound</th>
			<th>Euro</th>
			<th>Rupee</th>
			<th>Yen</th>
			<th>Can ($)</th>
			<th>Aus ($)</th>
		</tr>
		<?php $resultCurr=mysqli_query($connEMM, "SELECT * FROM com_currency") or die(mysqli_error($connEMM));
		$rsCurr=mysqli_fetch_assoc($resultCurr); ?>
		<tr>
			<td align="left" valign="middle">Buy</td>
			<td align="left" valign="middle"><input type="text" id="txtDollarB" name="txtDollarB" maxlength="8" class="inpCurr required" value="<?php echo $rsCurr["DollarB"]; ?>" autofocus required></td>
			<td align="left" valign="middle"><input type="text" id="txtPoundB" name="txtPoundB" maxlength="8" class="inpCurr required" value="<?php echo $rsCurr["PoundB"]; ?>" required></td>
			<td align="left" valign="middle"><input type="text" id="txtEuroB" name="txtEuroB" maxlength="8" class="inpCurr required" value="<?php echo $rsCurr["EuroB"]; ?>" required></td>
			<td align="left" valign="middle"><input type="text" id="txtRupeeB" name="txtRupeeB" maxlength="8" class="inpCurr" value="<?php echo $rsCurr["RupeeB"]; ?>" required></td>
			<td align="left" valign="middle"><input type="text" id="txtYenB" name="txtYenB" maxlength="8" class="inpCurr" value="<?php echo $rsCurr["YenB"]; ?>" required></td>
			<td align="left" valign="middle"><input type="text" id="txtCanB" name="txtCanB" maxlength="8" class="inpCurr" value="<?php echo $rsCurr["CanB"]; ?>" required></td>
			<td align="left" valign="middle"><input type="text" id="txtAusB" name="txtAusB" maxlength="8" class="inpCurr" value="<?php echo $rsCurr["AusB"]; ?>" required></td>
		</tr>
		<tr>
			<td align="left" valign="middle">Sell</td>
			<td align="left" valign="middle"><input type="text" id="txtDollarS" name="txtDollarS" maxlength="8" class="inpCurr required" value="<?php echo $rsCurr["DollarS"]; ?>" required></td>
			<td align="left" valign="middle"><input type="text" id="txtPoundS" name="txtPoundS" maxlength="8" class="inpCurr required" value="<?php echo $rsCurr["PoundS"]; ?>" required></td>
			<td align="left" valign="middle"><input type="text" id="txtEuroS" name="txtEuroS" maxlength="8" class="inpCurr required" value="<?php echo $rsCurr["EuroS"]; ?>" required></td>
			<td align="left" valign="middle"><input type="text" id="txtRupeeS" name="txtRupeeS" maxlength="8" class="inpCurr" value="<?php echo $rsCurr["RupeeS"]; ?>" required></td>
			<td align="left" valign="middle"><input type="text" id="txtYenS" name="txtYenS" maxlength="8" class="inpCurr" value="<?php echo $rsCurr["YenS"]; ?>" required></td>
			<td align="left" valign="middle"><input type="text" id="txtCanS" name="txtCanS" maxlength="8" class="inpCurr" value="<?php echo $rsCurr["CanS"]; ?>" required></td>
			<td align="left" valign="middle"><input type="text" id="txtAusS" name="txtAusS" maxlength="8" class="inpCurr" value="<?php echo $rsCurr["AusS"]; ?>" required></td>
		</tr>
		<tr class="TrHeadings">
			<th>&nbsp;</th>
			<th>Malaysian Ringgit</th>
			<th>Saudi Riyal</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<tr>
			<td align="left" valign="middle">Buy</td>
			<td align="left" valign="middle"><input type="text" id="txtMalB" name="txtMalB" maxlength="8" class="inpCurr required" value="<?php echo $rsCurr["MalB"]; ?>" required></td>
			<td align="left" valign="middle"><input type="text" id="txtSaudiB" name="txtSaudiB" maxlength="8" class="inpCurr required" value="<?php echo $rsCurr["SaudiB"]; ?>" required></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td align="left" valign="middle">Sell</td>
			<td align="left" valign="middle"><input type="text" id="txtMalS" name="txtMalS" maxlength="8" class="inpCurr required" value="<?php echo $rsCurr["MalS"]; ?>" required></td>
			<td align="left" valign="middle"><input type="text" id="txtSaudiS" name="txtSaudiS" maxlength="8" class="inpCurr required" value="<?php echo $rsCurr["SaudiS"]; ?>" required></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td align="left" valign="middle"><input type="submit" name="btnSubmit" value="Update" class="inpSubmit"></td>
			<td colspan="7"></td>
		</tr>
		<?php mysqli_free_result($resultCurr); ?>
	</table>
	</form>
</div>
<div class="DContent">
	<?php
	$iDollarB=0;$iPoundB=0;$iEuroB=0;$iRupeeB=0;$iYenB=0;$iCanB=0;$iAusB=0;
	$iDollarS=0;$iPoundS=0;$iEuroS=0;$iRupeeS=0;$iYenS=0;$iCanS=0;$iAusS=0;

	if(isset($_POST["btnSubmit"])){
		$iDollarB=fFormatString($_POST["txtDollarB"]);
		$iDollarS=fFormatString($_POST["txtDollarS"]);
		$iPoundB=fFormatString($_POST["txtPoundB"]);
		$iPoundS=fFormatString($_POST["txtPoundS"]);
		$iEuroB=fFormatString($_POST["txtEuroB"]);
		$iEuroS=fFormatString($_POST["txtEuroS"]);
		$iRupeeB=fFormatString($_POST["txtRupeeB"]);
		$iRupeeS=fFormatString($_POST["txtRupeeS"]);
		$iYenB=fFormatString($_POST["txtYenB"]);
		$iYenS=fFormatString($_POST["txtYenS"]);
		$iCanB=fFormatString($_POST["txtCanB"]);
		$iCanS=fFormatString($_POST["txtCanS"]);
		$iAusB=fFormatString($_POST["txtAusB"]);
		$iAusS=fFormatString($_POST["txtAusS"]);
		$iMalB=fFormatString($_POST["txtMalB"]);
		$iMalS=fFormatString($_POST["txtMalS"]);
		$iSaudiB=fFormatString($_POST["txtSaudiB"]);
		$iSaudiS=fFormatString($_POST["txtSaudiS"]);

		$qUpdate="UPDATE com_currency SET
		DollarB='".$iDollarB."',
		PoundB='".$iPoundB."',
		EuroB='".$iEuroB."',
		RupeeB='".$iRupeeB."',
		YenB='".$iYenB."',
		CanB='".$iCanB."',
		AusB='".$iAusB."',
		MalB='".$iMalB."',
		SaudiB='".$iSaudiB."',

		DollarS='".$iDollarS."',
		PoundS='".$iPoundS."',
		EuroS='".$iEuroS."',
		RupeeS='".$iRupeeS."',
		YenS='".$iYenS."',
		CanS='".$iCanS."',
		AusS='".$iAusS."',
		MalS='".$iMalS."',
		SaudiS='".$iSaudiS."',

		DateTimeUpdated='".$dtDateTime."'";
		//echo $qUpdate."<br>";

		if(mysqli_query($connEMM, $qUpdate)){
			//Audit Trail
			$qAuditTrail="INSERT INTO com_audittrail_gen_en(UserInfo, ActionType, TableName, RemoteIP, RequestFileName, QueryDetails, DateTimeOccered)
			VALUES('".$_SESSION["sessUserName"]."', 2, 'com_currency', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["REQUEST_URI"]."', '".fAuTrail($qUpdate)."', '".$dtDateTime."')";
			mysqli_query($connEMMAudit, $qAuditTrail) or die($sMsgAuTrailInsert);

			echo $sMsgUpdate;
			header("Location: generateCurrency.php");
		}else{
			echo $sMsgUpdateFail;
		}
	} ?>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>