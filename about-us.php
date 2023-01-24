<?php include_once("common/mysqli_conneCT.php");include_once("common/config.php"); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>About Us</title>

<meta name="description" content="Privacy Policy">
<meta name="keywords" content="Privacy Policy">

<meta http-equiv="refresh" content="600">
<meta name="author" content="<?php echo $sAuthor;?>">

<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="googlebot-news" content="index, follow">

<meta property="fb:app_id" content="2193803980899970">
<meta property="og:site_name" content="<?php echo $sSiteName;?>">
<meta property="og:title" content="Privacy Policy">
<meta property="og:description" content="Privacy Policy">
<meta property="og:url" content="<?php echo $sSiteURL; ?>privacy-policy.php">
<meta property="og:type" content="article">
<meta property="og:image" content="<?php echo $sLogoURLfb;?>">
<meta property="og:locale" content="en_US">

<link rel="canonical" href="<?php echo $sSiteURL; ?>privacy-policy.php">
<link type="image/x-icon" rel="shortcut icon" href="<?php echo $sFavicon; ?>">

<?php echo $sCSSBootStrap; ?>
<?php echo $sCSSFontAwesome; ?>
<?php echo $sCSSEMM; ?>
<link rel="stylesheet" type="text/css" href="<?php echo $sSiteURL; ?>common/css/SolaimanLipi.css">

<style type="text/css">
#ppBody{font-size:11pt;width:100%;margin:0 auto;text-align:justify;}
#ppHeader{font-family:verdana;font-size:21pt;width:100%;margin:0 auto;}
.ppConsistencies{display:none;}
</style>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id){var js, fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)) return;js=d.createElement(s);js.id=id;js.src='https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=2193803980899970&autoLogAppEvents=1';fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>

<div class="container">

<?php include_once("common/header.php"); ?>
<main>
<div class="row">
	<div class="col-sm-8">
		<div class="DetailsLeftContent">
			<div class="row">
				<div class="col-sm-12">
					<ol class="breadcrumb">
						<li><a href="<?php echo $sSiteURL; ?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
						<li class="active">About Us</li>
					</ol>
				</div>
			</div>

			<div class="row En">
				<div class="col-sm-12">
					<div id='ppHeader'>About dailytorunkantho.com</div>
					<div id='ppBody'><div class='ppConsistencies'><div class='col-2'>
					
				</div>
				
			</div>
			
			<div style='clear:both;height:10px;'></div>
			<div class='innerText'>dailytorunkantho.com is one of the most popular Bangla news portals in Bangladesh. dailytorunkantho.com is updating 24/7 with Special reports, National, politics, education, entertainment, sports, lifestyle,  economics, culture, information technology, health,  columns and features. <br></div>
			<span id='infoCo'></span><br>
			<div class='grayText'><strong>One can easily find latest news and top breaking headlines from Bangladesh and around the world within a short span of time from the online news portal.</strong></div><br />
			<div class='innerText'>dailytorunkantho.com has provided real time news update, using utmost modern technology since 2015. It also provides archive of previous news, and printing facility of the specific news items.</div><br>
			<div class='innerText'>The news based site enriched with all the elements of country’s traditional newspapers. A group of youngster journalists are working for the online news portal.</div><br>
			
			
			
			
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="row"><div class="col-sm-12">
			
		</div></div>
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