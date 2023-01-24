<?php include_once("common/mysqli_conneCT.php");include_once("common/config.php");
$sHead="";$sSubHead="";$sIntro="";$sPublishedDate="";$sWriters="";
$sImg="";$sImgSmall="";$sImgBig="";$sImgSmallCaption="";$sImgBigCaption="";

if(isset($_REQUEST["nssl"])){
	$iContentID=$_REQUEST["nssl"];
	$iContentID=filter_var($iContentID, FILTER_SANITIZE_NUMBER_INT);
	$iContentID=filter_var($iContentID, FILTER_VALIDATE_INT);

	$sSQL="SELECT bn_content.*, bn_bas_category.*, DATE_FORMAT(bn_content.DateTimeInserted, '%e %M %Y') AS fDateTimeInserted, DATE_FORMAT(bn_content.DateTimeUpdated, '%e %M %Y') AS fDateTimeUpdated, bn_totalhit.TotalHit FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID INNER JOIN bn_totalhit ON bn_totalhit.ContentID=bn_content.ContentID WHERE bn_content.Deletable=1 AND bn_content.ShowContent=1 AND bn_content.ContentID=".$iContentID." LIMIT 1";
	if(!is_numeric($iContentID)){$sSQL="SELECT bn_content.*, bn_bas_category.*, DATE_FORMAT(bn_content.DateTimeInserted, '%e %M %Y') AS fDateTimeInserted, DATE_FORMAT(bn_content.DateTimeUpdated, '%e %M %Y') AS fDateTimeUpdated, bn_totalhit.TotalHit FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID INNER JOIN bn_totalhit ON bn_totalhit.ContentID=bn_content.ContentID WHERE bn_content.Deletable=1 AND bn_content.ShowContent=1 ORDER BY ContentID DESC LIMIT 1";}
	if($iContentID<1){$sSQL="SELECT bn_content.*, bn_bas_category.*, DATE_FORMAT(bn_content.DateTimeInserted, '%e %M %Y') AS fDateTimeInserted, DATE_FORMAT(bn_content.DateTimeUpdated, '%e %M %Y') AS fDateTimeUpdated, bn_totalhit.TotalHit FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID INNER JOIN bn_totalhit ON bn_totalhit.ContentID=bn_content.ContentID WHERE bn_content.Deletable=1 AND bn_content.ShowContent=1 ORDER BY ContentID DESC LIMIT 1";}
}else{
	//If nssl ID not fround
	$sSQL=$sSQL="SELECT bn_content.*, bn_bas_category.*, DATE_FORMAT(bn_content.DateTimeInserted, '%e %M %Y') AS fDateTimeInserted, DATE_FORMAT(bn_content.DateTimeUpdated, '%e %M %Y') AS fDateTimeUpdated, bn_totalhit.TotalHit FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID INNER JOIN bn_totalhit ON bn_totalhit.ContentID=bn_content.ContentID WHERE bn_content.Deletable=1 AND bn_content.ShowContent=1 ORDER BY ContentID DESC LIMIT 1";
}
$resultSQL=@mysqli_query($connEMM, $sSQL) or die(" ");
if(@mysqli_num_rows($resultSQL)<=0){
	$sSQL=$sSQL="SELECT bn_content.*, bn_bas_category.*, DATE_FORMAT(bn_content.DateTimeInserted, '%e %M %Y') AS fDateTimeInserted, DATE_FORMAT(bn_content.DateTimeUpdated, '%e %M %Y') AS fDateTimeUpdated, bn_totalhit.TotalHit FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID INNER JOIN bn_totalhit ON bn_totalhit.ContentID=bn_content.ContentID WHERE bn_content.Deletable=1 AND bn_content.ShowContent=1 ORDER BY ContentID DESC LIMIT 1";
	$resultSQL=@mysqli_query($connEMM, $sSQL) or die(" ");
}
//echo $sSQL;
$rsSQL=@mysqli_fetch_assoc($resultSQL);
@mysqli_free_result($resultSQL);

$iContentID=$rsSQL["ContentID"];
$iCategoryID=$rsSQL["CategoryID"];
$sCategory=$rsSQL["CategoryName"];
$sCatSlug=$rsSQL["Slug"];

