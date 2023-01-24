<?php
$sInitialBN="";
$sInitialEN="";
$sSiteName="";
$sSiteTitle=" :: - ";
$sAuthor=" :: ";
$sDeveloper="redsoftbd.com";
$sEmail="news@dailytorunkantho.com";
$sTwitSite="@dailytorunkantho.com";
$sTwitAuthor="@dailytorunkantho.com";
$sGooglePlus="https://plus.google.com/+dailytorunkantho";


//Local
// $sSiteURL="http://localhost/District/Coxsbazar-CoxsbazarSoikat/";
// $sCurrURL="http://localhost/District/Coxsbazar-CoxsbazarSoikat".$_SERVER["REQUEST_URI"];

//Web
$sSiteURL="http://www.dailytorunkantho.com/";
$sCurrURL="http://www.dailytorunkantho.com".$_SERVER["REQUEST_URI"];

$dtTimeDifference=6*60*60;
$dtDate=gmdate("Y-m-d", time()+$dtTimeDifference);
$dtTime=gmdate("G:i:s", time()+$dtTimeDifference);
$dtDateTime=gmdate("Y-m-d G:i:s", time()+$dtTimeDifference);
$dtDateTimeRSS=gmdate("D, d M Y", time()+$dtTimeDifference);
$dtDateTimeSchedule=gmdate("Y-m-d G:i:s", time()+$dtTimeDifference);


$iMaxImgSizeContentSM=150; /*KiloByte*/
$iMaxImgSizeContentBG=200; /*KiloByte*/
$iMaxImgSizeGallery=200; /*KiloByte*/
$iMaxImgSizeAdvt=300; /*KiloByte*/
$iMaxImgSizeDoc=2048; /*KiloByte - 2MB*/
$iMaxImgSizeAudio=2020480; /*KiloByte 20MB*/

//Image Width & height in pixel
$iImgThumbWidth=107;
$iImgThumbHeight=60;
$iImgSmWidth=263;
$iImgSmHeight=138;
$iImgBgWidth=700;
$iImgBgHeight=368;


$sLogoURL=$sSiteURL."media/common/logo-torun.png";
$sLogoURLFooter=$sSiteURL."media/common/logo.jpg";
$sLogoURLfb=$sSiteURL."media/common/logo.jpg";
$sFavicon=$sSiteURL."media/common/favicono.icooo.jpg";
$sThumb=$sSiteURL."media/common/thumboo.jpg";


$sPath=$_SERVER["DOCUMENT_ROOT"];
// $sProjDir="/District/Coxsbazar-CoxsbazarSoikat/"; //Local
// $sPathProjDir=$sPath."/District/Coxsbazar-CoxsbazarSoikat/"; //Local
$sProjDir="/"; //Web
$sPathProjDir=$sPath."/"; //Web


$sAdmnTitle="Daily Torunkantho Admin Panel";
$sAdmnDir="adminlog/user/";
$sAdmnPath=$sPath.$sProjDir.$sAdmnDir;
$sAdmnURL=$sSiteURL.$sAdmnDir;


/*If the database and MonthlyImageFolder information is missing the following value will be initialize*/
if(!isset($sImgDir)){$sImgDir="";}
/*Local & Web*/
$UploadImageAll=$sPath.$sProjDir."media/imgAll/".$sImgDir."/";
$UploadImageAllSM=$sPath.$sProjDir."media/imgAll/".$sImgDir."/SM/";
$UploadCategory=$sPath.$sProjDir."media/category/";
/*Image Gallery*/
$UploadPhotoAlbum=$sPath.$sProjDir."media/PhotoGallery/".$sImgDir."/";
$UploadPhotoGallery=$sPath.$sProjDir."media/PhotoGallery/".$sImgDir."/";
/*Web Radio*/
$UploadWebRadio=$sPath.$sProjDir."media/Audio/".$sImgDir."/";
/*HTML files*/
$UploadXHTML_BN=$sPath.$sProjDir."xhtml/";
$UploadXHTML_EN=$sPath.$sProjDir."xhtml/English/";
/*RSS*/
$UploadHTML_RSS=$sPath.$sProjDir."rss/";
$UploadSitemap=$sPath.$sProjDir."sitemap/";


