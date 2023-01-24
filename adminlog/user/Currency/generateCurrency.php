<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Generate</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMMEn;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
</head>
<body>
<?php
if(isset($_POST["btnSubmit"])){
$sData="";$sList="";

$resultSQL=mysqli_query($connEMM, "SELECT * FROM com_currency");
$rsSQL=mysqli_fetch_assoc($resultSQL);

$sData.='<td style="width:20%;">
	<ul class="list-group">
		<li class="list-group-item list-group-item-success">ক্রয়</li>
		<li class="list-group-item list-group-item-info">'.fEn2Bn($rsSQL["DollarB"]).'</li>
		<li class="list-group-item list-group-item-warning">'.fEn2Bn($rsSQL["PoundB"]).'</li>
		<li class="list-group-item list-group-item-danger">'.fEn2Bn($rsSQL["EuroB"]).'</li>
		<li class="list-group-item list-group-item-info">'.fEn2Bn($rsSQL["RupeeB"]).'</li>
		<li class="list-group-item list-group-item-warning">'.fEn2Bn($rsSQL["YenB"]).'</li>
		<li class="list-group-item list-group-item-danger">'.fEn2Bn($rsSQL["CanB"]).'</li>
		<li class="list-group-item list-group-item-success">'.fEn2Bn($rsSQL["AusB"]).'</li>
		<li class="list-group-item list-group-item-warning">'.fEn2Bn($rsSQL["MalB"]).'</li>
		<li class="list-group-item list-group-item-info">'.fEn2Bn($rsSQL["SaudiB"]).'</li>
	</ul>
</td>
<td style="width: 20%;">
	<ul class="list-group">
		<li class="list-group-item list-group-item-success">বিক্রয়</li>
		<li class="list-group-item list-group-item-info">'.fEn2Bn($rsSQL["DollarS"]).'</li>
		<li class="list-group-item list-group-item-warning">'.fEn2Bn($rsSQL["PoundS"]).'</li>
		<li class="list-group-item list-group-item-danger">'.fEn2Bn($rsSQL["EuroS"]).'</li>
		<li class="list-group-item list-group-item-info">'.fEn2Bn($rsSQL["RupeeS"]).'</li>
		<li class="list-group-item list-group-item-warning">'.fEn2Bn($rsSQL["YenS"]).'</li>
		<li class="list-group-item list-group-item-danger">'.fEn2Bn($rsSQL["CanS"]).'</li>
		<li class="list-group-item list-group-item-success">'.fEn2Bn($rsSQL["AusS"]).'</li>
		<li class="list-group-item list-group-item-warning">'.fEn2Bn($rsSQL["MalS"]).'</li>
		<li class="list-group-item list-group-item-info">'.fEn2Bn($rsSQL["SaudiS"]).'</li>
	</ul>
</td>';
mysqli_free_result($resultSQL);
//echo $sData."<br><br>";

$myFile=$UploadXHTML_BN."gen_currency.htm";
$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);

header("Location: currencyInsert.php");
mysqli_close($connEMM);
} ?>
</body>
</html>