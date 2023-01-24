<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.css">
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){$("#frmInput").validate();});
$(function(){
$("#dtDate").datepicker({changeMonth: true,changeYear: true});
$("#dtDate").datepicker("option", "dateFormat", "yy-mm-dd");
});
</script>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<?php
if(isset($_POST["btnSubmit"])){
	if($_POST["dtDate"]!=""){
		$sDate=$_POST["dtDate"];
	}else{
		$sDate=date("Y-m-d");
	}
}else{
	$sDate=date("Y-m-d");
} ?>

<div class="DContent">
	<form id="frmInput" name="frmInput" method="post" action="report.php" enctype="multipart/form-data">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl500">
	<tr><td align="right" valign="middle" colspan="2"><a href="reportDetails.php?dtDate=<?php echo $sDate; ?>">Details Report</a></td></tr>
	<tr><th colspan="3">Report</th></tr>
	<tr>
		<td align="right" valign="middle">Report Date:</td>
		<td align="left" valign="middle">
			<input type="text" id="dtDate" name="dtDate" maxlength="10" size="25" class="required" value="<?php echo $sDate; ?>"><?php echo $sMsgRequired; ?>
			<input type="submit" name="btnSubmit" value="Show Report" class="inpSubmit">
		</td>
	</tr>
	</table>
	</form>
</div>

