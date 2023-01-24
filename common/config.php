<?php
$sInitialBN="তরুণ কণ্ঠ|Torunkantho";
$sInitialEN="তরুণ কণ্ঠ|Torunkantho";
$sSiteName="তরুণ কণ্ঠ|Torunkantho";
$sSiteTitle="তরুণ কণ্ঠ | Torunkantho";
$sAuthor="তরুণ কণ্ঠ | TorunKontho";
$sDeveloper="redsoftbd.com";
$sEmail="torunkanthabd@gmail.com.com";
$sTwitSite="torunkanthabd@gmail.com";
$sTwitAuthor="torunkanthabd@gmail.com";
$sGooglePlus="https://plus.google.com/+ct";

//Local
// $sSiteURL="http://localhost/District/Coxsbazar-CoxsbazarSoikat/";
// $sCurrURL="http://localhost/District/Coxsbazar-CoxsbazarSoikat".$_SERVER["REQUEST_URI"];

//Web
$sSiteURL = "http://www.dailytorunkantho.com/"; 


$dtTimeDifference=6*60*60;
$dtDate=gmdate("Y-m-d", time()+$dtTimeDifference);
$dtDateTime=gmdate("l", time()+$dtTimeDifference)." &nbsp; ".gmdate("d F Y", time()+$dtTimeDifference);
$dtDateTimeF=gmdate("d F, Y H:i:s", time()+$dtTimeDifference);


// //Local
// $sCSSBootStrap='<link rel="stylesheet" type="text/css" href="'.$sSiteURL.'common/bootstrap-3.3.7-dist/css/bootstrap.min.css">';
// $sCSSFontAwesome='<link rel="stylesheet" type="text/css" href="'.$sSiteURL.'common/font-awesome-4.7.0/css/font-awesome.min.css">';
// $sJSjQuery='<script type="text/javascript" src="'.$sSiteURL.'common/jQuery-2.2.4/jquery.min.js"></script>';
// $sJSBootStrap='<script type="text/javascript" src="'.$sSiteURL.'common/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>';
// $sJShtml5shiv='<script type="text/javascript" src="'.$sSiteURL.'common/IE9/html5shiv.min.js"></script>';
// $sJSrespond='<script type="text/javascript" src="'.$sSiteURL.'common/IE9/respond.min.js"></script>';

//Web
$sCSSBootStrap='<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
$sCSSFontAwesome='<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">';
$sJSjQuery='<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>';
$sJSBootStrap='<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
$sJShtml5shiv='<script type="text/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>';
$sJSrespond='<script type="text/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';

//Common

$sCSSEMM='<link rel="stylesheet" type="text/css" href="'.$sSiteURL.'common/css/eMythMakers.css?'.$dtDateTimeF.'">';
$sCSSEMMEn='<link rel="stylesheet" type="text/css" href="'.$sSiteURL.'common/css/eMythMakersEn.css?'.$dtDateTimeF.'">';
$sCSSEMMm='<link rel="stylesheet" type="text/css" href="'.$sSiteURL.'common/css/eMythMakersM.css?'.$dtDateTimeF.'">';
$sJSEMM='<script type="text/javascript" src="'.$sSiteURL.'common/js/eMythMakers.js"></script>';
$sCSSjDatePick='<link rel="stylesheet" type="text/css" href="'.$sSiteURL.'common/jquery.datepick.package-5.1.0/css/jquery.datepick.css">';
$sJSjDatePickPlug='<script type="text/javascript" src="common/jquery.datepick.package-5.1.0/js/jquery.plugin.min.js"></script>';
$sJSjDatePick='<script type="text/javascript" src="common/jquery.datepick.package-5.1.0/js/jquery.datepick.js"></script>';
$sJSSearchJsApi='<script type="text/javascript" src="http://www.google.com/jsapi"></script>';
$sJSSearchPhoneticUnicode='<script type="text/javascript" src="'.$sSiteURL.'common/search/phoneticunicode.js"></script>';
$sJSSearchUnijoy='<script type="text/javascript" src="'.$sSiteURL.'common/search/unijoy.js"></script>';
$sJSSearchCSE='<script type="text/javascript" src="'.$sSiteURL.'common/search/cse-search-box.js"></script>';

