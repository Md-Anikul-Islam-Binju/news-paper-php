<?php session_start();$_SESSION["sessUserName"]=NULL;session_unset();session_destroy();require_once("common/mysqli_conneCT.php");require_once("common/config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $sAdmnTitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<?php echo $cssEMMLogin; ?>
</head>
<body>
<table border="0" cellpadding="5" cellspacing="0" align="center" class="TblLogin">
	<tr><td align="right" valign="middle"><img src="<?php echo $sAdmnURL; ?>images/logout.jpg" border="0" alt="logout" title="logout"/></td>
	<td align="left" valign="middle">
		<table border="0" cellpadding="5" cellspacing="0" class="TblLogin2">
			<tr><td align="center" valign="middle">
			You have been logout from the system...<br>
			If you want to login again <a href="<?php echo $sAdmnURL; ?>">click here</a>
			</td></tr>
		</table>
</td></tr>
</table>
<?php include_once("common/footer.php"); ?>
</body>
</html>