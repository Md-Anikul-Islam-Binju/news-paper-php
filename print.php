<?php include_once("common/mysqli_conneCT.php");include_once("common/config.php");
$sHead="";$sSubHead="";$sIntro="";$sPublishedDate="";$sWriters="";
$sImg="";$sImgSmall="";$sImgBig="";$sImgSmallCaption="";$sImgBigCaption="";

if(isset($_REQUEST["nssl"])){
	$iContentID=$_REQUEST["nssl"];
	$iContentID=filter_var($iContentID, FILTER_SANITIZE_NUMBER_INT);
	$iContentID=filter_var($iContentID, FILTER_VALIDATE_INT);

	$sSQL="SELECT bn_content.*, bn_bas_category.*, DATE_FORMAT(bn_content.DateTimeInserted, '%h:%i %p, %e %M %Y %W') AS fDateTimeInserted, DATE_FORMAT(bn_content.DateTimeUpdated, '%h:%i %p, %e %M %Y %W') AS fDateTimeUpdated FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID WHERE bn_content.Deletable=1 AND bn_content.ShowContent=1 AND bn_content.ContentID=".$iContentID." LIMIT 1";
	if(!is_numeric($iContentID)){$sSQL="SELECT bn_content.*, bn_bas_category.*, DATE_FORMAT(bn_content.DateTimeInserted, '%h:%i %p, %e %M %Y %W') AS fDateTimeInserted, DATE_FORMAT(bn_content.DateTimeUpdated, '%h:%i %p, %e %M %Y %W') AS fDateTimeUpdated FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID WHERE bn_content.Deletable=1 AND bn_content.ShowContent=1 ORDER BY ContentID DESC LIMIT 1";}
	if($iContentID<1){$sSQL="SELECT bn_content.*, bn_bas_category.*, DATE_FORMAT(bn_content.DateTimeInserted, '%h:%i %p, %e %M %Y %W') AS fDateTimeInserted, DATE_FORMAT(bn_content.DateTimeUpdated, '%h:%i %p, %e %M %Y %W') AS fDateTimeUpdated FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID WHERE bn_content.Deletable=1 AND bn_content.ShowContent=1 ORDER BY ContentID DESC LIMIT 1";}
}else{
	//If nssl ID not fround
	$sSQL=$sSQL="SELECT bn_content.*, bn_bas_category.*, DATE_FORMAT(bn_content.DateTimeInserted, '%h:%i %p, %e %M %Y %W') AS fDateTimeInserted, DATE_FORMAT(bn_content.DateTimeUpdated, '%h:%i %p, %e %M %Y %W') AS fDateTimeUpdated FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID WHERE bn_content.Deletable=1 AND bn_content.ShowContent=1 ORDER BY ContentID DESC LIMIT 1";
}
$resultSQL=@mysqli_query($connEMM, $sSQL) or die(" ");
if(@mysqli_num_rows($resultSQL)<=0){
	$sSQL=$sSQL="SELECT bn_content.*, bn_bas_category.*, DATE_FORMAT(bn_content.DateTimeInserted, '%h:%i %p, %e %M %Y %W') AS fDateTimeInserted, DATE_FORMAT(bn_content.DateTimeUpdated, '%h:%i %p, %e %M %Y %W') AS fDateTimeUpdated FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID WHERE bn_content.Deletable=1 AND bn_content.ShowContent=1 ORDER BY ContentID DESC LIMIT 1";
	$resultSQL=@mysqli_query($connEMM, $sSQL) or die(" ");
}
//echo $sSQL;
$rsSQL=@mysqli_fetch_assoc($resultSQL);
@mysqli_free_result($resultSQL);

$iContentID=$rsSQL["ContentID"];
$iCategoryID=$rsSQL["CategoryID"];
$sCategory=$rsSQL["CategoryName"];
$sCatSlug=$rsSQL["Slug"];

if($rsSQL["ContentSubHeading"]!=""){$sSubHead="<small>". $rsSQL["ContentSubHeading"]."</small>"; }
if($rsSQL["ContentHeading"]!=""){$sHead=$rsSQL["ContentHeading"];}
if($rsSQL["ContentBrief"]!=""){$sIntro=fFormatString($rsSQL["ContentBrief"]);}else{$sIntro=fGetWordsCount(fFormatString($rsSQL["ContentDetails"]), 40);}
$sInsertDate=fEn2Bn($rsSQL["fDateTimeInserted"]);
$sUpdateDate=fEn2Bn($rsSQL["fDateTimeUpdated"]);
if($rsSQL["Writers"]!=""){$sWriters=$rsSQL["Writers"];}
if($rsSQL["ImageSMPath"]!=""){$sImgSmall=$sSiteURL."media/imgAll/".$rsSQL["ImageSMPath"];$sImg=$sImgSmall;}
if($rsSQL["ImageBGPath"]!=""){$sImgBig=$sSiteURL."media/imgAll/".$rsSQL["ImageBGPath"];$sImg=$sImgBig;}
if($sImgBig!=""){$sImgShow=$sImgBig;}else{$sImgShow=$sImgSmall;}
if($rsSQL["ImageSMPathCaption"]!=""){$sImgSmallCaption=$rsSQL["ImageSMPathCaption"];}
if($rsSQL["ImageBGPathCaption"]!=""){$sImgBigCaption=$rsSQL["ImageBGPathCaption"];}
if($sImgBigCaption!=""){$sCaption=$sImgBigCaption;}elseif($sImgSmallCaption!=""){$sCaption=$sImgSmallCaption;}else{$sCaption="";}
if($rsSQL["ContentDetails"]!=""){$sDetails=$rsSQL["ContentDetails"];}
if($rsSQL["URLAlies"]!=""){$sURLAlies=$rsSQL["URLAlies"];}
$sInitial=$rsSQL["Initial"];

