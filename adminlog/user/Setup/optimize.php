<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Optimize Database</title>
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
	<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl500">
		<tr><th>Optimize Database</th></tr>
		<tr><td align="center" valign="middle">
		<form name="frmOptimize" method="post" action="optimize.php">
			Optimized Scroll content (Bangla)<input type="checkbox" name="chkScrollBN" value="1" checked="checked"><br>
			Optimized Scroll content (English)<input type="checkbox" name="chkScrollEN" value="1" checked="checked"><br>
			Optimized Audit Trail (Common-Bangla) <input type="checkbox" name="chkAuditTrailCommonBn" value="1"><br>
			Optimized Audit Trail (Common-English) <input type="checkbox" name="chkAuditTrailCommonEn" value="1"><br>
			Optimized Audit Trail (Bangla) <input type="checkbox" name="chkAuditTrailBangla" value="1"><br>
			Optimized Audit Trail (English) <input type="checkbox" name="chkAuditTrailEnglish" value="1"><br>
			Optimized Audit Trail (Photo) <input type="checkbox" name="chkAuditTrailPhoto" value="1"><br>
			Optimized Editable Value (Bangla)<input type="checkbox" name="chkEditableValueBN" value="1" checked="checked"><br>
			Optimized Editable Value (English)<input type="checkbox" name="chkEditableValueEN" value="1" checked="checked"><br>
			<input type="submit" name="btnSubmit" value="Optimize" class="inpSubmit">
		</form>
		</td></tr>
		<tr><td align="center" valign="middle">
<?php
if(isset($_REQUEST["btnSubmit"])){
	if(isset($_REQUEST["chkScrollBN"])){
		//3. Deleting SCROLL content - BANGLA
		$result=mysqli_query($connEMM, "DELETE FROM bn_scroll WHERE Deletable=2") or die("Error: Scroll (BN) DELETE Failed.<br> Error No.: ".mysqli_errno($connEMM)." Error: ".mysqli_error($connEMM)."<br>" );
		echo "Successfully Deleted all information from Scroll (Bangla)<br><br>";
	}
	if(isset($_REQUEST["chkScrollEN"])){
		//4. Deleting SCROLL content - ENGLISH
		$result=mysqli_query($connEMM, "DELETE FROM en_scroll WHERE Deletable=2") or die("Error: Scroll (EN) DELETE Failed.<br> Error No.: ".mysqli_errno($connEMM)." Error: ".mysqli_error($connEMM)."<br>" );
		echo "Successfully Deleted all information from Scroll (English)<br><br>";
	}
	if(isset($_REQUEST["chkAuditTrailCommonBn"])){
		//5. Deleting AuditTrail
		$result=mysqli_query($connEMM, "TRUNCATE TABLE com_audittrail_gen_bn") or die("Error: AuditTrail (Common-Bangla) DELETE Failed.<br> Error No.: ".mysqli_errno($connEMM)." Error: ".mysqli_error($connEMM)."<br>" );
		echo "Successfully Deleted all information from AuditTrail (Common)<br><br>";
	}
	if(isset($_REQUEST["chkAuditTrailCommonEn"])){
		//5. Deleting AuditTrail
		$result=mysqli_query($connEMM, "TRUNCATE TABLE com_audittrail_gen_en") or die("Error: AuditTrail (Common-English) DELETE Failed.<br> Error No.: ".mysqli_errno($connEMM)." Error: ".mysqli_error($connEMM)."<br>" );
		echo "Successfully Deleted all information from AuditTrail (Common)<br><br>";
	}
	if(isset($_REQUEST["chkAuditTrailBangla"])){
		//5. Deleting AuditTrail
		$result=mysqli_query($connEMM, "TRUNCATE TABLE com_audittrail_bncontent") or die("Error: AuditTrail (Bangla) DELETE Failed.<br> Error No.: ".mysqli_errno($connEMM)." Error: ".mysqli_error($connEMM)."<br>" );
		echo "Successfully Deleted all information from AuditTrail (Bangla)<br><br>";
	}
	if(isset($_REQUEST["chkAuditTrailEnglish"])){
		//5. Deleting AuditTrail
		$result=mysqli_query($connEMM, "TRUNCATE TABLE com_audittrail_encontent") or die("Error: AuditTrail (English) DELETE Failed.<br> Error No.: ".mysqli_errno($connEMM)." Error: ".mysqli_error($connEMM)."<br>" );
		echo "Successfully Deleted all information from AuditTrail (English)<br><br>";
	}
	if(isset($_REQUEST["chkAuditTrailPhoto"])){
		//5. Deleting AuditTrail
		$result=mysqli_query($connEMM, "TRUNCATE TABLE com_audittrail_photo") or die("Error: AuditTrail (Photo) DELETE Failed.<br> Error No.: ".mysqli_errno($connEMM)." Error: ".mysqli_error($connEMM)."<br>" );
		echo "Successfully Deleted all information from AuditTrail (Photo)<br><br>";
	}

	if(isset($_REQUEST["chkEditableValueBN"])){
		//6. Updating all ContentID's value which are currently opened by user in admin panel - BANGLA
		$result=mysqli_query($connEMM, "UPDATE bn_content SET Editable='1' WHERE Editable!='1'") or die("Error: UPDATE Editable value Failed (Bangla).<br> Error No.: ".mysqli_errno($connEMM)." Error: ".mysqli_error($connEMM)."<br>" );
		echo "Successfully updated all Editable content (Bangla)<br><br>";
	}
	if(isset($_REQUEST["chkEditableValueEN"])){
		//6. Updating all ContentID's value which are currently opened by user in admin panel - ENGLISH
		$result=mysqli_query($connEMM, "UPDATE en_content SET Editable='1' WHERE Editable!='1'") or die("Error: UPDATE Editable value Failed (English).<br> Error No.: ".mysqli_errno($connEMM)." Error: ".mysqli_error($connEMM)."<br>" );
		echo "Successfully updated all Editable content (English)<br><br>";
	}
} ?>
		</td></tr>
	</table>
</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>