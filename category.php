<?php include_once("common/mysqli_conneCT.php");include_once("common/config.php");
$iCategoryID=1;
if(isset($_REQUEST["newstype"])){
	$iCategoryID=fFormatString($_REQUEST["newstype"]);
	$iCategoryID=filter_var($iCategoryID, FILTER_SANITIZE_NUMBER_INT);
	$iCategoryID=filter_var($iCategoryID, FILTER_VALIDATE_INT);
	if(!is_numeric($iCategoryID)){$iCategoryID=1;}
	if($iCategoryID<1){$iCategoryID=1;}
}

$qCategory="SELECT CategoryName, Slug, EndNote FROM bn_bas_category WHERE CategoryID=".$iCategoryID;
$resultCategory=@mysqli_query($connEMM, $qCategory) or die(" ");
if(@mysqli_num_rows($resultCategory)<=0){
	$qCategory="SELECT CategoryName, Slug, EndNote FROM bn_bas_category WHERE CategoryID=1";
	$resultCategory=@mysqli_query($connEMM, $qCategory) or die(" ");
}
$rsCategory=@mysqli_fetch_assoc($resultCategory);
$sCategory=$rsCategory["CategoryName"];
$sCatSlug=$rsCategory["Slug"];
@mysqli_free_result($resultCategory);
$sCurrURL=$sSiteURL.$iCategoryID."/".$sCatSlug."/";

$rowsPerPage=24;$pageNum=1;
if(isset($_REQUEST["page"])){
	$pageNum=$_REQUEST["page"];
	$pageNum=filter_var($pageNum, FILTER_SANITIZE_NUMBER_INT);
	$pageNum=filter_var($pageNum, FILTER_VALIDATE_INT);
	if(!is_numeric($pageNum)){$pageNum=1;}
	if($pageNum<1){$pageNum=1;}
}
$offset=($pageNum-1)*$rowsPerPage;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo $sCategory; ?></title>

<meta name="description" content="<?php echo $sCategory;?>, Bangla and English news from Bangladesh">
<meta name="keywords" content="<?php echo $sCategory;?>, Bangla and English news from Bangladesh">

<meta http-equiv="refresh" content="300">
<meta name="author" content="<?php echo $sAuthor;?>">

<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="googlebot-news" content="index, follow">

