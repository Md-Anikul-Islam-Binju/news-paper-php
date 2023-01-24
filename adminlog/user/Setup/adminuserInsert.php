<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin User - Insert</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<script type="text/javascript">
function setfocus(){document.frmInsert.txtUserName.focus();}
$(document).ready(function(){
	$("#frmInsert").validate({rules:{
		txtNewPassword:{required:true,minlength:5},
		txtReTypePassword:{required:true,minlength:5,equalTo:"#txtNewPassword"}
	} });
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

<?php
if(isset($_REQUEST["btnSubmit"])){
	require_once("../common/password_compat-master/password.php");//Password Hashing library
	echo '<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl98"><tr><td align="left" valign="middle">';
	$iBangla=0;$iEnglish=0;$iPhoto=0;$iWebTV=0;$iWebRadio=0;$iCurrency=0;$iNewsLetter=0;$iPoll=0;$iQuiz=0;$iGeneral=0;$iSetup=0;$iAdminOperation=0;

	$sUserName=fFormatString($_REQUEST["txtUserName"]);
	$sPasswordReal=fFormatString($_REQUEST["txtNewPassword"]);
	$sPasswordHash=password_hash($sPasswordReal, PASSWORD_BCRYPT);
	$iLock=fFormatString($_REQUEST["cboLock"]);

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

	$qInsert="INSERT INTO s_secuser(
	UserName, UserPass01, UserPass02, LockType,
	Bangla, English, Photo, WebTV, WebRadio,
	Currency, Poll, Setup, AdminOperation) VALUES(
	'".$sUserName."', '".$sPasswordReal."', '".$sPasswordHash."', ".$iLock.",
	".$iBangla.", ".$iEnglish.", ".$iPhoto.", ".$iWebTV.", ".$iWebRadio.",
	".$iCurrency.", ".$iPoll.", ".$iSetup.", ".$iAdminOperation."
	)";
	//echo $qInsert."<br>";

	if(mysqli_query($connEMM, $qInsert)){
		//Audit Trail
		$qAuditTrail="INSERT INTO com_audittrail_gen_bn(UserInfo, ActionType, TableName, RemoteIP, RequestFileName, QueryDetails, DateTimeOccered)
		VALUES('".$_SESSION["sessUserName"]."', 1, 's_secuser', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["REQUEST_URI"]."', '".fAuTrail($qInsert)."', '".$dtDateTime."')";
		mysqli_query($connEMMAudit, $qAuditTrail) or die($sMsgAuTrailInsert);

		echo $sMsgInsert;
	}else{
		if(mysqli_errno($connEMM)==1062){header("Location:".$_SERVER["HTTP_REFERER"]."?msg=duplicate");}
		echo $sMsgInsertFail;
	}
	echo '</td></tr></table>';
} ?>
	<?php $arrUserName="";
	$resultUserName=mysqli_query($connEMM, "SELECT UserName FROM s_secuser") or die(mysqli_error($connEMM));
	while($rsUserName=mysqli_fetch_assoc($resultUserName)){
		$arrUserName=$arrUserName."'".$rsUserName["UserName"]."', ";
	}mysqli_free_result($resultUserName); ?>
	<form id="frmInsert" name="frmInsert" action="adminuserInsert.php" method="post" onsubmit="return checkUser();">
	<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl98">
		<tr><th colspan="2">Admin User - Insert</th></tr>
		<?php if(isset($_REQUEST["msg"])){ ?><tr><td colspan="2" class="TdDuplicate">User already exist. Please type a different User Name.</td></tr><?php } ?>
		<tr><td align="center" valign="middle">
			User: <input type="text" id="txtUserName" name="txtUserName" maxlength="50" class="required" required autofocus>
			Password: <input type="password" id="txtNewPassword" name="txtNewPassword" maxlength="50" class="required" required>
			Confirm Password: <input type="password" id="txtReTypePassword" name="txtReTypePassword" maxlength="50" class="required" required>
			Lock:
			<select name="cboLock">
				<option value="1" selected>Open</option>
				<option value="2">Lock User</option>
			</select>
		</td></tr>
		<tr>
			<td align="center" valign="middle">
				Bangla			<input type="checkbox" name="chkAccessRight[]" value="Bangla" checked="checked"><br>
				English			<input type="checkbox" name="chkAccessRight[]" value="English"><br>
				Photo			<input type="checkbox" name="chkAccessRight[]" value="Photo"><br>
				Web TV			<input type="checkbox" name="chkAccessRight[]" value="WebTV"><br>
				Web Radio		<input type="checkbox" name="chkAccessRight[]" value="WebRadio"><br>
			</td>
			<td align="center" valign="middle">
				Currency		<input type="checkbox" name="chkAccessRight[]" value="Currency"><br>
				Poll			<input type="checkbox" name="chkAccessRight[]" value="Poll"><br>
				Setup			<input type="checkbox" name="chkAccessRight[]" value="Setup"><br>
				Admin Operation	<input type="checkbox" name="chkAccessRight[]" value="AdminOperation"><br>
			</td>
		</tr>
		<tr><td colspan="2" align="center" valign="middle"><input type="submit" name="btnSubmit" value="Insert" class="inpSubmit"></td></tr>
	</table>
	</form>

	<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl98">
	<tr class="TrHeadings">
		<th>User Name</th>
		<th>Lock</th>
		<th>Access Right</th>
		<th class="Td50">UPDATE</th>
		<th class="Td50">DELETE</th>
	</tr>
	<?php $resultAdminUser=mysqli_query($connEMM, "SELECT * FROM s_secuser") or die(mysqli_error($connEMM));
	while($rsUserName=mysqli_fetch_assoc($resultAdminUser)){ ?>
	<tr class="TrUpdateListSelect">
		<td align="left"><?php echo $rsUserName["UserName"]; ?></td>
		<td align="left"><?php if($rsUserName["LockType"]=="1"){echo "Open";}else{echo "Lock User";} ?></td>
		<td align="left">
			<?php if($rsUserName["Bangla"]==1){echo "Bangla &nbsp;&nbsp;";} ?>
			<?php if($rsUserName["English"]==1){echo "English &nbsp;&nbsp;";} ?>
			<?php if($rsUserName["Photo"]==1){echo "Photo &nbsp;&nbsp;";} ?>
			<?php if($rsUserName["WebTV"]==1){echo "Web TV &nbsp;&nbsp;";} ?>
			<?php if($rsUserName["WebRadio"]==1){echo "Web Radio &nbsp;&nbsp;";} ?>
			<?php if($rsUserName["Currency"]==1){echo "Currency &nbsp;&nbsp;";} ?>
			<?php if($rsUserName["Poll"]==1){echo "Poll &nbsp;&nbsp;";} ?>
			<?php if($rsUserName["Setup"]==1){echo "Setup &nbsp;&nbsp;";} ?>
			<?php if($rsUserName["AdminOperation"]==1){echo "AdminOperation &nbsp;&nbsp;";} ?>
		</td>
		<td class="Td50"><a href="adminuserUpdate.php?updateid=<?php echo $rsUserName["UserName"]; ?>">Update</a></td>
		<td class="Td50"><a href="adminuserDelete.php?deleteid=<?php echo $rsUserName["UserName"]; ?>">Delete</a></td>
	</tr>
	<?php }mysqli_free_result($resultAdminUser); ?>
	</table>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>