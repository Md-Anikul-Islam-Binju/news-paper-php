<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Access to Control Panel by IP (Content - Bangla)</title>
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

	<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl98">
	<tr><td align="right" colspan="8"><a href="accessToCPCommonBn.php">[Common-BN]</a> &nbsp; <a href="accessToCPCommonEn.php">[Common-EN]</a> &nbsp; <a href="accessToCPBn.php">[Content BN]</a> &nbsp; <a href="accessToCPEn.php">[Content EN]</a> &nbsp; <a href="accessToCPPhoto.php">[Photo]</a></td></tr>
	<tr><th colspan="8">Access to Control Panel by IP (Content - Bangla)</th></tr>
	<tr class="TrHeadings">
		<th>ID</th>
		<th>User Info</th>
		<th>Action Type</th>
		<th>Table Name</th>
		<th>Remote IP</th>
		<th class="TdContentInfo">Request File Name</th>
		<th>Query Details</th>
		<th>Date Time Occered</th>
	</tr>
	<?php $resultContent=mysqli_query($connEMMAudit, "SELECT AuditTrailID, UserInfo, ActionType, TableName, RemoteIP, RequestFileName, QueryDetails, DateTimeOccered FROM com_audittrail_bncontent GROUP BY RemoteIP ORDER BY RemoteIP ASC") or die(mysqli_error($connEMMAudit));
	while($rsContent=mysqli_fetch_assoc($resultContent)){ ?>
	<tr class="TrUpdateListSelect">
		<td align="left" valign="top"><?php echo $rsContent["AuditTrailID"]; ?></td>
		<td align="left" valign="top"><?php echo $rsContent["UserInfo"]; ?></td>
		<td align="left" valign="top"><?php echo $rsContent["ActionType"]; ?></td>
		<td align="left" valign="top"><?php echo $rsContent["TableName"]; ?></td>
		<td align="left" valign="top"><?php echo $rsContent["RemoteIP"]; ?></td>
		<td align="left" valign="top"><?php echo $rsContent["RequestFileName"]; ?></td>
		<td align="left" valign="top"><?php echo $rsContent["QueryDetails"]; ?></td>
		<td align="left" valign="top"><?php echo $rsContent["DateTimeOccered"]; ?></td>
	</tr>
	<?php }mysqli_free_result($resultContent); ?>
	</table>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>