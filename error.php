<?php include_once("common/mysqli_conneCT.php");include_once("common/config.php");
$sCurrURL=$sSiteURL."error.php"; ?>
<!doctype html>
<html lang="en" manifest="cache.manifest">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>Page Not Found</title>

<meta name="description" content="Page Not Found">
<meta name="keywords" content="Page Not Found">

<meta http-equiv="refresh" content="5;<?php echo $sSiteURL; ?>">
<meta name="author" content="<?php echo $sAuthor;?>">

<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="googlebot-news" content="index, follow">

<meta property="fb:app_id" content="2193803980899970">
<meta property="og:site_name" content="<?php echo $sSiteName;?>">
<meta property="og:title" content="Error Page">
<meta property="og:description" content="Error Page">
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
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id){var js, fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)) return;js=d.createElement(s);js.id=id;js.src='https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=2193803980899970&autoLogAppEvents=1';fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>

<div class="container">
<?php include_once("common/header.php"); ?>

<main>
<div class="container">
<div class="row">
	<div class="col-sm-8">
		<div class="row"><div class="col-sm-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo $sSiteURL; ?>"><i class="fa fa-home fa-lg Golden" aria-hidden="true"></i> প্রচ্ছদ</a></li>
				<li class="active">এ পৃষ্ঠাটি পাওয়া যায়নি।</li>
			</ol>
		</div></div>
		<section>
		<div class="text-justify">
			<h1>এ পৃষ্ঠাটি পাওয়া যায়নি।</h1> 
			<p>আপাতত আপনাকে প্রচ্ছদে নেয়া হচ্ছে।</p>
		</div>
		</section>
	</div>

	<div class="col-sm-4">
		<div class="row"><div class="col-sm-12">
			<div class="fb-page" data-href="https://www.facebook.com/coxsbazarsoikat/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/coxsbazarsoikat/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/coxsbazarsoikat/">Cox&#039;s Bazar Soikat - কক্সবাজার সৈকত</a></blockquote></div>
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
</body>
</html>