//Local
$cssEMMLogin='<link rel="stylesheet" type="text/css" href="'.$sAdmnURL.'common/css/eMythMakersLogin.css">';
$cssFontAwesomeCSS='<link type="text/css" rel="stylesheet" href="'.$sAdmnURL.'common/font-awesome-4.7.0/css/font-awesome.min.css">';
$cssjQueryUI='<link rel="stylesheet" type="text/css" href="'.$sAdmnURL.'common/jquery-ui-1.12.1/jquery-ui.min.css">';
$cssPTTime='<link rel="stylesheet" type="text/css" href="'.$sAdmnURL.'common/jQuery.ptTimeSelect-0.8/jquery.ptTimeSelect.min.css">';
$cssEMM='<link type="text/css" rel="stylesheet" href="'.$sAdmnURL.'common/css/eMythMakers.css?v='.$dtDateTime.'">';
$cssEMMEn='<link type="text/css" rel="stylesheet" href="'.$sAdmnURL.'common/css/eMythMakersEn.css?v='.$dtDateTime.'">';
$cssChosen='<link rel="stylesheet" type="text/css" href="'.$sAdmnURL.'common/chosen_1.6.2/chosen.min.css">';

$jsjQuery='<script type="text/javascript" src="'.$sAdmnURL.'common/jQuery-2.1.4/jquery-2.1.4.min.js"></script>';
$jsjQueryValidate='<script type="text/javascript" src="'.$sAdmnURL.'common/jQueryValidate-1.17.0/jquery-validation-1.17.0-min.js"></script>';
$jsjQueryUI='<script type="text/javascript" src="'.$sAdmnURL.'common/jquery-ui-1.12.1/jquery-ui.min.js"></script>';
$jsHtml5Shiv='<script type="text/javascript" src="'.$sAdmnURL.'common/IE9/html5shiv.min.js"></script>';
$jsRespond='<script type="text/javascript" src="'.$sAdmnURL.'common/IE9/respond.min.js"></script>';
$jsPTTime='<script type="text/javascript" src="'.$sAdmnURL.'common/jQuery.ptTimeSelect-0.8/jquery.ptTimeSelect.min.js"></script>';
$jsGetSub='<script type="text/javascript" src="'.$sAdmnURL.'common/js/getSubCat.js"></script>';
$jsChosen='<script type="text/javascript" src="'.$sAdmnURL.'common/chosen_1.6.2/chosen.jquery.min.js"></script>';
$jsPrism='<script type="text/javascript" src="'.$sAdmnURL.'common/chosen_1.6.2/docsupport/prism.js"></script>';
$jsCkEditorFull='<script type="text/javascript" src="'.$sAdmnURL.'common/ckeditor_4.9.2_full/ckeditor.js"></script>';
$jsEMM='<script type="text/javascript" src="'.$sAdmnURL.'common/js/eMythMakers.js"></script>';


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
}
function fFormatStringHeading($s){
	global $connEMM;
	/*Passes HTML Code in the texts*/
	if(function_exists("mysqli_real_escape_string")){
		$sStr=mysqli_real_escape_string($connEMM, trim($s));/*Escapes special characters in a string for use in an SQL statement*/
		$sStr=htmlspecialchars($sStr);
		$sStr=htmlentities($sStr);
		$sStr=str_replace("'", "`", $sStr);
	}else{
		$sStr=trim($s);/*Escapes special characters in a string for use in an SQL statement*/
		$sStr=htmlspecialchars($sStr);
		$sStr=htmlentities($sStr);
		$sStr=str_replace("'", "`", $sStr);
	}
	return $sStr;
}
function fFormatStringHTML($s){
	global $connEMM;
	/*Passes HTML Code in the texts*/
	/*Escapes special characters in a string for use in an SQL statement*/
	if(function_exists("mysqli_real_escape_string")){
		$sStr=mysqli_real_escape_string($connEMM, trim($s));
		$sStr=str_replace("../../../", "http://www.dailytorunkantho.com/", $sStr);
		//$sStr=htmlspecialchars($sStr);
		$sStr=str_replace("'", "`", $sStr);
	}else{
		$sStr=trim($s);
		$sStr=str_replace("../../../", "http://www.dailytorunkantho.com/", $sStr);
		//$sStr=htmlspecialchars($sStr);
		$sStr=str_replace("'", "`", $sStr);
	}
	return $sStr;
}
function fFormatURL($s){
	/*Excludes HTML tags from a text*/
	$sStr=trim($s);
	$arrWords=array(":","‘","’","/","'","`","?", "“", '"', ",", "  ", "<", ">", "~", "!", "@", "$", "%", "^", "&", "*", "(", ")", "[", "]", "{", "}", "+", "॥", "ঃ", "।", "&#39;", ".", "..", "...", "....", ";", "#", "lsquo", "rsquo");
	$sStr=str_replace($arrWords, "", $sStr);
	$sStr=strip_tags($sStr);/*Strip HTML and PHP tags from a string*/
	$sStr=html_entity_decode($sStr);
	$sStr=str_replace("   ", " ", $sStr);
	$sStr=str_replace("  ", " ", $sStr);
	$sStr=str_replace(" ", "-", $sStr);
	return $sStr;
}
function fFormatImageName($s){
	/*Excludes HTML tags from a text*/
	$sStr=trim($s);
	$arrWords=array(":","‘","’","/","'","`","?", "“", '"', ",", "  ", "<", ">", "~", "!", "@", "$", "%", "^", "&", "*", "(", ")", "[", "]", "{", "}", "+", "॥", "ঃ", "।", "&#39;", ".", "..", "...", "....", ";", "#", "lsquo", "rsquo");
	$sStr=str_replace($arrWords, "", $sStr);
	$sStr=strip_tags($sStr);/*Strip HTML and PHP tags from a string*/
	$sStr=html_entity_decode($sStr);
	$sStr=str_replace("   ", " ", $sStr);
	$sStr=str_replace("  ", " ", $sStr);
	$sStr=str_replace(" ", "-", $sStr);
	$sStr=$sStr."-".date("ymdHi");
	return $sStr;
}
function fFormatSlug($s){
	/*Excludes HTML tags from a text*/
	$sStr=trim($s);
	$arrWords=array(":","‘","’","/","'","`","?", "“", '"', ",", "  ", "<", ">", "~", "!", "@", "$", "%", "^", "&", "*", "(", ")", "[", "]", "{", "}", "+", "॥", "ঃ", "।", "&#39;", ".", "..", "...", "....", ";", "#", "lsquo", "rsquo");
	$sStr=str_replace($arrWords, "", $sStr);
	$sStr=strip_tags($sStr);/*Strip HTML and PHP tags from a string*/
	$sStr=html_entity_decode($sStr);
	$sStr=str_replace("   ", " ", $sStr);
	$sStr=str_replace("  ", " ", $sStr);
	$sStr=str_replace(" ", "-", $sStr);
	$sStr=strtolower($sStr);
	return $sStr;
}
function fInstantArticle($str){
	$str=strip_tags($str, '<h2></h2><p></p><a></a><img><iframe>&nbsp;');
	$str=preg_replace('#(<[a-z ]*)(style=("|\')(.*?)("|\'))([a-z ]*>)#', '\\1\\6', $str);
	$str=str_replace("../../../", "http://www.dailytorunkantho.com/", $str);
	//echo "1 ".$str."<br>";

	$pattern='/(<img([^>]*)>)/i';
	$replacement='<figure>$1</figure>';
	$str=preg_replace($pattern, $replacement, $str);
	$str=preg_replace('/alt=\"(.*)\"/', '', $str);
	$str=preg_replace('/title=\"(.*)\"/', '', $str);
	$str=preg_replace('/width=\"(.*)\"/', '', $str);
	$str=preg_replace('/height=\"(.*)\"/', '', $str);
	$str=str_replace("<p >","<p>",$str);
	$str=str_replace("<p ><figure>","<figure>",$str);
	$str=str_replace("<p><figure>","<figure>",$str);
	$str=str_replace("</figure></p>","</figure>",$str);
	$str=str_replace("  />",">",$str);
	$str=str_replace(" />",">",$str);
	$str=str_replace('width=""','',$str);
	$str=str_replace('height=""','',$str);
	$str=str_replace('alt=""','',$str);
	$str=str_replace("<h2>","<p>",$str);
	$str=str_replace("</h2>","</p>",$str);
	//echo "2 ".$str."<br>";
	return $sStr;
}
function fFormatHead($s){
	global $connEMM;
	/*Excludes HTML tags from a text*/
	$arrWords=array("&ldquo;", "&rdquo;", "&acute;", "<br>", "<br />", "<p>", "</p>", "</font>", "<blink>", "</blink>", "<font size=5>", "<font size=+5>", "<font size=4>", "<font size=+4>", "<font size=3>", "<font size=+3>", "<font color=black size=2>", "<strong>", "</strong>", "\r", "\n", "\r\n", "&nbsp;", "&rsquo;", "&lsquo;", "<iframe src=", "http:/*www.youtube.com/embed/", "</iframe>", "frameborder=", "width=", "height=", "color: #ff0000;", "<ul>", "</ul>", "<li>", "</li>", "<a href=", "</a>", "<span style=", "</span>", "color: #888888;", "<em>", "</em>", '0', '429', '276', ">", '\">', '\"', "&#39;");
	$sStr=str_replace($arrWords, " ", $sStr);
	$sStr=trim($s);
	$sStr=mysqli_real_escape_string($connEMM, trim($s));/*Escapes special characters in a string for use in an SQL statement*/
	$sStr=strip_tags($sStr);/*Strip HTML and PHP tags from a string*/
	$sStr=htmlspecialchars($sStr);
	$sStr=htmlentities($sStr);
	$sStr=str_replace("'", "`", $sStr);
	$sStr=html_entity_decode($sStr);
	return $sStr;
}
function fEn2Bn($BDDate){
	/*Convert a English date to Bangla date*/
	$en=array("AM","PM","am","pm","Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","January","February","March","April","May","June","July","August","September","October","November","December","0","1","2","3","4","5","6","7","8","9");
	$bn=array("এএম","পিএম","এএম","পিএম","শনিবার","রবিবার","সোমবার","মঙ্গলবার","বুধবার","বৃহস্পতিবার","শুক্রবার","জানুয়ারি","ফেব্রুয়ারি","মার্চ","এপ্রিল","মে","জুন","জুলাই","আগস্ট","সেপ্টেম্বর","অক্টোবর","নভেম্বর","ডিসেম্বর","০","১","২","৩","৪","৫","৬","৭","৮","৯");
	$BDDate=str_replace($en,$bn,$BDDate);
	return $BDDate;
}
function fGetWordsCount($sBrief, $iWordsNo){
	/*Get first 10 words from a lot of words*/
	$sBrief=implode(' ', array_slice(explode(' ', $sBrief), 0, $iWordsNo));
	return $sBrief;
}
function fGetCharCount($sBrief, $iCharNo){
	/*Get first 10 words from a lot of words*/
	$sBrief=substr($sBrief, 0, $iCharNo);
	return $sBrief;
}
function fAuTrail($s){
	/*Converts a query into text*/
	$s=trim(str_replace(",", " -- ", $s));
	$s=trim(str_replace(")", " ", $s));
	$s=trim(str_replace("(", " ", $s));
	$s=trim(str_replace("INSERT", " ", $s));
	$s=trim(str_replace("UPDATE", " ", $s));
	$s=trim(str_replace("DELETE", " ", $s));
	$s=trim(str_replace("SET", " ", $s));
	$s=trim(str_replace("INTO", " ", $s));
	$changeQoute=trim(str_replace("'", " ", $s));
	return $changeQoute;
}

