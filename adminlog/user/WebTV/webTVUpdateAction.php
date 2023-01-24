<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Web TV</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMMEn;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

<?php
if(isset($_POST["btnSubmit"])){
	$iCategory=1;$iWebTVType=1;$iTopHome=1;$iTopInner=1;$iVideoFootage=1;$iTodayHighlight=1;
	$sWebTVHeading="";$sWebTVLinkCode="";$sRemnarks="";

	$iUpdateID=0;
	if(isset($_REQUEST["updateid"])){
		$iUpdateID=fFormatString($_REQUEST["updateid"]);
		$iUpdateID=filter_var($iUpdateID, FILTER_SANITIZE_NUMBER_INT);
		$iUpdateID=filter_var($iUpdateID, FILTER_VALIDATE_INT);
		if(!is_numeric($iUpdateID)){$iUpdateID=0;}
		if($iUpdateID<0){$iUpdateID=0;}
	}

	$iCategory=$_POST["cboCategory"];
	$iWebTVType=$_POST["cboWebTVType"];
	$sWebTVHeading=fFormatString($_POST["txtWebTVHeading"]);
	$sWebTVLinkCode=fFormatString($_POST["txtWebTVLink"]);
	$iTopHome=$_POST["cboHighlightHome"];
	$iTopInner=$_POST["cboHighlightInner"];
	$iVideoFootage=$_POST["cboVideoFootage"];
	$iTodayHighlight=$_POST["cboTodayHighlight"];

	$qUpdate="UPDATE tv_webtv SET CategoryID='".$iCategory."', WebTVType='".$iWebTVType."', WebTVHeading='".$sWebTVHeading."', WebTVLinkCode='".$sWebTVLinkCode."', TopHome='".$iTopHome."', TopInner='".$iTopInner."', Footage='".$iVideoFootage."', TodayHighlight='".$iTodayHighlight."' WHERE WebTVID=".$iUpdateID;
	//echo $qUpdate."<br>";
	$resultUpdate=mysqli_query($connEMM, $qUpdate) or die(mysqli_error($connEMM));

	if($resultUpdate){
		//Audit Trail
		$qAuditTrail="INSERT INTO com_audittrail_media(UserInfo, ActionType, ContentID, TableName, RemoteIP, RequestFileName, QueryDetails, DateTimeOccered)
		VALUES('".$_SESSION["sessUserName"]."', 2, ".$iUpdateID.", 'tv_webtv', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["REQUEST_URI"]."', '".fAuTrail($qUpdate)."', '".$dtDateTime."')";
		mysqli_query($connEMMAudit, $qAuditTrail) or die($sMsgAuTrailInsert);
		echo $sMsgUpdate;
		//header("Location: webTVInsert.php");
		header("Location: generateWebTV.php?catid=".$iCategory);
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