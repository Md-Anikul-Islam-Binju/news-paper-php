<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Details Report</title>
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

	<?php $resultCategory=mysqli_query($connEMM, "SELECT CategoryID, CategoryName FROM bn_bas_category WHERE Deletable=1 ORDER BY CategoryName") or die(mysqli_error($connEMM)); ?>

	<form id="frmInput" name="frmInput" method="post" action="reportDetails.php" enctype="multipart/form-data">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl500">
	<tr>
		<td align="right" valign="middle">Category:</td>
		<td align="left" valign="middle">
			<div class="DFloating1">
			<select name="catid" class="selBN">
			<?php while($rsCategory=mysqli_fetch_assoc($resultCategory)){ ?>
				<option value="<?php echo $rsCategory["CategoryID"]; ?>"><?php echo $rsCategory["CategoryName"]; ?></option>
			<?php }mysqli_free_result($resultCategory); ?>
			</select>
			<input type="submit" name="btnSubmit" value="Show Report" class="inpSubmit">
			</div>
		</td>
	</tr>
	</table>
	</form>

	<table align="center" border="1" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><td align="right" valign="middle" colspan="3"><a href="report.php">Short Report</a></td></tr>
	<tr><th colspan="4">Details Report</th></tr>
	<tr>
		<th align="right" valign="middle">Category</th>
		<th align="right" valign="middle">Head</th>
		<th align="right" valign="middle">DateTime</th>
	</tr>
	<?php
	if(isset($_REQUEST["dtDate"])){$sDate=$_REQUEST["dtDate"];}else{$sDate=date("Y-m-d");}
	if(isset($_REQUEST["catid"])){$iCategoryID=$_REQUEST["catid"];}else{$iCategoryID=0;}

	if($iCategoryID==0){
		$qContent="SELECT bn_content.ContentID, bn_bas_category.CategoryName, bn_content.ContentSubHeading, bn_content.ContentHeading, bn_content.URLAlies, bn_content.DateTimeInserted FROM bn_content INNER JOIN bn_bas_category ON bn_content.CategoryID=bn_bas_category.CategoryID WHERE bn_content.ShowContent=1 AND bn_content.Deletable=1 AND DATE(bn_content.DateTimeInserted)='".$sDate."' ORDER BY bn_content.ContentID DESC";
	}elseif($iCategoryID>0){
		$qContent="SELECT bn_content.ContentID, bn_bas_category.CategoryName, bn_content.ContentSubHeading, bn_content.ContentHeading, bn_content.URLAlies, bn_content.DateTimeInserted FROM bn_content INNER JOIN bn_bas_category ON bn_content.CategoryID=bn_bas_category.CategoryID WHERE bn_content.ShowContent=1 AND bn_content.Deletable=1 AND bn_content.CategoryID=".$iCategoryID." AND DATE(bn_content.DateTimeInserted)='".$sDate."' ORDER BY bn_content.ContentID DESC";
	}
	//echo $qContent;

	$resultContent=mysqli_query($connEMM, $qContent) or die(mysqli_error($connEMM));
	while($rsContent=mysqli_fetch_assoc($resultContent)){
		$sContentID="";$sHead="";$sSubHead="";$sCatName="";$sURLAlies="";$sCurrURL="";
		$sContentID=$rsContent["ContentID"];
		if($rsContent["ContentSubHeading"]!=""){$sSubHead='<small>'.$rsContent["ContentSubHeading"].'</small><br>';}
		$sHead=$rsContent["ContentHeading"];
		$sCatName=$rsContent["CategoryName"];
		if($rsContent["URLAlies"]!=""){$sURLAlies=$rsContent["URLAlies"];}
		$sCurrURL=$sSiteURL.$sURLAlies."/".$sContentID;
		$sDateTime=$rsContent["DateTimeInserted"];
	?>
	<tr>
		<td align="left" valign="middle" class="tdBn"><?php echo $sCatName; ?></td>
		<td align="left" valign="middle" class="tdBn"><a href="<?php echo $sCurrURL; ?>" target="_blank"><?php echo $sSubHead.$sHead; ?></a></td>
		<td align="center" valign="middle"><?php echo $sDateTime; ?></td>
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