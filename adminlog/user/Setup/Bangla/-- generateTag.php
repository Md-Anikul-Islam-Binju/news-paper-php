<?php ob_start();session_cache_expire(30);session_start();require_once("../../common/mysqli_conneCT.php");require_once("../../common/config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Generate</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
</head>
<body>
<?php
$sData="";$iCounter=1;

$resultTotal=mysqli_query($connEMM, "SELECT COUNT(TagID) AS iTotal FROM bn_tag WHERE Deletable=1 AND TagActive=1");
$rsTotal=mysqli_fetch_assoc($resultTotal);
$iTotal=$rsTotal["iTotal"];
mysqli_free_result($resultTotal);

$sData='[
';
$resultSQL=mysqli_query($connEMM, "SELECT TagName FROM bn_tag WHERE Deletable=1 AND TagActive=1 ORDER BY TagName DESC");
while($rsSQL=mysqli_fetch_assoc($resultSQL)){
	$sHead=$rsSQL["TagName"];
	if($iCounter==$iTotal){
		$sData.='{"id": "'.$sHead.'", "label": "'.$sHead.'", "value": "'.$sHead.'"}';
	}else{
		$sData.='{"id": "'.$sHead.'", "label": "'.$sHead.'", "value": "'.$sHead.'"},';
	}

$iCounter++;
}mysqli_free_result($resultSQL);
$sData.='
]';

//echo $sData."<br><br>";

$myFile=$UploadXHTML_BN."gen_tag_bn.htm";
$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);

header("Location: tagUpdateList.php");
mysqli_close($connEMM); ?>
</body>
</html>