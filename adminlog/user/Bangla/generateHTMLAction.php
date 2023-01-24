<?php ob_start();session_cache_expire(30);session_start();
include_once("../common/mysqli_conneCT.php");include_once("../common/config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<title>Generate</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="-1">
<meta http-equiv="cache-control" content="max-age=0">
<meta http-equiv="pragma" content="no-cache">
</head>
<body>
<?php
$iCatID=0;$iSpecialCatID=0;$iSubCatID=0;$iDistrictID=0;
if(isset($_REQUEST["CatID"])){$iCatID=$_REQUEST["CatID"];}
if(isset($_REQUEST["SpeCatID"])){$iSpecialCatID=$_REQUEST["SpeCatID"];}
if(isset($_REQUEST["SubCatID"])){$iSubCatID=$_REQUEST["SubCatID"];}
if(isset($_REQUEST["DistID"])){$iDistrictID=$_REQUEST["DistID"];}
echo "iCatID: ".$iCatID."<br>iSpecialCatID: ".$iSpecialCatID."<br>iSubCatID: ".$iSubCatID."<br>iDistrictID: ".$iDistrictID."<br><br>";


//Latest 30 News-Home
$sData="";$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
$resultSQL=mysqli_query($connEMM, "SELECT ContentID, ContentSubHeading, ContentHeading, URLAlies FROM bn_content WHERE Deletable=1 AND ShowContent=1 ORDER BY ContentID DESC LIMIT 30");
while($rsSQL=mysqli_fetch_assoc($resultSQL)){
	$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
	if($rsSQL["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>';}
	$sHead=$rsSQL["ContentHeading"];

	if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsSQL["URLAlies"]).'/'.$rsSQL["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsSQL["ContentID"];}

	$sData.='<li><a href="'.$sURL.'">'.$sSubHead.$sHead.'</a></li>
';
}mysqli_free_result($resultSQL);
//echo $sData."<br><br>";

$myFile=$UploadXHTML_BN."bn_liLatestNews.htm";
$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);



//Most Popular 30 News
$sData="";$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
$resultSQL=mysqli_query($connEMM, "SELECT bn_content.ContentID, bn_content.ContentSubHeading, bn_content.ContentHeading, bn_content.URLAlies FROM bn_content INNER JOIN bn_totalhit ON bn_totalhit.ContentID=bn_content.ContentID WHERE bn_content.Deletable=1 AND bn_content.ShowContent=1 AND bn_content.DateTimeInserted >= DATE(NOW()) - INTERVAL 7 DAY ORDER BY bn_totalhit.TotalHit DESC LIMIT 20");

while($rsSQL=mysqli_fetch_assoc($resultSQL)){
	$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
	if($rsSQL["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>';}
	$sHead=$rsSQL["ContentHeading"];
	if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsSQL["URLAlies"]).'/'.$rsSQL["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsSQL["ContentID"];}

	$sData.='<li><a href="'.$sURL.'">'.$sSubHead.$sHead.'</a></li>
';
}mysqli_free_result($resultSQL);

//echo $sData."<br><br>";
$myFile=$UploadXHTML_BN."bn_liMostPopular.htm";
$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);


//Double COLUMN
if( ($iCatID==1) ){
	$iFound=0;
	$sData="";$sSubHead="";$sHead="";$sBrief="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
	if($iCatID==1){$myFile=$UploadXHTML_BN."bn_Politics.htm";$iFound=1;}

	if($iFound==1){
		//Top 1
		$qSQL="SELECT ContentID, ContentSubHeading, ContentHeading, ContentBrief, ImageThumbPath, ImageSMPath, ImageBGPath, URLAlies FROM bn_content WHERE CategoryID=".$iCatID." AND Deletable=1 AND ShowContent=1 AND TopHome=2 ORDER BY ContentID DESC LIMIT 1";
		//echo "1. ".$qSQL."<br><br>";
		$resultSQL=mysqli_query($connEMM, $qSQL) or die(mysqli_error($connEMM));
		$rsSQL=mysqli_fetch_assoc($resultSQL);
		mysqli_free_result($resultSQL);

		if($rsSQL["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>';}
		$sHead=$rsSQL["ContentHeading"];
		$sBrief=$rsSQL["ContentBrief"];

		if($rsSQL["ImageThumbPath"]!=""){$sImgTh='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageThumbPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgTh='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
		if($rsSQL["ImageSMPath"]!=""){$sImgSM='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgSM='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
		if($rsSQL["ImageBGPath"]!=""){$sImgBG='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageBGPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgBG='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}

		if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsSQL["URLAlies"]).'/'.$rsSQL["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsSQL["ContentID"];}

		$sData.='<div class="col-sm-6 DCatMainNews">
	<a href="'.$sURL.'">
		'.$sImgSM.'
		<p>'.$sSubHead.$sHead.'</p>
	</a>
	<div class="DCatMainNewsDetails">'.$sBrief.'</div>
</div>
<div class="col-sm-6">
';
		//List,
		$qSQL="SELECT ContentID, ContentSubHeading, ContentHeading, ContentBrief, ImageThumbPath, ImageSMPath, ImageBGPath, URLAlies FROM bn_content WHERE CategoryID=".$iCatID." AND Deletable=1 AND ShowContent=1 AND TopHome=3 ORDER BY ContentID DESC LIMIT 4";
		//echo "3. ".$qSQL."<br>";
		$resultSQL=mysqli_query($connEMM, $qSQL) or die(mysqli_error($connEMM));
		while($rsSQL=mysqli_fetch_assoc($resultSQL)){
			$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
			if($rsSQL["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>';}
			$sHead=$rsSQL["ContentHeading"];

			if($rsSQL["ImageThumbPath"]!=""){$sImgTh='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageThumbPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgTh='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
			if($rsSQL["ImageSMPath"]!=""){$sImgSM='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgSM='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
			if($rsSQL["ImageBGPath"]!=""){$sImgBG='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageBGPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgBG='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}

			if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsSQL["URLAlies"]).'/'.$rsSQL["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsSQL["ContentID"];}

			$sData.='	<div class="row DCategoryNewsList">
		<div class="col-sm-4 col-xs-4"><a href="'.$sURL.'">'.$sImgTh.'</a></div>
		<div class="col-sm-8 col-xs-8"><p><a href="'.$sURL.'">'.$sSubHead.$sHead.'</a></p></div>
	</div>
';
		}mysqli_free_result($resultSQL);
		$sData.="</div>";

		//echo "<br><br>ONE COLUMN - with Image:<br>".$sData."<br><br>";
		$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
	}
}


//Full COLUMN
if($iCatID==2){
	$iFound=0;
	$sData="";$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
	if($iCatID==2){$myFile=$UploadXHTML_BN."bn_City.htm";$iFound=1;}

	if($iFound==1){
		//Top 1
		$qSQL="SELECT ContentID, ContentSubHeading, ContentHeading, ContentBrief, ImageThumbPath, ImageSMPath, ImageBGPath, URLAlies FROM bn_content WHERE CategoryID=".$iCatID." AND Deletable=1 AND ShowContent=1 ORDER BY ContentID DESC LIMIT 3";
		//echo "3. ".$qSQL."<br>";
		$resultSQL=mysqli_query($connEMM, $qSQL) or die(mysqli_error($connEMM));
		while($rsSQL=mysqli_fetch_assoc($resultSQL)){
			$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
			if($rsSQL["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>';}
			$sHead=$rsSQL["ContentHeading"];

			if($rsSQL["ImageThumbPath"]!=""){$sImgTh='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageThumbPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgTh='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
			if($rsSQL["ImageSMPath"]!=""){$sImgSM='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgSM='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
			if($rsSQL["ImageBGPath"]!=""){$sImgBG='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageBGPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgBG='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}

			if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsSQL["URLAlies"]).'/'.$rsSQL["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsSQL["ContentID"];}


			$sData.='<div class="col-sm-4">
	<a href="'.$sURL.'">'.$sImgSM.'
	<p>'.$sSubHead.$sHead.'</p></a>
</div>
';
		}mysqli_free_result($resultSQL);

		//echo "<br><br>ONE COLUMN - with Image:<br>".$sData."<br><br>";
		$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
	}
}


//ONE COLUMN
if( ($iCatID==3) || ($iCatID==6) || ($iCatID==7) || ($iCatID==8) || ($iCatID==9) || ($iCatID==10) || ($iCatID==11) || ($iCatID==12) || ($iCatID==14) || ($iCatID==16) || ($iCatID==17) ){

	$iFound=0;
	$sData="";$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
	if($iCatID==3){$myFile=$UploadXHTML_BN."bn_OutOfCity.htm";$iFound=1;}
	if($iCatID==6){$myFile=$UploadXHTML_BN."bn_Sports.htm";$iFound=1;}
	if($iCatID==7){$myFile=$UploadXHTML_BN."bn_Entertainment.htm";$iFound=1;}
	if($iCatID==8){$myFile=$UploadXHTML_BN."bn_Religion.htm";$iFound=1;}
	if($iCatID==9){$myFile=$UploadXHTML_BN."bn_Education.htm";$iFound=1;}
	if($iCatID==10){$myFile=$UploadXHTML_BN."bn_Lifestyle.htm";$iFound=1;}
	if($iCatID==11){$myFile=$UploadXHTML_BN."bn_Health.htm";$iFound=1;}
	if($iCatID==12){$myFile=$UploadXHTML_BN."bn_Country.htm";$iFound=1;}
	if($iCatID==14){$myFile=$UploadXHTML_BN."bn_Interview.htm";$iFound=1;}
	if($iCatID==16){$myFile=$UploadXHTML_BN."bn_ScienceTechnology.htm";$iFound=1;}
	if($iCatID==17){$myFile=$UploadXHTML_BN."bn_Etcetera.htm";$iFound=1;}


	if($iFound==1){
		//Top 1
		$qSQL="SELECT ContentID, ContentSubHeading, ContentHeading, ContentBrief, ImageThumbPath, ImageSMPath, ImageBGPath, URLAlies FROM bn_content WHERE CategoryID=".$iCatID." AND Deletable=1 AND ShowContent=1 AND TopHome=2 ORDER BY ContentID DESC LIMIT 1";
		//echo "1. ".$qSQL."<br><br>";
		$resultSQL=mysqli_query($connEMM, $qSQL) or die(mysqli_error($connEMM));
		$rsSQL=mysqli_fetch_assoc($resultSQL);
		mysqli_free_result($resultSQL);

		if($rsSQL["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>';}
		$sHead=$rsSQL["ContentHeading"];
		$sBrief=$rsSQL["ContentBrief"];

		if($rsSQL["ImageThumbPath"]!=""){$sImgTh='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageThumbPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgTh='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
		if($rsSQL["ImageSMPath"]!=""){$sImgSM='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgSM='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
		if($rsSQL["ImageBGPath"]!=""){$sImgBG='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageBGPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgBG='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}

		if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsSQL["URLAlies"]).'/'.$rsSQL["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsSQL["ContentID"];}

		$sData.='<div class="DCatMainNews2">
	<a href="'.$sURL.'">
		'.$sImgSM.'
		<p>'.$sSubHead.$sHead.'</p>
	</a>
</div>
<ul class="DCatNewsList2">
';
		//List,
		$qSQL="SELECT ContentID, ContentSubHeading, ContentHeading, ContentBrief, ImageThumbPath, ImageSMPath, ImageBGPath, URLAlies FROM bn_content WHERE CategoryID=".$iCatID." AND Deletable=1 AND ShowContent=1 AND TopHome=3 ORDER BY ContentID DESC LIMIT 4";
		//echo "3. ".$qSQL."<br>";
		$resultSQL=mysqli_query($connEMM, $qSQL) or die(mysqli_error($connEMM));
		while($rsSQL=mysqli_fetch_assoc($resultSQL)){
			$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
			if($rsSQL["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>';}
			$sHead=$rsSQL["ContentHeading"];

			/*if($rsSQL["ImageThumbPath"]!=""){$sImgTh='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageThumbPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgTh='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
			if($rsSQL["ImageSMPath"]!=""){$sImgSM='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgSM='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
			if($rsSQL["ImageBGPath"]!=""){$sImgBG='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageBGPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgBG='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}*/

			if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsSQL["URLAlies"]).'/'.$rsSQL["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsSQL["ContentID"];}

			$sData.='<li><a href="'.$sURL.'"><i class="fa fa-stop" aria-hidden="true"></i> '.$sSubHead.$sHead.'</a></li>
';

		}mysqli_free_result($resultSQL);
		$sData.="</ul>";

		//echo "<br><br>ONE COLUMN - with Image:<br>".$sData."<br><br>";
		$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
	}
}


if( ($iCatID==4) || ($iCatID==5) || ($iCatID==13) || ($iCatID==15)){
	$iFound=0;
	$sData="";$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";

	if($iCatID==4){$myFile=$UploadXHTML_BN."bn_Court.htm";$iFound=1;}
	if($iCatID==5){$myFile=$UploadXHTML_BN."bn_PublicDisaster.htm";$iFound=1;}
	if($iCatID==13){$myFile=$UploadXHTML_BN."bn_OrganizationNews.htm";$iFound=1;}
	if($iCatID==15){$myFile=$UploadXHTML_BN."bn_ReaderOpinion.htm";$iFound=1;}

	if($iFound==1){
		//Top 1
		$qSQL="SELECT ContentID, ContentSubHeading, ContentHeading, ContentBrief, ImageThumbPath, ImageSMPath, ImageBGPath, URLAlies FROM bn_content WHERE CategoryID=".$iCatID." AND Deletable=1 AND ShowContent=1 AND TopHome=2 ORDER BY ContentID DESC LIMIT 1";
		//echo "1. ".$qSQL."<br><br>";
		$resultSQL=mysqli_query($connEMM, $qSQL) or die(mysqli_error($connEMM));
		$rsSQL=mysqli_fetch_assoc($resultSQL);
		mysqli_free_result($resultSQL);

		if($rsSQL["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>';}
		$sHead=$rsSQL["ContentHeading"];

		if($rsSQL["ImageThumbPath"]!=""){$sImgTh='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageThumbPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgTh='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
		if($rsSQL["ImageSMPath"]!=""){$sImgSM='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgSM='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
		if($rsSQL["ImageBGPath"]!=""){$sImgBG='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageBGPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgBG='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}

		if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsSQL["URLAlies"]).'/'.$rsSQL["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsSQL["ContentID"];}
		$sBrief=$rsSQL["ContentBrief"];

		$sData.='<div class="DCatMainNews3">
	<a href="'.$sURL.'">
		'.$sImgSM.'
		<p>'.$sSubHead.$sHead.'</p>
	</a>
</div>
';
		//List,
		$qSQL="SELECT ContentID, ContentSubHeading, ContentHeading, ContentBrief, ImageThumbPath, ImageSMPath, ImageBGPath, URLAlies FROM bn_content WHERE CategoryID=".$iCatID." AND Deletable=1 AND ShowContent=1 AND TopHome=3 ORDER BY ContentID DESC LIMIT 3";
		//echo "3. ".$qSQL."<br>";
		$resultSQL=mysqli_query($connEMM, $qSQL) or die(mysqli_error($connEMM));
		while($rsSQL=mysqli_fetch_assoc($resultSQL)){
			$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
			if($rsSQL["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>';}
			$sHead=$rsSQL["ContentHeading"];

			if($rsSQL["ImageThumbPath"]!=""){$sImgTh='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageThumbPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgTh='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
			if($rsSQL["ImageSMPath"]!=""){$sImgSM='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgSM='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
			if($rsSQL["ImageBGPath"]!=""){$sImgBG='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageBGPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgBG='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}

			if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsSQL["URLAlies"]).'/'.$rsSQL["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsSQL["ContentID"];}

		$sData.='<div class="DCatNewsList4">
	<div class="row">
		<div class="col-sm-4"><a href="'.$sURL.'">'.$sImgTh.'</a></div>
		<div class="col-sm-8"><p><a href="'.$sURL.'">'.$sSubHead.$sHead.'</a></p></div>
	</div>
</div>
';
		}mysqli_free_result($resultSQL);

		//echo "<br><br>TWO COLUMN:<br>".$sData."<br><br>";
		$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
	}
}



/*=======================*/
/*======SubCategory======*/
/*=======================*/
if( ($iSubCatID==2) || ($iSubCatID==3) || ($iSubCatID==8) || ($iSubCatID==9) || ($iSubCatID==10) || ($iSubCatID==11) || ($iSubCatID==12) || ($iSubCatID==13) ){
	$iFound=0;
	$sData="";$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
	if($iSubCatID==2){$myFile=$UploadXHTML_BN."bn_sub_Sadar.htm";$iFound=1;}
	if($iSubCatID==3){$myFile=$UploadXHTML_BN."bn_sub_Chakaria.htm";$iFound=1;}
	if($iSubCatID==8){$myFile=$UploadXHTML_BN."bn_sub_Kutubdia.htm";$iFound=1;}
	if($iSubCatID==9){$myFile=$UploadXHTML_BN."bn_sub_Ukhiya.htm";$iFound=1;}
	if($iSubCatID==10){$myFile=$UploadXHTML_BN."bn_sub_Moheshkhali.htm";$iFound=1;}
	if($iSubCatID==11){$myFile=$UploadXHTML_BN."bn_sub_Pekua.htm";$iFound=1;}
	if($iSubCatID==12){$myFile=$UploadXHTML_BN."bn_sub_Ramu.htm";$iFound=1;}
	if($iSubCatID==13){$myFile=$UploadXHTML_BN."bn_sub_Teknaf.htm";$iFound=1;}

	if($iFound==1){
		//Top 1
		$qSQL="SELECT ContentID, ContentSubHeading, ContentHeading, ContentBrief, ImageThumbPath, ImageSMPath, ImageBGPath, URLAlies FROM bn_content WHERE SubCategoryID=".$iSubCatID." AND Deletable=1 AND ShowContent=1 AND SubCategoryIDPos=2 ORDER BY ContentID DESC LIMIT 1";
		//echo "1. ".$qSQL."<br><br>";
		$resultSQL=mysqli_query($connEMM, $qSQL) or die(mysqli_error($connEMM));
		$rsSQL=mysqli_fetch_assoc($resultSQL);
		mysqli_free_result($resultSQL);

		if($rsSQL["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>';}
		$sHead=$rsSQL["ContentHeading"];
		$sBrief=$rsSQL["ContentBrief"];

		if($rsSQL["ImageThumbPath"]!=""){$sImgTh='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageThumbPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgTh='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
		if($rsSQL["ImageSMPath"]!=""){$sImgSM='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgSM='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
		if($rsSQL["ImageBGPath"]!=""){$sImgBG='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageBGPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgBG='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}

		if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsSQL["URLAlies"]).'/'.$rsSQL["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsSQL["ContentID"];}

		$sData.='<div class="DCatMainNews2">
	<a href="'.$sURL.'">
		'.$sImgSM.'
		<p>'.$sSubHead.$sHead.'</p>
	</a>
</div>
<ul class="DCatNewsList2">
';

		//List,
		$qSQL="SELECT ContentID, ContentSubHeading, ContentHeading, ContentBrief, ImageThumbPath, ImageSMPath, ImageBGPath, URLAlies FROM bn_content WHERE SubCategoryID=".$iSubCatID." AND Deletable=1 AND ShowContent=1 AND SubCategoryIDPos=3 ORDER BY ContentID DESC LIMIT 3";
		//echo "3. ".$qSQL."<br>";
		$resultSQL=mysqli_query($connEMM, $qSQL) or die(mysqli_error($connEMM));
		while($rsSQL=mysqli_fetch_assoc($resultSQL)){
			$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
			if($rsSQL["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>';}
			$sHead=$rsSQL["ContentHeading"];
			if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsSQL["URLAlies"]).'/'.$rsSQL["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsSQL["ContentID"];}

			$sData.='<li><a href="'.$sURL.'"><i class="fa fa-stop" aria-hidden="true"></i> '.$sSubHead.$sHead.'</a></li>
';
		}mysqli_free_result($resultSQL);
		$sData.="</ul>";

		//echo "<br><br>ONE COLUMN - with Image:<br>".$sData."<br><br>";
		$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
	}
}


/*=======================*/
/*====SpecialCategory====*/
/*=======================*/
//LeadNews
if(($iSpecialCatID==2)){
	$sData="";$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";$iCounter=1;

	for($i=2;$i<=6;$i++){
		$qSQL="SELECT ContentID, ContentSubHeading, ContentHeading, ContentBrief, ImageThumbPath, ImageSMPath, ImageBGPath, URLAlies  FROM bn_content WHERE Deletable=1 AND ShowContent=1 AND SpecialCategoryID=2 AND SpecialCategoryIDPos=".$i." ORDER BY ContentID DESC LIMIT 1";
		//echo $qSQL."<br>";
		$resultSQL=mysqli_query($connEMM, $qSQL);
		$rsSQL=mysqli_fetch_assoc($resultSQL);

		$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
		if($rsSQL["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>';}
		$sHead=$rsSQL["ContentHeading"];
		$sBrief=$rsSQL["ContentBrief"];

		if($rsSQL["ImageThumbPath"]!=""){$sImgTh='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageThumbPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgTh='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
		if($rsSQL["ImageSMPath"]!=""){$sImgSM='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgSM='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
		if($rsSQL["ImageBGPath"]!=""){$sImgBG='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageBGPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgBG='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}

		if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsSQL["URLAlies"]).'/'.$rsSQL["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsSQL["ContentID"];}
		mysqli_free_result($resultSQL);

		if($iCounter==1){
		$sData.='<div class="col-sm-7 DTopNews">
	<div class="col-sm-12 thumbnail">
		<a href="'.$sURL.'">'.$sImgBG.'</a>
		<div class="caption"><h1><a href="'.$sURL.'">'.$sSubHead.$sHead.'</a></h1></div>
	</div>
</div>

<div class="col-sm-5">
';
		}else{
		$sData.='	<div class="DTRNewsList">
		<div class="row">
			<div class="col-sm-4"><a href="'.$sURL.'">'.$sImgTh.'</a></div>
			<div class="col-sm-8"><h'.$iCounter.'><a href="'.$sURL.'">'.$sSubHead.$sHead.'</a></h'.$iCounter.'></div>
		</div>
	</div>
';
}
	$iCounter++;
	}
		$sData.="</div>";
	//echo $sData."<br>";
	$myFile=$UploadXHTML_BN."bn_spe_LeadNews.htm";
	$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
}


//SpecialTop1
if(($iSpecialCatID==3)){
	$sData="";$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";$iCounter=1;

	//Top 1
	for($i=2;$i<=7;$i++){
		$qSQL="SELECT ContentID, ContentSubHeading, ContentHeading, ContentBrief, ImageThumbPath, ImageSMPath, ImageBGPath, URLAlies  FROM bn_content WHERE Deletable=1 AND ShowContent=1 AND SpecialCategoryID=3 AND SpecialCategoryIDPos=".$i." ORDER BY ContentID DESC LIMIT 1";
		//echo $qSQL."<br>";
		$resultSQL=mysqli_query($connEMM, $qSQL);
		$rsSQL=mysqli_fetch_assoc($resultSQL);

		$sSubHead="";$sHead="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
		if($rsSQL["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>';}
		$sHead=$rsSQL["ContentHeading"];

		if($rsSQL["ImageThumbPath"]!=""){$sImgTh='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageThumbPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgTh='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
		if($rsSQL["ImageSMPath"]!=""){$sImgSM='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgSM='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
		if($rsSQL["ImageBGPath"]!=""){$sImgBG='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageBGPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImgBG='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}

		if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsSQL["URLAlies"]).'/'.$rsSQL["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsSQL["ContentID"];}
		mysqli_free_result($resultSQL);

	if($iCounter==4){
			$sData.='</div>

<div class="row">
';
	}
			$sData.='	<div class="col-sm-4">
		<div class="DTopNewsList">
			<a href="'.$sURL.'">'.$sImgSM.'
			<p>'.$sSubHead.$sHead.'</p></a>
		</div>
	</div>
';
		$iCounter++;
		}

	//echo $sData."<br>";
	$myFile=$UploadXHTML_BN."bn_speSpecialTop1.htm";
	$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
}



//Generate RSS - Bangla
$body="";
$resultSQL=mysqli_query($connEMM, "SELECT ContentID, ContentSubHeading, ContentHeading, ContentBrief, ContentDetails, ImageSMPath, ImageBGPath, DateTimeInserted, URLAlies FROM bn_content WHERE Deletable=1 AND ShowContent=1 ORDER BY ContentID DESC LIMIT 30") or die(mysqli_error($connEMM));
$body='<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
	<channel>
		<title><![CDATA['.$sSiteName.' - Home]]></title>
		<description><![CDATA[Official Web Portal of '.$sSiteName.']]></description>
		<link>'.$sSiteURL.'</link>
		<image>
			<url>'.$sLogoURL.'</url>
			<title>'.$sSiteName.' - Home</title>
			<link>'.$sSiteURL.'</link>
		</image>
		<generator>RSS for Node</generator>
		<lastBuildDate>'.$dtDateTimeRSS.'</lastBuildDate>
		<copyright><![CDATA[Copyright: (C) '.$sSiteName.'.]]></copyright>
		<language><![CDATA[bn]]></language>
		<ttl>15</ttl>
		<atom:link href="'.$sSiteURL.'rss/rss.xml" rel="self" type="application/rss+xml" />
';

while($rsRSS=mysqli_fetch_assoc($resultSQL)){
	$sHeading=htmlspecialchars(strip_tags($rsRSS["ContentHeading"]));
	if($rsRSS["ContentBrief"]!=""){
		$sBrief=htmlspecialchars(strip_tags($rsRSS["ContentBrief"]));
	}else{
		$sBrief=fGetWordsCount($rsRSS["ContentDetails"], 40);
		$sBrief=htmlspecialchars(strip_tags($sBrief));
	}
	if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.$rsRSS["URLAlies"].'/'.$rsRSS["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHeading)."/".$rsRSS["ContentID"];}
	$stDateTimeInserted=$rsRSS["DateTimeInserted"];

	//Date Time
	$timestamp=$rsRSS["DateTimeInserted"];
	$year=substr($timestamp, 0, 4);
	$month=substr($timestamp, 5, 2);
	$day=substr($timestamp, 8, 2);
	$hour=substr($timestamp, 11, 2);
	$min=substr($timestamp, 14, 2);
	$sec=substr($timestamp, 17, 2);
	$pubdate=date('D, d M Y H:i:s +0600', mktime($hour, $min, $sec, $month, $day, $year));

	$body.='
	<item>
		<title><![CDATA['.$sHeading.']]></title>
		<description><![CDATA['.$sBrief.']]></description>
		<link>'.$sURL.'</link>
		<guid isPermaLink="true">'.$sURL.'</guid>
		<pubDate>'.$pubdate.'</pubDate>
	</item>';
}
mysqli_free_result($resultSQL);
$body.='
	</channel>
</rss>';

$path=$UploadHTML_RSS."rss.xml";
$filenum=fopen($path, "w");fwrite($filenum, $body);fclose($filenum);


//Generate RSS for Instant Article
$body="";
$qSQL="SELECT ContentID, ContentSubHeading, ContentHeading, Writers, ContentBrief, ContentDetails, ImageSMPath, ImageBGPath, DATE_FORMAT(DateTimeInserted, '%a, %d %b %Y %T +06:00') AS fDateTimeInserted, DATE_FORMAT(DateTimeUpdated, '%a, %d %b %Y %T +06:00') AS fDateTimeUpdated, DateTimeUpdated, URLAlies FROM bn_content WHERE Deletable=1 AND ShowContent=1 ORDER BY ContentID DESC LIMIT 100";
$resultSQL=mysqli_query($connEMM, $qSQL) or die(mysqli_error($connEMM));

$body='<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
	<title>'.$sSiteName.'</title>
	<link>'.$sSiteURL.'</link>
	<description>Official Web Portal of '.$sSiteName.'</description>
	<language>en-us</language>
	<atom:link href="'.$sSiteURL.'rss/rssfb.xml" rel="self" type="application/rss+xml" />
';

while($rsRSS=mysqli_fetch_assoc($resultSQL)){
	$sSubHead="";$sHead="";$sDetails="";$sWriter="";$sImgTh="";$sImgSM="";$sImgBG="";$sURL="";
	$sHeading=htmlspecialchars(strip_tags($rsRSS["ContentHeading"]));
	if($rsRSS['Writers']!=""){$sWriter=$rsRSS['Writers'];}else{$sWriter=$sAuthor;}
	if($rsRSS["ImageBGPath"]!=""){$sImgSM=$sSiteURL.'media/imgAll/'.$rsRSS["ImageBGPath"];}
	elseif($rsRSS["ImageSMPath"]!=""){$sImgSM=$sSiteURL.'media/imgAll/'.$rsRSS["ImageSMPath"];}
	else{$sImgSM=$sLogoURLfb;}

	if($rsRSS["URLAlies"]!=""){$sURL=$sSiteURL.$rsRSS["URLAlies"].'/'.$rsRSS["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsRSS["ContentID"];}
	//$sBrief=fInstantArticle($rsRSS["ContentBrief"]);
	//$sDetails=fInstantArticle($rsRSS["ContentDetails"]);

	$sDetails=strip_tags($rsRSS["ContentDetails"], '<h2></h2><p></p><img><iframe>&nbsp;');
	$sDetails=preg_replace('#(<[a-z ]*)(style=("|\')(.*?)("|\'))([a-z ]*>)#', '\\1\\6', $sDetails);
	$sDetails=str_replace("../../../", "https://www.coxsbazarsoikat.com/", $sDetails);

	///////////////////////////////////////////////////////////////////////////////////
	//Format all images based on facebook IA docs
	///////////////////////////////////////////////////////////////////////////////////
	$pattern='/(<img([^>]*)>)/i';
	$replacement='<figure>$1</figure>';
	$sDetails=preg_replace($pattern, $replacement, $sDetails);
	$sDetails=preg_replace('/alt=\"(.*)\"/', '', $sDetails);
	$sDetails=preg_replace('/title=\"(.*)\"/', '', $sDetails);
	$sDetails=preg_replace('/width=\"(.*)\"/', '', $sDetails);
	$sDetails=preg_replace('/height=\"(.*)\"/', '', $sDetails);
	$sDetails=str_replace("<p >","<p>",$sDetails);
	$sDetails=str_replace("<p ><figure>","<figure>",$sDetails);
	$sDetails=str_replace("<p><figure>","<figure>",$sDetails);
	$sDetails=str_replace("</figure></p>","</figure>",$sDetails);
	$sDetails=str_replace("  />",">",$sDetails);
	$sDetails=str_replace(" />",">",$sDetails);
	$sDetails=str_replace('width=""','',$sDetails);
	$sDetails=str_replace('height=""','',$sDetails);
	$sDetails=str_replace('alt=""','',$sDetails);
	$sDetails=str_replace("<h2>","<p>",$sDetails);
	$sDetails=str_replace("</h2>","</p>",$sDetails);
	///////////////////////////////////////////////////////////////////////////////////
	//End of image formating
	///////////////////////////////////////////////////////////////////////////////////
	$sDetails=str_replace("</iframe>","",$sDetails);
	$patternVideo='/(<iframe([^>]*)>)/i';
	$replacementVideo='<figure class="op-interactive">$1</iframe></figure>';
	$sDetails=preg_replace($patternVideo, $replacementVideo, $sDetails);
	$sDetails=str_replace("<p><figure", "<figure", $sDetails);
	$sDetails=str_replace("</figure></p>", "</figure>", $sDetails);
	$sDetails=str_replace('src="//www.youtube.com/', 'src="https://www.youtube.com/', $sDetails);

	//Date Time
	$pub_date=$rsRSS["fDateTimeInserted"];
	$update_date=$rsRSS["fDateTimeUpdated"];

	$body.="
	<item>
		<title>".$sHeading."</title>
		<link>".$sURL."</link>
		<guid>".md5($update_date)."</guid>
		<pubDate>".$pub_date."</pubDate>
		<author>".$sWriter."</author>
		<description>".$sDetails."</description>
		<content:encoded>
			<![CDATA[
			<!doctype html>
			<html lang='en' prefix='op: http://media.facebook.com/op#'>
			<head>
				<meta charset='utf-8'>
				<link rel='canonical' href='".$sURL."'>
				<meta property='op:markup_version' content='v1.0'>
				<meta property='fb:use_automatic_ad_placement' content='enable=true ad_density=default'>
			</head>
			<body>
			<article>
				<header>
					<h1>".$sHeading."</h1>
					<time class='op-published' datetime='".$pub_date."'>".$pub_date."</time>
					<time class='op-modified' dateTime='".$update_date."'>".$update_date."</time>
					<address><a>".$sWriter."</a></address>
					<figure><img src='".$sImgSM."'></figure>
				</header>
				<figure class='op-tracker'>
					<iframe hidden>
						<script type='text/javascript'>
							(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
							ga('create', 'UA-11428839-60', 'auto');
							ga('set', 'campaignSource', 'Facebook');
							ga('set', 'campaignMedium', 'Facebook Instant Articles');
							ga('set', 'referrer', 'ia_document.referrer');
							ga('set', 'title', '".$sHeading."');
							ga('send', 'pageview');
						</script>
					</iframe>
				</figure>
				".$sDetails."
				<footer><small>
					<p>&copy; ".fEn2Bn(date('Y'))." সর্বস্বত্ব &reg; সংরক্ষিত। <a href='".$sSiteURL."'>'.$sSiteName.'</a> | এই ওয়েবসাইটের কোনো লেখা, ছবি, ভিডিও অনুমতি ছাড়া ব্যবহার বেআইনি |</p>Developed by <a href='http://www.redsoftbd.com>redsoft<a></small>
				</footer>
			</article>
			</body>
			</html>
			]]>
		</content:encoded>
	</item>";
}
mysqli_free_result($resultSQL);
$body.='
</channel>
</rss>';
//echo $body;

$myFile=$UploadHTML_RSS."rssfb.rss";
$fh=fopen($myFile, "w");fwrite($fh, $body);fclose($fh);

header("Location: ".$_SESSION["sessRedirectPageBN"]);
mysqli_close($connEMM); ?>
</body>
</html>