<meta property="fb:app_id" content="2193803980899970">
<meta property="og:site_name" content="<?php echo $sSiteName;?>">
<meta property="og:title" content="<?php echo $sCategory;?>">
<meta property="og:description" content="<?php echo $sCategory;?>, Bangla and English news from Bangladesh">
<meta property="og:url" content="<?php echo $sCurrURL; ?>">
<meta property="og:type" content="article">
<meta property="og:image" content="<?php echo $sLogoURLfb; ?>">
<meta property="og:locale" content="en_US">

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
<div class="row">
	<div class="col-sm-8">

		<div class="row"><div class="col-sm-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo $sSiteURL; ?>"><i class="fa fa-home fa-lg Golden" aria-hidden="true"></i> হোম</a></li>
				<li class="active"><a href="<?php echo $sCurrURL; ?>"><?php echo $sCategory; ?></a></li>
			</ol>
		</div></div>

		<section>
		<?php $iCounter=1;$qContent="SELECT ContentID, ContentSubHeading, ContentHeading, ContentBrief, ImageSMPath, URLAlies FROM bn_content WHERE ShowContent=1 AND Deletable=1 AND TopInner=2 AND CategoryID=".$iCategoryID." ORDER BY ContentID DESC LIMIT 1";
		$resultContent=@mysqli_query($connEMM, $qContent) or die("");
		while($rsContent=@mysqli_fetch_assoc($resultContent)){
			$sSubHead="";$sHead="";$sBrief="";$sImg="";$sURL="";

			if($rsContent["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsContent["ContentSubHeading"].'</span><br>';}
			$sHead=$rsContent["ContentHeading"];
			$sBrief=$rsContent["ContentBrief"];
			if($rsContent["ImageSMPath"]!=""){$sImg='<img src="'.$sSiteURL.'media/imgAll/'.$rsContent["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImg='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
			if($rsContent["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsContent["URLAlies"]).'/'.$rsContent["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsContent["ContentID"];}

			if($iCounter==1){ ?>
			<div class="row DCategoryTopNews">
				<div class="col-sm-12">
					<a href="<?php echo $sURL; ?>">
					<?php echo $sSubHead; ?>
					<h1><?php echo $sHead; ?></h1>
					</a>
				</div>
				<div class="col-sm-5">
					<a href="<?php echo $sURL; ?>">
					<?php echo $sBrief; ?>
					</a>
				</div>
				<div class="col-sm-7"><a href="<?php echo $sURL; ?>"><?php echo $sImg; ?></a></div>
			</div>
			<div class="row DMarginTop20">
			<?php }else{
			if( ($iCounter==4) || ($iCounter==6) || ($iCounter==8) ){echo '</div>

			<div class="row DMarginTop20">';}
			?>
				<div class="col-sm-6">
					<div class="row DCategoryTopNews2">
						<div class="col-sm-12"><a href="<?php echo $sURL; ?>"><?php echo $sImg; ?></a></div>
						<div class="col-sm-12">
							<a href="<?php echo $sURL; ?>">
							<?php echo $sSubHead; ?>
							<h4><?php echo $sHead; ?></h4>
							</a>
						</div>
					</div>
				</div>
			<?php }
			$iCounter++;
			}@mysqli_free_result($resultContent); ?>
			</div>
		</section>

		<section>
			<?php $qContent="SELECT ContentID, ContentSubHeading, ContentHeading, ContentBrief, ImageSMPath, URLAlies, DATE_FORMAT(DateTimeInserted, '%h:%i %p, %e %M %Y %W') AS fDateTimeInserted FROM bn_content WHERE ShowContent=1 AND Deletable=1 AND TopInner!=2 AND CategoryID=".$iCategoryID." ORDER BY ContentID DESC LIMIT $offset, $rowsPerPage";
			//echo $qContent;
			$resultContent=@mysqli_query($connEMM, $qContent) or die("");
			while($rsContent=@mysqli_fetch_assoc($resultContent)){
				$sSubHead="";$sHead="";$sBrief="";$sImg="";$sURL="";

				if($rsContent["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsContent["ContentSubHeading"].'</span><br>';}
				$sHead=$rsContent["ContentHeading"];
				$sBrief=$rsContent["ContentBrief"];
				if($rsContent["ImageSMPath"]!=""){$sImg='<img src="'.$sSiteURL.'media/imgAll/'.$rsContent["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImg='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
				if($rsContent["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsContent["URLAlies"]).'/'.$rsContent["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsContent["ContentID"];}
				$sDateTime=$rsContent["fDateTimeInserted"]; ?>

			<div class="DCategoryListNews">
				<div class="row">
					<div class="col-sm-4"><a href="<?php echo $sURL; ?>"><?php echo $sImg; ?></a></div>
					<div class="col-sm-8">
						<a href="<?php echo $sURL; ?>">
						<?php echo $sSubHead; ?>
						<h3 class="H3Head"><?php echo $sHead; ?></h3>
						</a>
						<?php echo $sBrief; ?>
						<p class="DDate"><?php echo fEn2Bn($sDateTime); ?></p>
					</div>
				</div>
			</div>
			<?php }@mysqli_free_result($resultContent); ?>
		</section>

		<div class="row MarginTop20">
	<?php if($iCategoryID>0){$qCoutner="SELECT COUNT(ContentID) AS numrows FROM bn_content WHERE CategoryID=".$iCategoryID." AND ShowContent=1 AND Deletable=1";
	}else{$qCoutner="SELECT COUNT(ContentID) AS numrows FROM bn_content WHERE Deletable=1";}
	$result=@mysqli_query($connEMM, $qCoutner) or die("Error...");
	$row=@mysqli_fetch_assoc($result);
	$numrows=$row["numrows"];
	$maxPage=ceil($numrows/$rowsPerPage);
	$self=$_SERVER["PHP_SELF"];$nav="";

	for($page=1;$page<=$maxPage;$page++){if($page==$pageNum){$nav.=" $page ";}else{$nav.=" <a href=\"$self?newstype=$iCategoryID&page=$page\">$page</a> ";}}
	if($pageNum>1){
		$page=$pageNum-1;
		$prev=' <a class="page-link" tabindex="-1" aria-label="Previous" href="'.$sSiteURL.'category.php?newstype='.$iCategoryID.'&page='.$page.'"><span>&laquo; আগের পাতা</span> <span class="sr-only">আগের পাতা</span></a> ';
	}else{$prev="&nbsp;";$first="&nbsp;";}
	if($pageNum<$maxPage){
		$page=$pageNum+1;
		$next=' <a class="page-link" aria-label="Next" href="'.$sSiteURL.'category.php?newstype='.$iCategoryID.'&page='.$page.'"><span aria-hidden="true">পরের পাতা &raquo;</span> <span class="sr-only">পরের পাতা</span></a> ';
	}else{$next="&nbsp;";$last="&nbsp;";}@mysqli_free_result($result); ?>

			<div class="col-sm-3">
				<nav><ul class="pagination"><li class="page-item"><?php echo $prev; ?></li></ul></nav>
			</div>
			<div class="col-sm-3 col-sm-offset-6 text-right">
				<nav><ul class="pagination"><li class="page-item"><?php echo $next; ?></li></ul></nav>
			</div>
		</div>

		<div class="row"><div class="col-sm-12 DEndNote">
			<?php echo $rsCategory["EndNote"]; ?>
		</div></div>

		<div class="row DMarginT30"><div class="col-sm-12">
			<div class="addthis_relatedposts_inline"></div>
		</div></div>
	</div>



	<!--RightSide-->
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
		<div class="row DMarginTop20"><div class="col-sm-12 DMoreNewsImg">
			<div class="DHeadTop border_bottom">এই বিভাগের জনপ্রিয়</div>
				<?php $sSQL="SELECT bn_content.ContentID, bn_content.ContentSubHeading, bn_content.ContentHeading, bn_content.ImageSMPath, bn_content.URLAlies FROM bn_content INNER JOIN bn_totalhit ON bn_totalhit.ContentID=bn_content.ContentID WHERE bn_content.ShowContent=1 AND bn_content.Deletable=1 AND bn_content.CategoryID=".$iCategoryID." AND bn_content.DateTimeInserted>=DATE(NOW())-INTERVAL 700 DAY ORDER BY bn_totalhit.TotalHit DESC LIMIT 10";
				$resultSQL=@mysqli_query($connEMM, $sSQL) or die(" ");
				while($rsSQL=@mysqli_fetch_assoc($resultSQL)){
				$sSubHead="";$sHead="";$sImg="";$sURL="";

				if($rsSQL["ContentSubHeading"]!=""){$sSubHead='<span class="spnSubHead">'.$rsSQL["ContentSubHeading"].'</span><br>';}
				if($rsSQL["ContentHeading"]!=""){$sHead=$rsSQL["ContentHeading"];}
				if($rsSQL["ImageSMPath"]!=""){$sImg='<img src="'.$sSiteURL.'media/imgAll/'.$rsSQL["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImg='<img src="'.$sSiteURL.'media/common/thumb.jpg" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
				if($rsSQL["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsSQL["URLAlies"]).'/'.$rsSQL["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsSQL["ContentID"];}
				?>
				<div class="row">
					<div class="col-sm-4"><a href="<?php echo $sURL; ?>"><?php echo $sImg; ?></a></div>
					<div class="col-sm-8"><a href="<?php echo $sURL; ?>"><?php echo $sSubHead.$sHead; ?></a></div>
				</div>
				<?php }@mysqli_free_result($resultSQL); ?>
			</div>
		</section>

	</div>
</div>
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
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5bdfe13c32a4ade7"></script>

</body>
</html>