$sCurrURL=$sSiteURL.$sURLAlies."/".$iContentID;
$qHitUpdate="UPDATE bn_totalhit SET TotalHit=TotalHit+1 WHERE ContentID=".$iContentID;
//echo $qTotalHitUpdate;
@mysqli_query($connEMM, $qHitUpdate) or die(""); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo fFormatHead($sHead); ?></title>

<meta name="description" content="<?php echo $sHead; ?>">
<meta name="keywords" content="<?php echo $sIntro; ?>">

<meta http-equiv="refresh" content="300">
<meta name="author" content="<?php echo $sAuthor;?>">

<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="googlebot-news" content="index, follow">

<meta property="fb:app_id" content="2193803980899970">
<meta property="og:site_name" content="<?php echo $sSiteName;?>">
<meta property="og:title" content="<?php echo $sHead; ?>">
<meta property="og:description" content="<?php echo $sIntro; ?>">
<meta property="og:url" content="<?php echo $sCurrURL; ?>">
<meta property="og:type" content="article">
<meta property="og:image" content="<?php echo $sImgShow; ?>">
<meta property="og:locale" content="en_US">

<link rel="canonical" href="<?php echo $sCurrURL; ?>">
<link type="image/x-icon" rel="shortcut icon" href="<?php echo $sFavicon; ?>">
<link type="image/x-icon" rel="icon" href="<?php echo $sFavicon; ?>">

<?php echo $sCSSBootStrap; ?>
<?php echo $sCSSFontAwesome; ?>
<?php echo $sCSSEMM; ?>
</head>
<body onLoad="window.print();">


<div class="container">
<?php include_once("common/headerPrint.php"); ?>

<main>
<div class="row"><div class="col-sm-12">

	<div class="row"><div class="col-sm-12">
		<!--<ol class="breadcrumb">
			<li><a href="<?php echo $sSiteURL; ?>"><i class="fa fa-home fa-lg" aria-hidden="true"></i> প্রচ্ছদ</a></li>
			<li class="active"><a href="<?php echo $sSiteURL.$iCategoryID."/".$sCatSlug; ?>"><?php echo $sCategory; ?></a></li>
		</ol>-->
	</div></div>

	<div class="row"><div class="col-sm-12 DDetailsHeading">
		<h3><?php echo $sSubHead; ?></h3>
		<h1><?php echo $sHead; ?></h1>
		<?php if($sWriters!=""){ ?><p class="pWriter"><i class="fa fa-pencil iInfo"></i> <?php echo $sWriters; ?></p><?php } ?>
		<?php if($sInitial!=""){ ?><p class="pWriter"><i class="fa fa-pencil iInfo"></i> <?php echo $sInitial; ?></p><?php } ?>
		<p class="pDate	"><i class="fa fa-clock-o iInfo"></i> প্রকাশিত : <?php echo fEn2Bn($rsSQL["fDateTimeInserted"]); ?>
		<?php if($rsSQL["fDateTimeUpdated"]!=""){ ?> | <i class="fa fa-clock-o iInfo"></i> আপডেট: <?php echo fEn2Bn($rsSQL["fDateTimeUpdated"]);} ?></p>
	</div></div>

	<div class="row"><div class="col-sm-12">
		<img src="<?php echo $sImgShow; ?>" alt="<?php echo $sCaption; ?>" title="<?php echo $sCaption; ?>" class="img-responsive img100">
		<p class="pCaption"><?php echo $sCaption; ?></p>
	</div></div>

	<div class="row"><div class="col-sm-12">
		<?php echo $sDetails; ?>
	</div></div>

</div></div>
</main>

<?php include_once("common/footer.phppppp");@mysqli_close($connEMM); ?>

</div>

<?php echo $sJSjQuery; ?>
<?php echo $sJSBootStrap; ?>

<!--[if lt IE 9]>
<?php echo $sJShtml5shiv; ?>
<?php echo $sJSrespond; ?>
<![endif]-->
</body>
</html>