$sMsgInsert="<div align='center' class='DMsgSuccess'>Inserted into the list successfully.</div>";
$sMsgInsertFail="<div align='center' class='DMsgFail'>Error :: Your information was not Inserted.<br />Please ask your web master for help.</div>".mysqli_errno($connEMM).": ".mysqli_error($connEMM);
$sMsgUpdate="<div align='center' class='DMsgSuccess'>Updated the list successfully.</div>";
$sMsgUpdateFail="<div align='center' class='DMsgFail'>Error :: Your information was not Updated.<br />Please ask your web master for help.</div>".mysqli_errno($connEMM).": ".mysqli_error($connEMM);
$sMsgDelete="<div align='center' class='DMsgSuccess'>Deleted from list successfully.</div>";
$sMsgDeleteFail="<div align='center' class='DMsgFail'>Error :: Your information was not Deleted from the list.<br />Please ask your web master for help.</div>".mysqli_errno($connEMM).": ".mysqli_error($connEMM);
$sMsgActivate="<div align='center' class='DMsgSuccess'>Information Activate successfully.</div>";
$sMsgActivateFail="<div align='center' class='DMsgFail'>Error :: Your information was not Activate from the list.<br />Please ask your web master for help.</div>".mysqli_errno($connEMM).": ".mysqli_error($connEMM);

