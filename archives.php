<?php include_once("common/mysqli_conneCT.php");include_once("common/config.php");
$iCategoryID=0;
$sDate="";
if(isset($_REQUEST["dtDate"])){$sDate=$_REQUEST["dtDate"];}
if(isset($_REQUEST["catid"])){
	$iCategoryID=$_REQUEST["catid"];
	if(!is_numeric($iCategoryID)){$iCategoryID=0;}
	if($iCategoryID<0){$iCategoryID=0;}
}
if($iCategoryID>0){
	$qCategory="SELECT CategoryName, Remarks FROM bn_bas_category WHERE CategoryID=".$iCategoryID;
	$resultCategory=@mysqli_query($connEMM, $qCategory) or die(" ");
	if(@mysqli_num_rows($resultCategory)<=0){
		$iCategoryID=1;
		$qCategory="SELECT CategoryName, Remarks FROM bn_bas_category WHERE CategoryID=".$iCategoryID;
		$resultCategory=@mysqli_query($connEMM, $qCategory) or die(" ");
	}
	$rsCategory=@mysqli_fetch_assoc($resultCategory);
	@mysqli_free_result($resultCategory);

	$sCategory=$rsCategory["CategoryName"];
	$sCatRemarks=$rsCategory["Remarks"];
}elseif($iCategoryID==0){
	$sCategory="আর্কাইভস";
	$sCatRemarks="archives";
}

$rowsPerPage=24;$pageNum=1;
if(isset($_REQUEST["page"])){
	$pageNum=fFormatString($_REQUEST["page"]);
	$pageNum=filter_var($pageNum, FILTER_SANITIZE_NUMBER_INT);
	$pageNum=filter_var($pageNum, FILTER_VALIDATE_INT);
	if(!is_numeric($pageNum)){$pageNum=1;}
	if($pageNum<1){$pageNum=1;}
}

$offset=($pageNum-1)*$rowsPerPage;
$pageNumBn=fEn2Bn($pageNum);
$sArchives=" আর্কাইভস ";
$sCurrURL=$sSiteURL."archives"; ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo $sCategory.$sArchives.$pageNumBn; ?></title>

<meta name="description" content="<?php echo $sCategory.$sArchives.$pageNumBn; ?>">
<meta name="keywords" content="<?php echo $sCategory.$sArchives.$pageNumBn; ?>">

<meta http-equiv="refresh" content="300">
<meta name="author" content="<?php echo $sAuthor;?>">

<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="googlebot-news" content="index, follow">

<meta property="fb:app_id" content="2193803980899970">
<meta property="og:site_name" content="<?php echo $sSiteName;?>">
<meta property="og:title" content="<?php echo $sCategory.$sArchives.$pageNumBn; ?>">
<meta property="og:description" content="<?php echo $sCategory.$sArchives.$pageNumBn; ?>">
<meta property="og:url" content="<?php echo $sCurrURL; ?>">
<meta property="og:type" content="article">
<meta property="og:image" content="<?php echo $sLogoURLfb;?>">
<meta property="og:locale" content="en_US">

<link rel="canonical" href="<?php echo $sCurrURL; ?>">
<link type="image/x-icon" rel="shortcut icon" href="<?php echo $sFavicon; ?>">
<link type="image/x-icon" rel="icon" href="<?php echo $sFavicon; ?>">

<?php echo $sCSSBootStrap; ?>
<?php echo $sCSSFontAwesome; ?>
<?php echo $sCSSEMM; ?>
<link rel="stylesheet" type="text/css" href="<?php echo $sSiteURL; ?>common/css/SolaimanLipi.css">

<?php echo $sJSjQuery; ?>
<?php echo $sJSBootStrap; ?>

<!--[if lt IE 9]>
<?php echo $sJShtml5shiv; ?>
<?php echo $sJSrespond; ?>
<![endif]-->

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.css">
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function(){
$("#dtDate").datepicker({changeMonth: true,changeYear: true});
$("#dtDate").datepicker("option", "dateFormat", "yy-mm-dd");
});
</script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id){var js, fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)) return;js=d.createElement(s);js.id=id;js.src='https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=2193803980899970&autoLogAppEvents=1';fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>

<div class="container">
<?php include_once("common/header.php");?>

