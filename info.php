<?php include_once("common/mysqli_conneCT.php");include_once("common/config.php");
$iOtherCategoryID=2;
if(isset($_REQUEST["cattype"])){
	$iOtherCategoryID=fFormatString($_REQUEST["cattype"]);
	$iOtherCategoryID=filter_var($iOtherCategoryID, FILTER_SANITIZE_NUMBER_INT);
	$iOtherCategoryID=filter_var($iOtherCategoryID, FILTER_VALIDATE_INT);
	if(!is_numeric($iOtherCategoryID)){$iOtherCategoryID=2;}
	if($iOtherCategoryID<2){$iOtherCategoryID=2;}
}

$qOtherSubCategory="SELECT
bn_bas_other_subcategory.SubCategoryID,
bn_bas_other_category.CategoryName,
bn_bas_other_subcategory.SubCategoryName,
bn_bas_other_subcategory.Remarks
FROM
bn_bas_other_subcategory
INNER JOIN bn_bas_other_category ON bn_bas_other_category.CategoryID=bn_bas_other_subcategory.CategoryID
WHERE bn_bas_other_subcategory.SubCategoryID=".$iOtherCategoryID."
ORDER BY bn_bas_other_subcategory.SubCategoryID DESC
LIMIT 1";
//echo $qOtherSubCategory;
$resultOtherSubCategory=@mysqli_query($connEMM, $qOtherSubCategory) or die(" ");
$rsOtherSubCategory=@mysqli_fetch_assoc($resultOtherSubCategory);

$iSubCategoryID=$rsOtherSubCategory["SubCategoryID"];
$sOtherCategory=$rsOtherSubCategory["CategoryName"];
$sSubCategoryName=$rsOtherSubCategory["SubCategoryName"];
$sRemarks=$rsOtherSubCategory["Remarks"];
mysqli_free_result($resultOtherSubCategory);

$sTitle=$sOtherCategory." - ".$sSubCategoryName;

$sCurrURL=$sSiteURL."info/?cattype=".$iSubCategoryID;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo $sTitle; ?></title>

<meta name="description" content="<?php echo $sTitle;?>, Bangla and English news from Bangladesh">
<meta name="keywords" content="<?php echo $sTitle;?>, Bangla and English news from Bangladesh">

<meta http-equiv="refresh" content="600">
<meta name="author" content="<?php echo $sAuthor;?>">

<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="googlebot-news" content="index, follow">

<meta property="fb:app_id" content="2193803980899970">
<meta property="og:site_name" content="<?php echo $sSiteName;?>">
<meta property="og:title" content="<?php echo $sTitle;?>">
<meta property="og:description" content="<?php echo $sTitle;?>, Bangla and English news from Bangladesh">
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

<div class="container">
<?php include_once("common/header.php"); ?>

<main>
<div class="row"><div class="col-sm-12">
	<div class="row"><div class="col-sm-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo $sSiteURL; ?>"><i class="fa fa-home fa-lg Golden" aria-hidden="true"></i> হোম</a></li>
			<li><?php echo $sOtherCategory; ?></li>
			<li class="active"><a href="<?php echo $sCurrURL; ?>"><?php echo $sSubCategoryName; ?></a></li>
		</ol>
	</div></div>

	<section>
	<div class="row"><div class="col-sm-8">
		<h1><?php echo $sOtherCategory; ?></h1>
		<h3 class="H3Head"><?php echo $sSubCategoryName; ?></h3>
		<?php echo $sRemarks; ?>
	</div></div>
	<?php @mysqli_free_result($resultContent); ?>
	</section>

</div></div>
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