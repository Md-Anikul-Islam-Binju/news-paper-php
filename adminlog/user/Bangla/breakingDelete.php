<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>BREAKING</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
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
$iDeleteID=0;
if(isset($_REQUEST["deleteid"])){
	$iDeleteID=fFormatString($_REQUEST["deleteid"]);
	$iDeleteID=filter_var($iDeleteID, FILTER_SANITIZE_NUMBER_INT);
	$iDeleteID=filter_var($iDeleteID, FILTER_VALIDATE_INT);
	if(!is_numeric($iDeleteID)){$iDeleteID=0;}
	if($iDeleteID<0){$iDeleteID=0;}
}

$qDelete="UPDATE bn_breaking SET Deletable=2 WHERE BreakingID=".$iDeleteID;
//echo $qDelete."<br>";
$resultDelete=mysqli_query($connEMM, $qDelete);

if($resultDelete){
	//Audit Trail
	$qAuditTrail="INSERT INTO com_audittrail_gen_bn(UserInfo, ActionType, ContentID, TableName, RemoteIP, RequestFileName, QueryDetails, DateTimeOccered)
	VALUES('".$_SESSION["sessUserName"]."', 3, ".$iDeleteID.", 'bn_breaking', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["REQUEST_URI"]."', '".fAuTrail($qDelete)."', '".$dtDateTime."')";
	mysqli_query($connEMMAudit, $qAuditTrail) or die($sMsgAuTrailInsert);

	echo $sMsgDelete;
	//header("Location: breakingInsert.php");
	header("Location: generateBreaking.php");
}else{
	echo $sMsgDeleteFail;
} ?>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>