$sMsgUpload="<div align='center' class='DMsgSuccess'>File Uploaded successfully.</div>";
$sMsgUploadFail="<div align='center' class='DMsgFail'>Error :: Your File was not Uploaded successfully.<br />Please ask your web master for help.</div>".mysqli_errno($connEMM).": ".mysqli_error($connEMM);
$sMsgAuTrailInsert="<div align='center' class='DMsgFail'>Insert AuditTrail Error: </div>".mysqli_errno($connEMM).": ".mysqli_error($connEMM);
$sMsgRequired="<span class='SpnRequired'>*</span>";
$sMsgNumber="<span class='SpnNumber'>(Type Number)</span>";

$sMsgImgUpldSizeMaxSM="<div class='DMsgFail'>You cannot upload image file more than $iMaxImgSizeContentSM KB. Please decrease the image file size and try again.</div>";
$sMsgImgUpldSizeMaxBG="<div class='DMsgFail'>You cannot upload image file more than $iMaxImgSizeContentBG KB. Please decrease the image file size and try again.</div>";
$sMsgImgUpldSizeMaxGal="<div class='DMsgFail'>You cannot upload image file more than $iMaxImgSizeGallery KB. Please decrease the image file size and try again.</div>";
$sMsgImgUpldSizeMaxAdvt="<div class='DMsgFail'>You cannot upload image file more than $iMaxImgSizeAdvt KB. Please decrease the image file size and try again.</div>";
$sMsgImgUpldSizeMaxDoc="<div class='DMsgFail'>You cannot upload image file more than $iMaxImgSizeDoc KB. Please decrease the image file size and try again.</div>";
$sMsgImgUpldSizeMaxAudio="<div class='DMsgFail'>You cannot upload image file more than $iMaxImgSizeAudio KB. Please decrease the image file size and try again.</div>";

