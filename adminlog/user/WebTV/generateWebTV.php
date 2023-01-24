<?php ob_start();session_cache_expire(30);session_start();
include_once("../common/mysqli_conneCT.php");require_once("../common/config.php");
$iCatID=$_REQUEST["catid"];

//Highlight-Home
$sData="";$iCounter=1;
$qSQL="SELECT WebTVID, WebTVHeading, WebTVLinkCode FROM tv_webtv WHERE Deletable=1 AND TopHome=1 ORDER BY WebTVID DESC LIMIT 4";
$resultWebTV=mysqli_query($connEMM, $qSQL) or die(" ");

while($rsWebTV=mysqli_fetch_assoc($resultWebTV)){
	$sVideoID=$rsWebTV["WebTVID"];
	$sVideoTitle=$rsWebTV["WebTVHeading"];
	$sVideoCode=$rsWebTV["WebTVLinkCode"];
		$sData.='<div class="col-sm-3">
	<div class="DVideoGalleryList">
		<a href="'.$sSiteURL.'videogallery/index.php?videoinfo='.$sVideoID.'">
			<img src="https://img.youtube.com/vi/'.$sVideoCode.'/0.jpg" alt="'.$sVideoTitle.'" title="'.$sVideoTitle.'" class="img-responsive img100">
			<p>'.$sVideoTitle.'</p>
		</a>
	</div>
</div>
';
}mysqli_free_result($resultWebTV);

//echo "sData: ".$sData;
$myFile=$UploadXHTML_BN."tv_Home.htm";
$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);

header("Location: webTVInsert.php");
mysqli_close($connEMM); ?>