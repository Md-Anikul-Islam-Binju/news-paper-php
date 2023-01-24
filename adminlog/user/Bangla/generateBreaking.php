<?php ob_start();session_cache_expire(30);session_start();
require_once("../common/mysqli_conneCT.php");require_once("../common/config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Generate</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<meta http-equiv="cache-control" content="max-age=0">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="-1">
<meta http-equiv="pragma" content="no-cache">
</head>
<body>

<?php
$sData="";

$resultSQL=mysqli_query($connEMM, "SELECT BreakingHead FROM bn_breaking WHERE Deletable=1 ORDER BY BreakingID DESC");
while($rsSQL=mysqli_fetch_assoc($resultSQL)){
	$sHead="";
	if($rsSQL["BreakingHead"]!=""){
		$sHead=$rsSQL["BreakingHead"];
		$sData.='<span><i class="fa fa-check-square-o"></i> '.$sHead."</span>";
	}
}mysqli_free_result($resultSQL);

//echo $sData."<br><br>";

$myFile=$UploadXHTML_BN."gen_breaking.htm";
$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);

header("Location: breakingInsert.php");
mysqli_close($connEMM); ?>
</body>
</html>