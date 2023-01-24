<?php define("DB_HOST","localhost");define("DB_USER","coxsb2a6_coxsbaz");define("DB_PASSWORD","TM5OxY{r]Gw]");define("DB_NAME","coxsb2a6_coxs"); //Local
define("DB_HOSTAudit","localhost");define("DB_USERAudit","coxsb2a6_coxsbaz");define("DB_PASSWORDAudit","TM5OxY{r]Gw]");define("DB_NAMEAudit","coxsb2a6_coxs_audit"); //Local
/*define("DB_HOST","localhost");define("DB_USER","jugerchi_root");define("DB_PASSWORD","25B_09pPZ1H_d");define("DB_NAME","jugerchi_emm"); //Web
define("DB_HOSTAudit","localhost");define("DB_USERAudit","jugerchi_root");define("DB_PASSWORDAudit","25B_09pPZ1H_d");define("DB_NAMEAudit","jugerchi_emmaudit"); //Web*/

global $connEMM, $connEMMAudit, $dtDateTime;

if(@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Please try after a while...")){
	$connEMM=@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Please try after a while...");
	if($connEMM){
		@mysqli_query($connEMM, "SET CHARACTER SET utf8");
		@mysqli_query($connEMM, "SET SESSION collation_connection='utf8_general_ci'");
	}else{
		trigger_error("Please try after a while...");
		exit();
	}
}else{
	trigger_error("Please try after a while...");
	exit();
}

function fFormatString($s){
	global $connEMM;
	/*Ommits HTML Code from the texts*/
	if(function_exists("mysqli_real_escape_string")){
		$sStr=mysqli_real_escape_string($connEMM, trim($s));/*Escapes special characters in a string for use in an SQL statement*/
		$sStr=strip_tags($sStr);/*Strip HTML and PHP tags from a string*/
		//$sStr=htmlspecialchars($sStr);
		//$sStr=htmlentities($sStr);
		$sStr=str_replace("'", "`", $sStr);
	}else{
		$sStr=trim($s);/*Escapes special characters in a string for use in an SQL statement*/
		$sStr=strip_tags($sStr);/*Strip HTML and PHP tags from a string*/
		//$sStr=htmlspecialchars($sStr);
		//$sStr=htmlentities($sStr);
		$sStr=str_replace("'", "`", $sStr);
	}
	return $sStr;
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Schedule (Bangla)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>

<?php
$dtTimeDifference=6*60*60;
$dtDateTime=gmdate("Y-m-d G:i:s", time()+$dtTimeDifference);
//Collecting parameter value
$qShow="SELECT * FROM bn_content_schedule WHERE DateTimeInserted<='".$dtDateTime."' AND Deletable=1 ORDER BY ContentID DESC";
//echo $qShow."<br>";
$resultShow=mysqli_query($connEMM, $qShow) or die(mysqli_error($connEMM));
while($rsShow=mysqli_fetch_assoc($resultShow)){
	$iContentID=$rsShow["ContentID"];
	$sContentHeading=$rsShow["ContentHeading"];
	$sDateTimeInserted=$rsShow["DateTimeInserted"];
	//echo $iContentID." - ".$sContentHeading." - ".$sDateTimeInserted."<br>";
	$qInsert="INSERT INTO bn_content(CategoryID, TopHome, TopInner, SubCategoryID, SubCategoryIDPos,
	SpecialCategoryID, SpecialCategoryIDPos, DistrictID,
	ContentSubHeading, ContentHeading, WritersID, Writers, Initial,
	ContentBrief, ContentDetails,
	ImageThumbPath, ImageSMPath, ImageSMPathCaption, ImageBGPath, ImageBGPathCaption,
	TagName, SoundPath, VideoPath, ShowContent, ShowInScroll,
	URLAlies, DateTimeInserted)
VALUES (".$rsShow["CategoryID"].", ".$rsShow["TopHome"].", ".$rsShow["TopInner"].", ".$rsShow["SubCategoryID"].", ".$rsShow["SubCategoryIDPos"].",
".$rsShow["SpecialCategoryID"].", ".$rsShow["SpecialCategoryIDPos"].", ".$rsShow["DistrictID"].",
'".fFormatString($rsShow["ContentSubHeading"])."', '".fFormatString($rsShow["ContentHeading"])."', ".$rsShow["WritersID"].", '".fFormatString($rsShow["Writers"])."', '".fFormatString($rsShow["Initial"])."', 
'".fFormatString($rsShow["ContentBrief"])."', '".fFormatString($rsShow["ContentDetails"])."', 
'".$rsShow["ImageThumbPath"]."', '".$rsShow["ImageSMPath"]."', '".fFormatString($rsShow["ImageSMPathCaption"])."', '".$rsShow["ImageBGPath"]."', '".fFormatString($rsShow["ImageBGPathCaption"])."', 
'".fFormatString($rsShow["TagName"])."', '".fFormatString($rsShow["SoundPath"])."', '".fFormatString($rsShow["VideoPath"])."', ".$rsShow["ShowContent"].", ".$rsShow["ShowInScroll"].",
'".$rsShow["URLAlies"]."', '".$rsShow["DateTimeInserted"]."')";
		//echo $qInsert."<br>";
		$resultInsert=mysqli_query($connEMM, $qInsert) or die(mysqli_error($connEMM));

		$iThisContentID=mysqli_insert_id($connEMM); //Inserted ID
		//Insert Hit Counter
		$qTotalHit="INSERT INTO bn_totalhit(ContentID) VALUES('".$iThisContentID."')";
		//echo $qTotalHit."<br>";
		mysqli_query($connEMM, $qTotalHit) or die("<b>Inset TotalHit Error</b>: ".mysqli_error($connEMM));

		//Deleting data from List
		$qDelete="UPDATE bn_content_schedule SET Deletable=2 WHERE ContentID=".$iContentID;
		//echo $qDelete."<br>";
		$resultDelete=mysqli_query($connEMM, $qDelete) or die(mysqli_error($connEMM));
		echo "DONE<br><br>";
} ?>
</div>
</body>
</html>