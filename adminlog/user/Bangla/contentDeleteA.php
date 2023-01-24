<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Content - Delete (Bangla)</title>
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
$iActivatedID=0;
if(isset($_REQUEST["ActID"])){
	$iActivatedID=fFormatString($_REQUEST["ActID"]);
	$iActivatedID=filter_var($iActivatedID, FILTER_SANITIZE_NUMBER_INT);
	$iActivatedID=filter_var($iActivatedID, FILTER_VALIDATE_INT);
	if(!is_numeric($iActivatedID)){$iActivatedID=0;}
	if($iActivatedID<0){$iActivatedID=0;}
}

$qActivate="UPDATE bn_content SET Deletable=1 WHERE ContentID=".$iActivatedID;
//echo $qActivate."<br>";
$resultActivate=mysqli_query($connEMM, $qActivate) or die(mysqli_error($connEMM));

//Collecting parameter value
$qShow="SELECT CategoryID, SpecialCategoryID,SubCategoryID FROM bn_content WHERE ContentID=".$iActivatedID;
$resultShow=mysqli_query($connEMM, $qShow) or die(mysqli_error($connEMM));
$rsShow=mysqli_fetch_assoc($resultShow);
$iCategory=$rsShow["CategoryID"];
$iSubCategory=$rsShow["SubCategoryID"];
$iSpecialCategoryID=$rsShow["SpecialCategoryID"];

if($resultActivate){
	//Audit Trail
	$qAuditTrail="INSERT INTO com_audittrail_bncontent(UserInfo, ActionType, TableName, RemoteIP, RequestFileName, QueryDetails, DateTimeOccered)
	VALUES('".$_SESSION["sessUserName"]."', 4, 'bn_content', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["REQUEST_URI"]."', '".fAuTrail($qActivate)."', '".$dtDateTime."')";
	mysqli_query($connEMMAudit, $qAuditTrail) or die("<b>Activate AuditTrail Error</b>: ".mysqli_error($connEMM));

	echo $sMsgActivate;
	header("Location: generateHTMLAction.php?CatID=$iCategory&SpeCatID=$iSpecialCategoryID&SubCatID=$iSubCategory");
	//header("Location: ".$_SESSION["sessRedirectPageBN"]);
}else{
	echo $sMsgActivateFail;
} ?>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>