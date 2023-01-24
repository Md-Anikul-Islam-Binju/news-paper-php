<?php include_once("../common/mysqli_conneCT.php");include_once("../common/config.php");
$iWebTVType=1;$sWebTVHeading="";$sWebTVLinkCode="";$iContentID=1;

if(isset($_REQUEST["videoinfo"])){
	$iContentID=$_REQUEST["videoinfo"];
	$iContentID=filter_var($iContentID, FILTER_SANITIZE_NUMBER_INT);
	$iContentID=filter_var($iContentID, FILTER_VALIDATE_INT);
	$sSQL="SELECT WebTVType, WebTVHeading, WebTVLinkCode, DATE_FORMAT(DateTimeInserted, '%d %M %Y %W, %h:%i &nbsp;%p') AS fDateTimeInserted FROM tv_webtv WHERE WebTVID=".$iContentID." AND Deletable=1 LIMIT 1";
}else{
	$sSQL="SELECT WebTVType, WebTVHeading, WebTVLinkCode, DATE_FORMAT(DateTimeInserted, '%d %M %Y %W, %h:%i &nbsp;%p') AS fDateTimeInserted FROM tv_webtv WHERE Deletable=1 ORDER BY WebTVID DESC LIMIT 1";
}
$resultSQL=@mysqli_query($connEMM, $sSQL);
if(@mysqli_num_rows($resultSQL)<=0 ){
	$sSQL="SELECT WebTVID, WebTVType, WebTVHeading, WebTVLinkCode, DATE_FORMAT(DateTimeInserted, '%d %M %Y %W, %h:%i &nbsp;%p') AS fDateTimeInserted FROM tv_webtv WHERE Deletable=1 ORDER BY WebTVID DESC LIMIT 1";
	$resultSQL=@mysqli_query($connEMM, $sSQL);
}
//echo $sSQL;
$rsSQL=@mysqli_fetch_assoc($resultSQL);
$iWebTVType=$rsSQL["WebTVType"];
$sWebTVHeading=$rsSQL["WebTVHeading"];
$sWebTVLinkCode=$rsSQL["WebTVLinkCode"];
$sDateTimeInserted=$rsSQL["fDateTimeInserted"];
@mysqli_free_result($resultSQL);

$sURL=$sSiteURL.$_SERVER["REQUEST_URI"]; ?>
<!doctype html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo $sWebTVHeading; ?></title>

<meta name="description" content="<?php echo $sWebTVHeading; ?>">
<meta name="keywords" content="<?php echo $sWebTVHeading; ?>">

<meta http-equiv="refresh" content="600">
<meta name="author" content="<?php echo $sSiteName;?>">

<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="googlebot-news" content="index, follow">

<meta property="fb:app_id" content="2193803980899970">
<meta property="og:site_name" content="<?php echo $sSiteName;?>">
<meta property="og:title" content="<?php echo $sWebTVHeading; ?>">
<meta property="og:description" content="<?php echo $sWebTVHeading; ?>">
<meta property="og:url" content="<?php echo $sURL; ?>">
<meta property="og:type" content="article">
<meta property="og:image" content="https://img.youtube.com/vi/<?php echo $sWebTVLinkCode; ?>/maxresdefault.jpg">
<meta property="og:locale" content="en_US">

<link rel="canonical" href="<?php echo $sURL; ?>">
<link type="image/x-icon" rel="shortcut icon" href="<?php echo $sFavicon;?>">

<?php echo $sCSSBootStrap; ?>
<?php echo $sCSSFontAwesome; ?>
<?php echo $sCSSEMM; ?>
<link rel="stylesheet" type="text/css" href="<?php echo $sSiteURL; ?>common/css/SolaimanLipi.css">
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id){var js, fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)) return;js=d.createElement(s);js.id=id;js.src='https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=2193803980899970&autoLogAppEvents=1';fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>

<div class="container">
<?php include_once("../common/headerGallery.php");?>
<div class="row"><div class="col-md-12">
	<ol class="breadcrumb">
		<li><a href="<?php echo $sSiteURL; ?>"><span><i class="fa fa-home" aria-hidden="true"></i></span></a></li>
		<li class="active">ভিডিও গ্যালারি</li>
	</ol>
</div></div>

<div class="row">
	<div class="col-md-8">
		<div class="row"><div class="col-sm-12 DSocialTop"><div class="addthis_inline_share_toolbox"></div></div></div>
		<div class="row"><div class="col-md-12">
			<h1><?php echo $sWebTVHeading; ?></h1>
			<div class="embed-responsive embed-responsive-16by9 DMarginBottom20"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $sWebTVLinkCode; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
		</div></div>

		<div class="row"><div class="col-sm-12 DSocialTop"><div class="addthis_inline_share_toolbox"></div></div></div>
	</div>

	<div class="col-md-4">
		<div class="panel panel-primary">
			<div class="panel-heading"><h3 class="panel-title">অন্যান্য ভিডিও</h3></div>
			<div class="panel-body paddingLeftRight0">
				<?php $sSQL="SELECT WebTVID, WebTVType, WebTVHeading, WebTVLinkCode FROM tv_webtv WHERE Deletable=1 ORDER BY WebTVID DESC LIMIT 10";
				$resultSQL=@mysqli_query($connEMM, $sSQL) or die(" ");
				while($rsSQL=@mysqli_fetch_assoc($resultSQL)){
				$iWebTVID=1;$sWebTVHeading="";$sWebTVLinkCode="";
				$iWebTVID=$rsSQL["WebTVID"];
				$sWebTVHeading=$rsSQL["WebTVHeading"];
				$sWebTVLinkCode=$rsSQL["WebTVLinkCode"]; ?>

				<div class="row"><div class="col-sm-12 marginTB10">
					<a href="<?php echo $sSiteURL; ?>videogallery/index.php?videoinfo=<?php echo $iWebTVID; ?>">
					<img src="https://img.youtube.com/vi/<?php echo $sWebTVLinkCode; ?>/0.jpg" alt="<?php echo $sWebTVHeading; ?>" title="<?php echo $sWebTVHeading; ?>" class="img-responsive">
					<h4><?php echo $sWebTVHeading; ?></h4></a>
				</div></div>
				<?php }@mysqli_free_result($resultSQL); ?>
			</div>
		</div>
		<div class="row"><div class="col-sm-12 DMarginTop20"><h3><a href="<?php echo $sSiteURL; ?>videogallery/archives.php">ভিডিও গ্যালারি আর্কাইভস</a> &raquo;</h3></div></div>

        <div class="row"><div class="col-sm-12 DMarginTop20">
			<div class="fb-page" data-href="https://www.facebook.com/coxsbazarsoikat/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/coxsbazarsoikat/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/coxsbazarsoikat/">Cox&#039;s Bazar Soikat - কক্সবাজার সৈকত</a></blockquote></div>
		</div></div>

	</div>
</div>
<?php include_once("../common/footer.php");@mysqli_close($connEMM); ?>
</div>
<?php echo $sJSjQuery; ?>
<?php echo $sJSBootStrap; ?>

<!--[if lt IE 9]>
<?php echo $sJShtml5shiv; ?>
<?php echo $sJSrespond; ?>
<![endif]-->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5bdfe13c32a4ade7"></script>

</body>
</html>