<main>
<div class="row">
	<div class="col-sm-8 paddingLeft0">

		<ol class="breadcrumb">
			<li><a href="<?php echo $sSiteURL; ?>"><i class="fa fa-home fa-lg Golden" aria-hidden="true"></i></a></li>
			<li class="active"><a href="<?php if($iCategoryID==0){echo $sCurrURL;}else{echo $sSiteURL.$iCategoryID."/".$sCatRemarks;} ?>"><?php echo $sCategory; ?></a></li>
		</ol>

		<div class="row"><div class="col-sm-12 MarginTop20 text-center">
			<?php $resultCategory=mysqli_query($connEMM, "SELECT CategoryID, CategoryName FROM bn_bas_category WHERE Deletable=1 ORDER BY CategoryName") or die(mysqli_error($connEMM)); ?>
			<form name="frmArchives" method="post" action="<?php echo $sSiteURL; ?>archives/" class="form-inline">
			<div class="form-group">
				<select name="catid" class="form-control cboCatName">
					<option value="0">সকল খবর</option>
					<?php while($rsCategory=mysqli_fetch_assoc($resultCategory)){ ?>
					<option value="<?php echo $rsCategory["CategoryID"]; ?>" <?php if($rsCategory["CategoryID"]==$iCategoryID){echo "selected";} ?>><?php echo $rsCategory["CategoryName"]; ?></option>
					<?php }mysqli_free_result($resultCategory); ?>
				</select>
			</div>
			<div class="form-group">
				<label for="dtDate"> তারিখ:</label>
				<input type="text" name="dtDate" id="dtDate" class="form-control" value="<?php if(isset($_REQUEST["dtDate"])){echo $sDate;}?>">
			</div>
			<button type="submit" class="btn btn-primary btnSearch">খুঁজুন</button>
			</form> 
		</div></div>

		<div class="row"><div class="col-sm-12">
			<?php
			if( ($iCategoryID==0) && ($sDate=="") ){
				$qContent="SELECT bn_content.ContentID, bn_content.CategoryID, bn_bas_category.CategoryName, bn_bas_category.Slug, bn_content.ContentHeading, bn_content.ContentSubHeading, bn_content.ContentBrief, bn_content.ImageSMPath, bn_content.URLAlies, DATE_FORMAT(bn_content.DateTimeInserted, '%h:%i %p, %e %M %Y %W') AS fDateTimeInserted FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID WHERE bn_content.ShowContent=1 AND bn_content.Deletable=1 ORDER BY bn_content.ContentID DESC LIMIT $offset, $rowsPerPage";
			}elseif( ($iCategoryID>0) && ($sDate=="") ){
				$qContent="SELECT bn_content.ContentID, bn_content.CategoryID, bn_bas_category.CategoryName, bn_bas_category.Slug, bn_content.ContentHeading, bn_content.ContentSubHeading, bn_content.ContentBrief, bn_content.ImageSMPath, bn_content.URLAlies, DATE_FORMAT(bn_content.DateTimeInserted, '%h:%i %p, %e %M %Y %W') AS fDateTimeInserted FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID WHERE bn_content.ShowContent=1 AND bn_content.Deletable=1 AND bn_content.CategoryID=".$iCategoryID." ORDER BY bn_content.ContentID DESC LIMIT $offset, $rowsPerPage";
			}elseif( ($iCategoryID==0) && ($sDate!="") ){
				$qContent="SELECT bn_content.ContentID, bn_content.CategoryID, bn_bas_category.CategoryName, bn_bas_category.Slug, bn_content.ContentHeading, bn_content.ContentSubHeading, bn_content.ContentBrief, bn_content.ImageSMPath, bn_content.URLAlies, DATE_FORMAT(bn_content.DateTimeInserted, '%h:%i %p, %e %M %Y %W') AS fDateTimeInserted FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID WHERE bn_content.ShowContent=1 AND bn_content.Deletable=1 AND DATE(bn_content.DateTimeInserted)='".$sDate."' ORDER BY bn_content.ContentID DESC LIMIT $offset, $rowsPerPage";
			}elseif( ($iCategoryID>0) && ($sDate!="") ){
				$qContent="SELECT bn_content.ContentID, bn_content.CategoryID, bn_bas_category.CategoryName, bn_bas_category.Slug, bn_content.ContentHeading, bn_content.ContentSubHeading, bn_content.ContentBrief, bn_content.ImageSMPath, bn_content.URLAlies, DATE_FORMAT(bn_content.DateTimeInserted, '%h:%i %p, %e %M %Y %W') AS fDateTimeInserted FROM bn_content INNER JOIN bn_bas_category ON bn_bas_category.CategoryID=bn_content.CategoryID WHERE bn_content.ShowContent=1 AND bn_content.Deletable=1 AND bn_content.CategoryID=".$iCategoryID." AND DATE(bn_content.DateTimeInserted)='".$sDate."' ORDER BY bn_content.ContentID DESC LIMIT $offset, $rowsPerPage";
			}
			//echo $qContent."<br>";
			$resultContent=@mysqli_query($connEMM, $qContent) or die(" ");
			while($rsContent=@mysqli_fetch_assoc($resultContent)){
			$sContentID="";$sCatURL="";$sCatName="";$sHead="";$sSubHead="";$sBrief="";$sURL="";$sImg="";
			if($rsContent["ContentID"]!=""){$sContentID=$rsContent["ContentID"];}
			if($rsContent["CategoryName"]!=""){$sCatName=$rsContent["CategoryName"];}
			$sCatURL=$sSiteURL.$rsContent["CategoryID"]."/".$rsContent["Slug"]."/";
			if($rsContent["ContentSubHeading"]!=""){$sSubHead='<span><small>'.$rsContent["ContentSubHeading"].'</small></span><br/>';}
			if($rsContent["ContentHeading"]!=""){$sHead=$rsContent["ContentHeading"];}
			if($rsContent["ContentBrief"]!=""){$sBrief=$rsContent["ContentBrief"];}
			if($rsContent["ImageSMPath"]!=""){$sImg='<img src="'.$sSiteURL.'media/imgAll/'.$rsContent["ImageSMPath"].'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}else{$sImg='<img src="'.$sThumb.'" alt="'.$sHead.'" title="'.$sHead.'" class="img-responsive img100">';}
			if($rsContent["URLAlies"]!=""){$sURL=$sSiteURL.fFormatURL($rsContent["URLAlies"]).'/'.$rsContent["ContentID"];}else{$sURL=$sSiteURL.fFormatURL($sHead)."/".$rsContent["ContentID"];}
			$sDateTime=$rsContent["fDateTimeInserted"]; ?>

			<div class="DCategoryListNews MarginTop20">
				<div class="row">
					<div class="col-sm-4">
						<a href="<?php echo $sCatURL; ?>"><button type="button" class="btn btn-success btnCatName"><?php echo $sCatName; ?></button></a>
						<a href="<?php echo $sURL; ?>"><?php echo $sImg; ?></a>
					</div>
					<div class="col-sm-8">
						<p><a href="<?php echo $sURL; ?>"><?php echo $sSubHead; ?></a></p>
						<h3><a href="<?php echo $sURL; ?>"><?php echo $sHead; ?></a></h3>
						<?php echo $sBrief; ?>
						<p class="DDate"><?php echo fEn2Bn($sDateTime); ?></p>
					</div>
				</div>
			</div>
			<?php }@mysqli_free_result($resultContent); ?>
		</div></div>

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
		$prev=' <a class="page-link" tabindex="-1" aria-label="Previous" href="'.$sSiteURL.'archives/?catid='.$iCategoryID.'&page='.$page.'"><span>&laquo; আগের পাতা</span> <span class="sr-only">আগের পাতা</span></a> ';
	}else{$prev="&nbsp;";$first="&nbsp;";}
	if($pageNum<$maxPage){
		$page=$pageNum+1;
		$next=' <a class="page-link" aria-label="Next" href="'.$sSiteURL.'archives/?catid='.$iCategoryID.'&page='.$page.'"><span aria-hidden="true">পরের পাতা &raquo;</span> <span class="sr-only">পরের পাতা</span></a> ';
	}else{$next="&nbsp;";$last="&nbsp;";}@mysqli_free_result($result); ?>

			<div class="col-sm-3">
				<nav><ul class="pagination"><li class="page-item"><?php echo $prev; ?></li></ul></nav>
			</div>
			<div class="col-sm-3 col-sm-offset-6 text-right">
				<nav><ul class="pagination"><li class="page-item"><?php echo $next; ?></li></ul></nav>
			</div>
		</div>
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

	</div>
</div>
</main>

<?php include_once("common/footer.php");@mysqli_close($connEMM); ?>
</div>

<div class="Back-up-top">
<a id="back-to-top" href="#" class="btn btn-danger back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
</div>

<?php echo $sJSEMM; ?>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5bdfe13c32a4ade7"></script>

</body>
</html>