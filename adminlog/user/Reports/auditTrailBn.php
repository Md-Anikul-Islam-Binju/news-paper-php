<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Audit Trail - List (Content - Bangla)</title>
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
	<tr><td align="right" colspan="8"><a href="auditTrailCommonBn.php">[Common-BN]</a> &nbsp; <a href="auditTrailCommonEn.php">[Common-EN]</a> &nbsp; <a href="auditTrailBn.php">[Content BN]</a> &nbsp; <a href="auditTrailEn.php">[Content EN]</a> &nbsp; <a href="auditTrailPhoto.php">[Photo]</a></td></tr>
	<tr><th colspan="8">Audit Trail - List (Content - Bangla)</th></tr>
	<tr><td colspan="8" class="TdSearch">
	<form name="frmContentID" action="auditTrailBn.php" method="post">
	Search by: <select name="cboSearchType" class="selEN">
			<option value="1">Content ID</option>
			<option value="2">Content Text</option>
		</select>
		<input type="text" name="txtSearch" value="" placeholder="Search">
		<input type="submit" name="btnSubmit" value="Search">
	</form>
	</td></tr>
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

	<?php $rowsPerPage=50;$pageNum=1;
	if(isset($_GET["page"])){ $pageNum=$_GET["page"]; }
	$offset=($pageNum-1)*$rowsPerPage;
	$qContent="SELECT * FROM com_audittrail_bncontent ORDER BY AuditTrailID DESC LIMIT $offset, $rowsPerPage";

	if(isset($_REQUEST["btnSubmit"])){
		if($_REQUEST["cboSearchType"]==1){
			$iContentID=$_REQUEST["txtSearch"];
			$qContent="SELECT * FROM com_audittrail_bncontent WHERE QueryDetails LIKE '%".$iContentID."%' ORDER BY AuditTrailID DESC LIMIT $offset, $rowsPerPage";
		}
		if($_REQUEST["cboSearchType"]==2){
			$sSearchText=$_REQUEST["txtSearch"];
			$qContent="SELECT * FROM com_audittrail_bncontent WHERE QueryDetails LIKE '%".$sSearchText."%' ORDER BY AuditTrailID DESC LIMIT $offset, $rowsPerPage";
		}
	}

	//echo $qContent."<br>";
	$resultContent=mysqli_query($connEMMAudit, $qContent) or die(mysqli_error($connEMMAudit));
	while($rsContent=mysqli_fetch_assoc($resultContent)){ ?>
	<tr class="TrUpdateListSelect">
		<td align="left" valign="top"><?php echo $rsContent["AuditTrailID"]; ?></td>
		<td align="left" valign="top"><?php echo $rsContent["UserInfo"]; ?></td>
		<td align="left" valign="top">
		<?php if($rsContent["ActionType"]==1){echo "Insert";}elseif($rsContent["ActionType"]==2){echo "<font color=blue>Update</font>";}elseif($rsContent["ActionType"]==3){echo "<font color=red>Delete</font>";}elseif($rsContent["ActionType"]==4){echo "<font color=sky>Activated</font>";} ?>
		</td>
		<td align="left" valign="top"><?php echo $rsContent["TableName"]; ?></td>
		<td align="left" valign="top"><?php echo $rsContent["RemoteIP"]; ?></td>
		<td align="left" valign="top"><?php echo $rsContent["RequestFileName"]; ?></td>
		<td align="left" valign="top"><?php echo $rsContent["QueryDetails"]; ?></td>
		<td align="left" valign="top"><?php echo $rsContent["DateTimeOccered"]; ?></td>
	</tr>
	<?php }$resultContent; ?>

	<tr><td valign="top" colspan="10">
	<?php $qCoutner="SELECT COUNT(AuditTrailID) AS numrows FROM com_audittrail_bncontent";
	if(isset($_REQUEST["btnSubmit"])){
		if($_REQUEST["cboSearchType"]==1){$qCoutner="SELECT COUNT(AuditTrailID) AS numrows FROM com_audittrail_bncontent WHERE QueryDetails LIKE '%".$iContentID."%' ";}
		if($_REQUEST["cboSearchType"]==2){$qCoutner="SELECT COUNT(AuditTrailID) AS numrows FROM com_audittrail_bncontent WHERE QueryDetails LIKE '%".$sSearchText."%' ";}
	}
	$result=mysqli_query($connEMMAudit, $qCoutner) or die("Error, query failed");
	$row=mysqli_fetch_assoc($result);
	$numrows=$row["numrows"];
	$maxPage=ceil($numrows/$rowsPerPage);
	$self=$_SERVER["PHP_SELF"];
	$nav="";

	for($page=1;$page<=$maxPage;$page++){if($page==$pageNum){$nav.=" $page ";}else{$nav.=" <a href=\"$self?page=$page\">$page</a> ";}}
	if($pageNum>1){$page=$pageNum-1;$prev="<a href=\"$self?page=$page\">[Prev]</a>";$first="<a href=\"$self?page=1\">[First Page]</a>";}else{$prev="&nbsp;";$first="&nbsp;";}
	if($pageNum<$maxPage){$page=$pageNum+1;$next=" <a href=\"$self?page=$page\">[Next]</a> ";$last=" <a href=\"$self?page=$maxPage\">[Last Page]</a> ";
	}else{$next="&nbsp;";$last="&nbsp;";}mysqli_free_result($result); ?>
	<div class="DPaginationL"><?php echo $first.$prev; ?></div><div class="DPaginationR"><?php echo $next.$last; ?></div>
	</td></tr>
	</table>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>