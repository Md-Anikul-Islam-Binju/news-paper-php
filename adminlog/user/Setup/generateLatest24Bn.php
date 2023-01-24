<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Generated Latest 50 Content (Bangla)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">

<div class="DContent">
	<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl98">
	<tr><td align="left" valign="top">
	<?php
	//Most Popular 50 News
	$sData="";$sList="";$sSubHead="";$sHead="";$sURL="";

	$resultSQL=mysqli_query($connEMM, "SELECT bn_content.ContentID, bn_content.ContentSubHeading, bn_content.ContentHeading, bn_content.URLAlies FROM bn_content INNER JOIN bn_totalhit ON bn_totalhit.ContentID=bn_content.ContentID WHERE Deletable=1 AND ShowContent=1 ORDER BY bn_totalhit.TotalHit DESC LIMIT 50");

	$sData.='<ul class="UlTopList">';
	while($rsSQL=mysqli_fetch_assoc($resultSQL)){
		$sSubHead="";$sHead="";$sURL="";
		if(!empty($rsSQL["ContentSubHeading"])){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>'; }
		if(!empty($rsSQL["ContentHeading"])){$sHead=$rsSQL["ContentHeading"];}
		$sURL=$sSiteURL.$rsSQL["URLAlies"].'/'.$rsSQL["ContentID"];

		$sList.='<li><a href="'.$sURL.'">'.$sSubHead.$sHead.'</a></li>';
	}mysqli_free_result($resultSQL);
	$sData.=$sList.'</ul>';
	//echo $sData."<br><br>";

	$myFile=$UploadXHTML_BN."liMostPopular.htm";
	$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);

	echo "Latest 50 content (Bangla) generated"; ?>
	</td></tr>
	</table>
</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>