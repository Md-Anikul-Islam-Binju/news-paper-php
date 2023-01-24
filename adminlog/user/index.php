<?php require_once("common/mysqli_conneCT.php");
require_once("common/config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Login to Admin Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<?php
echo $cssEMMLogin;
echo $jsjQuery;
echo $jsjQueryValidate;
?>
<script language="javascript">
function setfocus(){document.frmLogin.txtUserName.focus();}
$(document).ready(function(){$("#frmLogin").validate();});
</script>
</head>
<?php
//Get visitor IP
function getUserIP(){
	$client=@$_SERVER['HTTP_CLIENT_IP'];
	$forward=@$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote=$_SERVER['REMOTE_ADDR'];

	if(filter_var($client, FILTER_VALIDATE_IP)){$ip=$client;}
	elseif(filter_var($forward, FILTER_VALIDATE_IP)){$ip=$forward;}
	else{$ip=$remote;}
	return $ip;
}
//Get the data from a URL
function get_url($url){
	$ch=curl_init();

	if($ch===false){die('Failed to create curl object');}
	$timeout=5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data=curl_exec($ch);
	curl_close($ch);
	return $data;
}

$sIP=getUserIP();
//echo "User IP: ".$sIP."<br>";

$sjJSon=get_url('https://www.iplocate.io/api/lookup/'.$sIP);
$sjJSon1=(explode(",", $sjJSon));
//echo "Country: ".$sjJSon1[1]."<br>";
//echo "City: ".$sjJSon1[3]."<br><hr>";

/*if( ($sjJSon1[1]!='"country":"Bangladesh"') && ($sjJSon1[3]!='"city":"Dhaka"') ){
	echo "Redirect to Home page";
}*/
?>
<body onload="setfocus();">
<table border="0" cellpadding="5" cellspacing="0" align="center" class="TblLogin">
	<tr><td align="right" valign="middle"><img src="images/password.jpg" border="0" alt="Login" title="Login"/></td>
	<td align="left" valign="middle">
	<form name="frmLogin" id="frmLogin" method="post" action="adminLoginAction.php">
		<table border="0" cellpadding="5" cellspacing="0" class="TblLogin2">
			<tr><td colspan="2" align="center" valign="middle"><b>Login to Admin Panel</b></td></tr>
			<tr>
				<td align="right" valign="middle">User Name:</td>
				<td align="left" valign="middle"><input type="text" name="txtUserName" id="txtUserName" class="required" value="" autofocus></td>
			</tr>
			<tr>
				<td align="right" valign="middle">Password:</td>
				<td align="left" valign="middle"><input type="password" name="txtPassword" id="txtPassword" class="required" value=""></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td align="left" valign="middle"><input type="submit" name="btnSubmit" value="Login" class="inpSubmit"></td>
			</tr>
			<tr><td colspan="2" align="center" class="TdError">
			<?php if(isset($_REQUEST["err"])) echo "** Invalid Login. Please try again."; else echo "&nbsp;"; ?>
			<?php if(isset($_REQUEST["errip"])) echo "** Invalid Login. Please contact Web Editors."; else echo "&nbsp;"; ?>
			</td></tr>
		</table>
	</form>
</td></tr>
</table>
<?php include_once("common/footer.php"); ?>
</body>
</html>