$sLogoURL=$sSiteURL."media/common/logo-torun.png";
$sLogoURLFooter=$sSiteURL."media/common/logo-torun.png";
$sLogoURLfb=$sSiteURL."media/common/logo-torun.png";
$sFavicon=$sSiteURL."media/common/favicono.icooo.jpg";
$sThumb=$sSiteURL."media/common/thumboo.jpg";


function fFormatString($s){
	global $connEMM;
	/*Ommits HTML Code from the texts*/
	if(function_exists("mysqli_real_escape_string")){
		$sStr=mysqli_real_escape_string($connEMM, trim($s));/*Escapes special characters in a string for use in an SQL statement*/
		$sStr=strip_tags($sStr);/*Strip HTML and PHP tags from a string*/
		$sStr=str_replace("'", "`", $sStr);
	}else{
		$sStr=trim($s);/*Escapes special characters in a string for use in an SQL statement*/
		$sStr=strip_tags($sStr);/*Strip HTML and PHP tags from a string*/
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
		$sStr=str_replace("'", "&#39;", $sStr);
		$sStr=str_replace("'", "`", $sStr);
	}else{
		$sStr=trim($s);/*Escapes special characters in a string for use in an SQL statement*/
		$sStr=htmlspecialchars($sStr);
		$sStr=str_replace("'", "&#39;", $sStr);
		$sStr=str_replace("'", "`", $sStr);
	}
	return $sStr;
}
function fFormatStringHTML($s){
	global $connEMM;
	/*Passes HTML Code in the texts*/
	if(function_exists("mysqli_real_escape_string")){
		$sStr=mysqli_real_escape_string($connEMM, trim($s));/*Escapes special characters in a string for use in an SQL statement*/
		$sStr=str_replace("'", "`", $sStr);
	}else{
		$sStr=trim($s);/*Escapes special characters in a string for use in an SQL statement*/
		$sStr=str_replace("'", "`", $sStr);
	}
	return $sStr;
}
function fFormatURL($s){
	global $connEMM;
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
function fFormatHead($s){
	global $connEMM;
	/*Excludes HTML tags from a text*/
	$arrWords=array("&ldquo;", "&rdquo;", "&acute;", "<br>", "<br />", "<p>", "</p>", "</font>", "<blink>", "</blink>", "<font size=5>", "<font size=+5>", "<font size=4>", "<font size=+4>", "<font size=3>", "<font size=+3>", "<font color=black size=2>", "<strong>", "</strong>", "\r", "\n", "\r\n", "&nbsp;", "&rsquo;", "&lsquo;", "<iframe src=", "http:/*www.youtube.com/embed/", "</iframe>", "frameborder=", "width=", "height=", "color: #ff0000;", "<ul>", "</ul>", "<li>", "</li>", "<a href=", "</a>", "<span style=", "</span>", "color: #888888;", "<em>", "</em>", '0', '429', '276', ">", '\">', '\"', "&#39;");
	$sStr=trim($s);
	$sStr=mysqli_real_escape_string($connEMM, trim($s));/*Escapes special characters in a string for use in an SQL statement*/
	$sStr=strip_tags($sStr);/*Strip HTML and PHP tags from a string*/
	$sStr=str_replace("'", "`", $sStr);
	$sStr=str_replace($arrWords, " ", $sStr);
	$sStr=html_entity_decode($sStr);
	return $sStr;
}
function fEn2Bn($BDDate){
	/*Convert a English date to Bangla date*/
	$en=array("AM","PM","am","pm","Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Sat","Sun","Mon","Tue","Wed","Thu","Fri","January","February","March","April","May","June","July","August","September","October","November","December","0","1","2","3","4","5","6","7","8","9");
	$bn=array("এএম","পিএম","এএম","পিএম","শনিবার","রোববার","সোমবার","মঙ্গলবার","বুধবার","বৃহস্পতিবার","শুক্রবার","শনি","রোব","সোম","মঙ্গল","বুধ","বৃহস্পতি","শুক্র","জানুয়ারি","ফেব্রুয়ারি","মার্চ","এপ্রিল","মে","জুন","জুলাই","আগস্ট","সেপ্টেম্বর","অক্টোবর","নভেম্বর","ডিসেম্বর","০","১","২","৩","৪","৫","৬","৭","৮","৯");
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
} ?>