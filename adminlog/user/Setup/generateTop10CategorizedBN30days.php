<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Generated Top 10 content (Bangla)</title>
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
	$qCategory="SELECT CategoryID FROM bn_bas_category WHERE ShowData=1 AND Deletable=1 ORDER BY CategoryID";
	$resultCategory=mysqli_query($connEMM, $qCategory) or die(mysql_error($connEMM));
	while($rsCategory=mysqli_fetch_assoc($resultCategory)){
		$iCatID=$rsCategory["CategoryID"];
		$myFile=$UploadXHTML_BN."Top/cat_".$iCatID.".htm";
		$fh=fopen($myFile, "w");
		$sData="";$sList="";

		$sData.='<div class="media">';
		$qSQL="SELECT bn_content.ContentID, bn_content.ContentSubHeading, bn_content.ContentHeading, bn_content.ImageSMPath, bn_totalhit.TotalHit FROM bn_totalhit INNER JOIN bn_content ON bn_totalhit.ContentID=bn_content.ContentID WHERE bn_content.CategoryID=".$iCatID." ORDER BY bn_totalhit.TotalHit ASC LIMIT 10";
		$resultSQL=mysqli_query($connEMM, $qSQL) or die(mysqli_error($connEMM));
		while($rsSQL=mysqli_fetch_assoc($resultSQL)){
			$sSubHead="";$sHead="";$sImg="";$sURL="";
			if(!empty($rsSQL["ContentSubHeading"])){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>'; }
			if(!empty($rsSQL["ContentHeading"])){$sHead=$rsSQL["ContentHeading"];}
			if(!empty($rsSQL["ImageSMPath"])){$sImg='<img class="media-images" src='.$sSiteURL.'media/imgAll/'.$rsSQL["ImageSMPath"].' alt="'.$sHead.'" title="'.$sHead.'">';}
			$sURL=$sSiteURL.'details.php?nssl='.$rsSQL["ContentID"];
			$sData.='<div class="media-left"><a href="'.$sURL.'">'.$sImg.'</a></div>
			<div class="media-body media-heading"><a href="'.$sURL.'">'.$sSubHead.$sHead.'</a></div>';
		}mysqli_free_result($resultSQL);
		$sData.='</div>';

		//echo $sData."<br><br>";
		fwrite($fh, $sData);fclose($fh);
	}

	echo "Top 10 Categorized list (Bangla) generated"; ?>
	</td></tr>
	</table>
</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>