<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin User - Update</title>
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
function setfocus(){document.frmUpdate.txtOldPassword.focus();}
$(document).ready(function(){
	$("#frmUpdate").validate({rules:{
		txtOldPassword:{required:true, equalTo:"#btnOldPassword"},
		txtNewPassword:{required:true, minlength:5},
		txtReTypePassword:{required:true, minlength:5, equalTo:"#txtNewPassword"}
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

	<?php $_SESSION["UpdateID"]=$_REQUEST["updateid"];
	$qUpdate="SELECT * FROM s_secuser WHERE UserName='".$_SESSION["UpdateID"]."'";
	$resultUpdate=mysqli_query($connEMM, $qUpdate);$rsUpdate=mysqli_fetch_assoc($resultUpdate);
	$sOldPass=$rsUpdate["UserPass01"]; ?>
	<form id="frmUpdate" name="frmUpdate" action="adminuserUpdateAction.php" method="post">
	<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl98">
	<tr><th colspan="2">Admin User - Update</th></tr>
	<tr><td align="left">
		User: <b><?php echo $rsUpdate["UserName"]; ?></b><br>
		Old Password: <input type="password" id="txtOldPassword" name="txtOldPassword" maxlength="50" value="" class="required" required autofocus>
		<input type="hidden" id="btnOldPassword" name="btnOldPassword" value="<?php echo $sOldPass; ?>">
		Password: <input  type="password" id="txtNewPassword" name="txtNewPassword" maxlength="50" class="required" required>
		Confirm Password: <input type="password" id="txtReTypePassword" name="txtReTypePassword" maxlength="50" class="required" required>
		Lock:
		<select name="cboLock">
			<option value="1" <?php if($rsUpdate["LockType"]=="1") echo ' selected="selected"'; ?>>Open</option>
			<option value="2" <?php if($rsUpdate["LockType"]=="2") echo ' selected="selected"'; ?>>Lock User</option>
		</select>
	</td></tr>
	<tr><td align="center" valign="middle"><input type="submit" name="btnSubmitPass" value="Update Password" class="inpSubmit"></td></tr>
	</table>
	</form>

	<form id="frmUpdate" name="frmUpdate" action="adminuserUpdateAction.php" method="post">
	<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl98">
	<tr><th colspan="2">Access</th></tr>
	<tr>
		<td align="left">
			Bangla			<input type="checkbox" name="chkAccessRight[]" value="Bangla"		<?php if($rsUpdate["Bangla"]==1) echo 'checked="checked"'; ?>><br>
			English			<input type="checkbox" name="chkAccessRight[]" value="English"		<?php if($rsUpdate["English"]==1) echo 'checked="checked"'; ?>><br>
			Photo			<input type="checkbox" name="chkAccessRight[]" value="Photo"		<?php if($rsUpdate["Photo"]==1) echo 'checked="checked"'; ?>><br>
			Web TV		<input type="checkbox" name="chkAccessRight[]" value="WebTV"	<?php if($rsUpdate["WebTV"]==1) echo 'checked="checked"'; ?>><br>
			Web Radio		<input type="checkbox" name="chkAccessRight[]" value="WebRadio"	<?php if($rsUpdate["WebRadio"]==1) echo 'checked="checked"'; ?>><br>
		</td>
		<td align="left">
			Currency		<input type="checkbox" name="chkAccessRight[]" value="Currency"		<?php if($rsUpdate["Currency"]==1) echo 'checked="checked"'; ?>><br>
			Poll			<input type="checkbox" name="chkAccessRight[]" value="Poll"			<?php if($rsUpdate["Poll"]==1) echo 'checked="checked"'; ?>><br>
			Setup			<input type="checkbox" name="chkAccessRight[]" value="Setup"		<?php if($rsUpdate["Setup"]==1) echo 'checked="checked"'; ?>><br>
			Admin Operation	<input type="checkbox" name="chkAccessRight[]" value="AdminOperation" <?php if($rsUpdate["AdminOperation"]==1) echo 'checked="checked"'; ?>><br>
		</td>
	</tr>
	<tr><td align="center" valign="middle"><input type="submit" name="btnSubmitAccess" value="Update Access" class="inpSubmit"></td></tr>
	</table>
	</form>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>