<div class="DContent">
	<?php
	if(isset($_POST["btnSubmit"])){
		$qCount="SELECT COUNT(ContentID) AS iTotal FROM bn_content WHERE DATE(DateTimeInserted)='".$sDate."'";
		$resultCount=mysqli_query($connEMM, $qCount) or die(mysqli_error($connEMM));
		$rsCount=mysqli_fetch_assoc($resultCount);
		$iTotal=$rsCount["iTotal"];
		mysqli_free_result($resultCount);

		$qCount="SELECT COUNT(ContentID) AS iTotalDel FROM bn_content WHERE DATE(DateTimeInserted)='".$sDate."' AND Deletable=2";
		$resultCount=mysqli_query($connEMM, $qCount) or die(mysqli_error($connEMM));
		$rsCount=mysqli_fetch_assoc($resultCount);
		$iTotalDel=$rsCount["iTotalDel"];
		mysqli_free_result($resultCount);

		$qCount="SELECT COUNT(ContentID) AS iTotalShow FROM bn_content WHERE DATE(DateTimeInserted)='".$sDate."' AND ShowContent=2";
		$resultCount=mysqli_query($connEMM, $qCount) or die(mysqli_error($connEMM));
		$rsCount=mysqli_fetch_assoc($resultCount);
		$iTotalShow=$rsCount["iTotalShow"];
		mysqli_free_result($resultCount);
	?>
	<table align="center" border="1" cellpadding="5" cellspacing="0" class="Tbl500">
	<tr><th colspan="2">Report on the date of <?php echo $sDate; ?></th></tr>
	<tr>
		<td align="right" valign="middle">Total News Published:</td>
		<td align="left" valign="middle"><?php echo $iTotal; ?></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Total News DELETED:</td>
		<td align="left" valign="middle"><?php echo $iTotalDel; ?></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Total News NOT Published:</td>
		<td align="left" valign="middle"><?php echo $iTotalShow; ?></td>
	</tr>
	</table>

	<table align="center" border="1" cellpadding="5" cellspacing="0" class="Tbl500">
	<tr><th colspan="4">Categorized Report</th></tr>
	<tr>
		<th align="right" valign="middle">Category</th>
		<th align="right" valign="middle">Published</th>
		<th align="right" valign="middle">DELETED</th>
		<th align="right" valign="middle">NOT Published</th>
	</tr>
	<?php
	$qCateory="SELECT CategoryID, CategoryName FROM bn_bas_category WHERE Deletable=1";
	$resultCateory=mysqli_query($connEMM, $qCateory) or die(mysqli_error($connEMM));
	while($rsCateory=mysqli_fetch_assoc($resultCateory)){
		$iCategoryID=$rsCateory["CategoryID"];
		$sCategoryName=$rsCateory["CategoryName"];

		$qCount="SELECT COUNT(ContentID) AS iTotal FROM bn_content WHERE DATE(DateTimeInserted)='".$sDate."' AND CategoryID=".$iCategoryID;
		$resultCount=mysqli_query($connEMM, $qCount) or die(mysqli_error($connEMM));
		$rsCount=mysqli_fetch_assoc($resultCount);
		$iTotal=$rsCount["iTotal"];
		mysqli_free_result($resultCount);

		$qCount="SELECT COUNT(ContentID) AS iTotalDel FROM bn_content WHERE DATE(DateTimeInserted)='".$sDate."' AND Deletable=2 AND CategoryID=".$iCategoryID;
		$resultCount=mysqli_query($connEMM, $qCount) or die(mysqli_error($connEMM));
		$rsCount=mysqli_fetch_assoc($resultCount);
		$iTotalDel=$rsCount["iTotalDel"];
		mysqli_free_result($resultCount);

		$qCount="SELECT COUNT(ContentID) AS iTotalShow FROM bn_content WHERE DATE(DateTimeInserted)='".$sDate."' AND ShowContent=2 AND CategoryID=".$iCategoryID;
		$resultCount=mysqli_query($connEMM, $qCount) or die(mysqli_error($connEMM));
		$rsCount=mysqli_fetch_assoc($resultCount);
		$iTotalShow=$rsCount["iTotalShow"];
		mysqli_free_result($resultCount);
	?>
	<tr>
		<td align="left" valign="middle" class="tdBn"><a href="reportDetails.php?dtDate=<?php echo $sDate; ?>&catid=<?php echo $iCategoryID; ?>"><?php echo $sCategoryName; ?></a></td>
		<td align="center" valign="middle"><?php echo $iTotal; ?></td>
		<td align="center" valign="middle"><?php echo $iTotalDel; ?></td>
		<td align="center" valign="middle"><?php echo $iTotalShow; ?></td>
	</tr>
<?php }mysqli_free_result($resultCateory); ?>
	</table>

	<table align="center" border="1" cellpadding="5" cellspacing="0" class="Tbl500">
	<tr><th colspan="5">User wise operation</th></tr>
	<tr>
		<th align="right" valign="middle">User</th>
		<th align="right" valign="middle">Insert</th>
		<th align="right" valign="middle">Update</th>
		<th align="right" valign="middle">Delete</th>
		<th align="right" valign="middle">Total</th>
	</tr>
	<?php
	$qUser="SELECT UserName FROM s_secuser WHERE LockType=1 ORDER BY UserName";
	$resultUser=mysqli_query($connEMM, $qUser) or die(mysqli_error($connEMM));
	while($rsUser=mysqli_fetch_assoc($resultUser)){
		$sUserName=$rsUser["UserName"];

		$qCount="SELECT COUNT(AuditTrailID) AS iTotal FROM com_audittrail_bncontent WHERE ActionType=1 AND DATE(DateTimeOccered)='".$sDate."' AND UserInfo='".$sUserName."'";
		$resultCount=mysqli_query($connEMMAudit, $qCount) or die(mysqli_error($connEMMAudit));
		$rsCount=mysqli_fetch_assoc($resultCount);
		$iTotalIns=$rsCount["iTotal"];
		mysqli_free_result($resultCount);

		$qCount="SELECT COUNT(AuditTrailID) AS iTotal FROM com_audittrail_bncontent WHERE ActionType=2 AND DATE(DateTimeOccered)='".$sDate."' AND UserInfo='".$sUserName."'";
		$resultCount=mysqli_query($connEMMAudit, $qCount) or die(mysqli_error($connEMMAudit));
		$rsCount=mysqli_fetch_assoc($resultCount);
		$iTotalUpd=$rsCount["iTotal"];
		mysqli_free_result($resultCount);

		$qCount="SELECT COUNT(AuditTrailID) AS iTotal FROM com_audittrail_bncontent WHERE ActionType=3 AND DATE(DateTimeOccered)='".$sDate."' AND UserInfo='".$sUserName."'";
		$resultCount=mysqli_query($connEMMAudit, $qCount) or die(mysqli_error($connEMMAudit));
		$rsCount=mysqli_fetch_assoc($resultCount);
		$iTotalDel=$rsCount["iTotal"];
		mysqli_free_result($resultCount);
	?>
	<tr>
		<td align="left" valign="middle"><?php echo $sUserName; ?></td>
		<td align="center" valign="middle"><?php echo $iTotalIns; ?></td>
		<td align="center" valign="middle"><?php echo $iTotalUpd; ?></td>
		<td align="center" valign="middle"><?php echo $iTotalDel; ?></td>
		<td align="center" valign="middle"><?php $iTotal=$iTotalIns+$iTotalUpd+$iTotalDel;echo $iTotal; ?></td>
	</tr>
	<?php }mysqli_free_result($resultUser); ?>
	</table>

<?php } ?>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>