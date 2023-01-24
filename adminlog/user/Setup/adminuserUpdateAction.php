<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin User</title>
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
	require_once("../common/password_compat-master/password.php");//Password Hashing library
	echo '<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl98"><tr><td align="left" valign="middle">';

	if(isset($_REQUEST["btnSubmitPass"])){
		$sPasswordReal=fFormatString($_REQUEST["txtNewPassword"]);
		$sPasswordHash=password_hash($sPasswordReal, PASSWORD_BCRYPT);
		$iLock=fFormatString($_REQUEST["cboLock"]);

		$qUpdate="UPDATE s_secuser SET 
			UserPass01='".$sPasswordReal."', UserPass02='".$sPasswordHash."', LockType=".$iLock."
		WHERE UserName='".$_SESSION["UpdateID"]."'";
		//echo $qUpdate."<br>";
		$resultUpdate=mysqli_query($connEMM, $qUpdate);

		if($resultUpdate){
			//Audit Trail
			$qAuditTrail="INSERT INTO com_audittrail_gen_bn(UserInfo, ActionType, TableName, RemoteIP, RequestFileName, QueryDetails, DateTimeOccered)
			VALUES('".$_SESSION["sessUserName"]."', 2, 's_secuser', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["REQUEST_URI"]."', '".fAuTrail($qUpdate)."', '".$dtDateTime."')";
			mysqli_query($connEMMAudit, $qAuditTrail) or die($sMsgAuTrailInsert);
	
			echo $sMsgUpdate;
			header("Location: adminuserInsert.php");
		}else{
			echo $sMsgUpdateFail;
		}
	}


	if(isset($_REQUEST["btnSubmitAccess"])){
		$iBangla=0;$iEnglish=0;$iPhoto=0;$iWebTV=0;$iWebRadio=0;$iCurrency=0;$iNewsLetter=0;$iPoll=0;$iQuiz=0;$iGeneral=0;$iSetup=0;$iAdminOperation=0;

		if(isset($_POST['chkAccessRight']) && is_array($_POST['chkAccessRight'])){
			foreach($_POST['chkAccessRight'] as $sSlide){
				if($sSlide=="Bangla"){$iBangla=1;}
				if($sSlide=="English"){$iEnglish=1;}
				if($sSlide=="Photo"){$iPhoto=1;}
				if($sSlide=="WebTV"){$iWebTV=1;}
				if($sSlide=="WebRadio"){$iWebRadio=1;}
				if($sSlide=="Currency"){$iCurrency=1;}
				if($sSlide=="Poll"){$iPoll=1;}
				if($sSlide=="Setup"){$iSetup=1;}
				if($sSlide=="AdminOperation"){$iAdminOperation=1;}
			}
		}

		$qUpdate="UPDATE s_secuser SET 
			Bangla=".$iBangla.", English=".$iEnglish.", Photo=".$iPhoto.", WebTV=".$iWebTV.", WebRadio=".$iWebRadio.",
			Currency=".$iCurrency.", Poll=".$iPoll.", Setup=".$iSetup.", AdminOperation=".$iAdminOperation."
		WHERE UserName='".$_SESSION["UpdateID"]."'";
		//echo $qUpdate."<br>";
		$resultUpdate=mysqli_query($connEMM, $qUpdate);

		if($resultUpdate){
			//Audit Trail
			$qAuditTrail="INSERT INTO com_audittrail_gen_bn(UserInfo, ActionType, TableName, RemoteIP, RequestFileName, QueryDetails, DateTimeOccered)
			VALUES('".$_SESSION["sessUserName"]."', 2, 's_secuser', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["REQUEST_URI"]."', '".fAuTrail($qUpdate)."', '".$dtDateTime."')";
			mysqli_query($connEMMAudit, $qAuditTrail) or die($sMsgAuTrailInsert);
	
			echo $sMsgUpdate;
			header("Location: adminuserInsert.php");
		}else{
			echo $sMsgUpdateFail;
		}
	}
	echo '</td></tr></table>'; ?>
</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>