$sInitial=$rsSQL["Initial"];
if($rsSQL["ContentSubHeading"]!=""){$sSubHead=$rsSQL["ContentSubHeading"]; }
$sHead=$rsSQL["ContentHeading"];
if($rsSQL["ContentBrief"]!=""){$sIntro=fFormatString($rsSQL["ContentBrief"]);}else{$sIntro=fGetWordsCount(fFormatString($rsSQL["ContentDetails"]), 40);}
$sWriters=$rsSQL["Writers"];
if($rsSQL["ContentDetails"]!=""){$sDetails=$rsSQL["ContentDetails"];}
if($rsSQL["ImageSMPath"]!=""){$sImgSmall=$sSiteURL."media/imgAll/".$rsSQL["ImageSMPath"];$sImg=$sImgSmall;}
if($rsSQL["ImageBGPath"]!=""){$sImgBig=$sSiteURL."media/imgAll/".$rsSQL["ImageBGPath"];$sImg=$sImgBig;}
if($sImgBig!=""){$sImgShow=$sImgBig;}else{$sImgShow=$sImgSmall;}
if($rsSQL["ImageSMPathCaption"]!=""){$sImgSmallCaption=$rsSQL["ImageSMPathCaption"];}
if($rsSQL["ImageBGPathCaption"]!=""){$sImgBigCaption=$rsSQL["ImageBGPathCaption"];}
if($sImgBigCaption!=""){$sCaption=$sImgBigCaption;}elseif($sImgSmallCaption!=""){$sCaption=$sImgSmallCaption;}else{$sCaption="";}
if($rsSQL["VideoPath"]!=""){$sVideo=$rsSQL["VideoPath"];}
if($rsSQL["URLAlies"]!=""){$sURLAlies=$rsSQL["URLAlies"];}
$sInsertDate=fEn2Bn($rsSQL["fDateTimeInserted"]);
$sUpdateDate=fEn2Bn($rsSQL["fDateTimeUpdated"]);
$iTotalHit=fEn2Bn($rsSQL["TotalHit"]);

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

<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@<?php echo $sAuthor; ?>">
<meta name="twitter:creator" content="@eMythMakers.com">
<meta name="twitter:title" content="<?php echo $sHead; ?>">
<meta name="twitter:description" content="<?php echo $sIntro; ?>">
<meta name="twitter:image" content="<?php echo $sImgShow; ?>">
<meta name="twitter:url" content="<?php echo $sCurrURL; ?>">

<link rel="canonical" href="<?php echo $sCurrURL; ?>">
<link type="image/x-icon" rel="shortcut icon" href="<?php echo $sFavicon; ?>">
<link type="image/x-icon" rel="icon" href="<?php echo $sFavicon; ?>">

<?php echo $sCSSBootStrap; ?>
<?php echo $sCSSFontAwesome; ?>
<?php echo $sCSSEMM; ?>
<link rel="stylesheet" type="text/css" href="<?php echo $sSiteURL; ?>common/css/SolaimanLipi.css">
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id){var js, fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)) return;js=d.createElement(s);js.id=id;js.src='https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=2193803980899970&autoLogAppEvents=1';fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>

<div class="container">
<?php include_once("common/header.php"); ?>

<main>
<section>
<div class="row">
	<div class="col-sm-8">
		<div class="row"><div class="col-sm-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo $sSiteURL; ?>"><i class="fa fa-home fa-lg" aria-hidden="true"></i> হোম</a></li>
				<li class="active"><a href="<?php echo $sSiteURL.$iCategoryID."/".$sCatSlug; ?>"><?php echo $sCategory; ?></a></li>
			</ol>
		</div></div>

		<div class="row DDetailsNews">
			<div class="col-sm-12">
				<span style="float:right;"><i class="fa fa-eye"></i> <?php echo $iTotalHit; ?></span>
				<h3><?php echo $sSubHead; ?></h3>
				<h1><?php echo $sHead; ?></h1>

				<div class="row"><div class="col-sm-12"><p class="pWriter"><?php echo $rsSQL["Writers"]; ?></p></div></div>

				<div class="row">
					<div class="col-sm-7 DDateDetails"><p>
					প্রকাশিত: <?php echo $sInsertDate; ?> &nbsp;
					<?php if($sUpdateDate!=""){ ?>আপডেট: <?php echo $sUpdateDate; ?><?php } ?></p>
					</div>
					<div class="col-sm-5 DSocialTop" align="right"><div class="addthis_inline_share_toolbox"></div></div>
				</div>

				<div class="DAdditionalInfo">
					<div class="row">
						<div class="col-sm-4 col-sm-offset-8 text-right">
							<a href="<?php echo $sSiteURL; ?>print.php?nssl=<?php echo $iContentID; ?>" title="Print this article"><i class="fa fa-print fa-lg" aria-hidden="true"></i></a>
							<button id="btnDecrease">A-</button>
							<button id="btnOriginal">A</button>
							<button id="btnIncrease">A+</button>
						</div>
					</div>
				</div>

				<div class="row"><div class="col-sm-12">
					<img src="<?php echo $sImgShow; ?>" alt="<?php echo $sCaption; ?>" title="<?php echo $sCaption; ?>" class="img-responsive img100">
					<p class="pCaption"><?php echo $sCaption; ?></p>
				</div></div>

				<div class="row"><div class="col-sm-12 DDetailsBody" id="DDetailsBody">
					<?php echo $sDetails; ?>
				</div></div>

				<?php if($sVideo!=""){ ?>
				<div class="row"><div class="col-sm-12">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $sVideo; ?>?rel=0" allowfullscreen></iframe>
					</div>
				</div></div>
				<?php } ?>

			</div>
		</div>

		<div class="row"><div class="col-sm-12 DSocialBottom"><div class="addthis_inline_share_toolbox"></div></div></div>

		<div class="row DMarginT30"><div class="col-sm-12">
			<div class="fb-comments" data-href="<?php echo $sCurrURL; ?>" data-numposts="3"></div>
		</div></div>

		<div class="row DMarginT30"><div class="col-sm-12">
			<div class="addthis_relatedposts_inline"></div>
		</div></div>
	</div>



	<div class="col-sm-4">
		<div class="row"><div class="col-sm-12">
			<div class="fb-page" data-href="https://www.facebook.com/dailytorunkantho/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/dailytorunkantho/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/dailytorunkantho/">তরুণ কণ্ঠ :: TorunKontho</a></blockquote></div>
		</div></div>

	<section>
	<div class="DLPSTab panel panel-default DMarginTop20">
		<div class="panel-heading">
			<ul  class="nav nav-pills">
				<li class="active"><a href="#1b" data-toggle="tab"><p>সর্বশেষ</p></a></li>
				<li><a href="#2b" data-toggle="tab"><p>জনপ্রিয়</p></a></li>
			</ul>
		</div>
		<div class="panel-body latestPanelDefault">
			<div class="tab-content clearfix">
				<div class="tab-pane active" id="1b">
					<ul class="LatestNewsList"><?php include_once("xhtml/bn_liLatestNews.htm"); ?></ul>
				</div>
				<div class="tab-pane" id="2b">
					<ul class="LatestNewsList"><?php include_once("xhtml/bn_liMostPopular.htm"); ?></ul>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo $sSiteURL; ?>archives"><button type="button" class="btn btnAllNews">সকল খবর জানতে এখানে ক্লিক করুন <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button></a>
	</section>

		<section>
		<div class="row DMarginTop20"><div class="col-sm-12 DMoreNews">
			<div class="DHeadTop border_bottom">এই বিভাগের আরো খবর</div>
			<ul>