$sMsgImgInvalidImage="<div class='DMsgFail'>This is an INVALID Image file.</div>";
$sMsgImgInvalidImageExt="<div class='DMsgFail'>This is an INVALID Image file (jpg, jpeg, jpe, gif, png, bmp).</div>";
$sMsgImgInvalidFB="<div class='DMsgFail'>Image dimention must be minimum 600px X 315px</div>";
$sMsgImgInvalidFile="<div class='DMsgFail'>Image file not found</div>";
$sMsgImgInvalidAudio="<div class='DMsgFail'>This is INVALID OGG audio file.</div>";


$sMsgImgHm="<div class='DInfo'>HomePage: ".$iImgSmWidth."px × ".$iImgSmHeight."px<br />(image must be smaller than $iMaxImgSizeContentSM KB)</div>";
$sMsgImgSlide="<div class='DInfo'>Lead:  400px × 225px<br />(image must be smaller than $iMaxImgSizeContentSM KB)</div>";
$sMsgImgInner="<div class='DInfo'>Details Page: maximum width ".$iImgBgWidth."px x ".$iImgBgHeight."px<br>(image must be smaller than $iMaxImgSizeContentBG KB)</div>";
$sMsgImgAll="<div class='DInfo'>media/imgAll/".$sImgDir."/</div>";

$sMsgImgAlbum="<div class='DInfo'>Dimention 300px X 200px<br />(image must be smaller than $iMaxImgSizeGallery KB)</div>";
$sMsgImgGallery="<div class='DInfo'>width/height max 800px X 550px <br />(image must be smaller than $iMaxImgSizeGallery KB)</div>";
$sMsgImgCatIcon="<div class='DInfo'>Dimention: 32px X 32px<br />(image must be smaller than $iMaxImgSizeContentSM KB)</div>";
$sMsgImgCatMenu="<div class='DInfo'>Dimention: 56px X 28px<br />(image must be smaller than $iMaxImgSizeContentSM KB)</div>";
$sMsgImgCatCoverHome="<div class='DInfo'>Dimention: 318px × 28px<br />(image must be smaller than $iMaxImgSizeContentSM KB)</div>";
$sMsgImgCatCoverInner="<div class='DInfo'>Dimention: 980px X 80px<br />(image must be smaller than $iMaxImgSizeContentBG KB)</div>";
?>