<?php
//Most Popular 15 News
$sData="";$sSubHead="";$sHead="";$sImg="";$sURL="";
$resultSQL=@mysqli_query($connEMM, "SELECT bn_content.ContentID, bn_content.ContentSubHeading, bn_content.ContentHeading, bn_content.ImageSMPath, bn_content.URLAlies FROM bn_content INNER JOIN bn_totalhit ON bn_totalhit.ContentID=bn_content.ContentID WHERE bn_content.Deletable=1 AND bn_content.ShowContent=1 AND bn_content.CategoryID=".$iCategoryID." ORDER BY bn_totalhit.TotalHit DESC LIMIT 15");

while($rsSQL=@mysqli_fetch_assoc($resultSQL)){
$sSubHead="";$sHead="";$sImg="";$sURL="";
if($rsSQL["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>'; }
if($rsSQL["ContentHeading"]!=""){$sHead=$rsSQL["ContentHeading"];}
if($rsSQL["ImageSMPath"]!=""){$sImg='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImg='<img src="'.$sSiteURL.'media/common/logo-torun.png" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsSQL["URLAlies"]).'/'.$rsSQL["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsSQL["ContentID"];}
?>
			<li><a href="<?php echo $sURL; ?>"><?php echo $sSubHead.$sHead; ?></a></li>
<?php }@mysqli_free_result($resultSQL); ?>
			</ul>
		</div></div>
		</section>
	</div>
</div>
</section>
</main>

<?php include_once("common/footer.php");@mysqli_close($connEMM); ?>
</div>

<div class="Back-up-top">
<a id="back-to-top" href="#" class="btn btn-danger back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
</div>

<?php echo $sJSjQuery; ?>
<?php echo $sJSBootStrap; ?>

<!--[if lt IE 9]>
<?php echo $sJShtml5shiv; ?>
<?php echo $sJSrespond; ?>
<![endif]-->

<?php echo $sJSEMM; ?>

<script type="text/javascript">
$(function(){
	$("#btnIncrease").click(function(){
		$(".DDetailsBody").children().each(function(){
			var size=parseInt($(this).css("font-size"));
			size=size+1+"px";
			$(this).css({'font-size': size});
		});
	});
});
$(function(){
	$("#btnOriginal").click(function(){
		$(".DDetailsBody").children().each(function(){
			$(this).css({'font-size': '18px'});
		});
	});
});
$(function(){
	$("#btnDecrease").click(function(){
		$(".DDetailsBody").children().each(function(){
			var size=parseInt($(this).css("font-size"));
			size=size - 1+"px";
			$(this).css({'font-size': size});
		});
	});
});
</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5bdfe13c32a4ade7"></script>

</body>
</html>