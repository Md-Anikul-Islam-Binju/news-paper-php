<?php include_once("common/mysqli_conneCT.php");include_once("common/config.php"); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo $sSiteTitle; ?></title>

<meta name="description" content="<?php echo $sSiteTitle; ?>">
<meta name="keywords" content="<?php echo $sSiteTitle; ?>">

<meta http-equiv="refresh" content="600">
<meta name="author" content="<?php echo $sAuthor;?>">

<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="googlebot-news" content="index, follow">

<meta property="fb:app_id" content="2193803980899970">
<meta property="og:site_name" content="<?php echo $sSiteName; ?>">
<meta property="og:title" content="<?php echo $sSiteTitle; ?>">
<meta property="og:description" content="<?php echo $sSiteTitle; ?>">
<meta property="og:url" content="<?php echo $sSiteURL; ?>">
<meta property="og:type" content="article">
<meta property="og:image" content="<?php echo $sLogoURLfb; ?>">
<meta property="og:locale" content="en_US">

<link rel="canonical" href="<?php echo $sSiteURL; ?>">
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
<div class="col-sm-9">
	<div class="row"><?php include_once("xhtml/bn_spe_LeadNews.htm"); ?></div>
	<div class="row"><?php include_once("xhtml/bn_speSpecialTop1.htm"); ?></div>

	<div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>1/politics/"><span class="DCategoryTitle">জাতীয়</span></a></div>
		<div class="row"><?php include_once("xhtml/bn_Politics.htm"); ?></div>
	</div>

	<div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>2/city/"><span class="DCategoryTitle">রাজনীতি</span></a></div>
		<div class="row"><?php include_once("xhtml/bn_City.htm"); ?></div>
	</div>

	<div class="row">
		<div class="col-sm-6"><div class="DCategoryNews">
			<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>sub/?newstype=2"><span class="DCategoryTitle">রাজধানী</span></a></div>
			<?php include_once("xhtml/bn_sub_Sadar.htm"); ?>
		</div></div>
		<div class="col-sm-6"><div class="DCategoryNews">
			<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>sub/?newstype=3"><span class="DCategoryTitle">নগর-মহানগর</span></a></div>
			<?php include_once("xhtml/bn_sub_Chakaria.htm"); ?>
		</div></div>
	</div>
	<div class="row">
		<div class="col-sm-6"><div class="DCategoryNews">
			<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>sub/?newstype=8"><span class="DCategoryTitle">ক্রিকেট</span></a></div>
			<?php include_once("xhtml/bn_sub_Kutubdia.htm"); ?>
		</div></div>
		<div class="col-sm-6"><div class="DCategoryNews">
			<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>sub/?newstype=9"><span class="DCategoryTitle">তরুণ বাংলা</span></a></div>
			<?php include_once("xhtml/bn_sub_Ukhiya.htm"); ?>
		</div></div>
		
	</div>
</div>


<!--Right Side-->
<div class="col-sm-3">
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

	<div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>5/public-disaster/"><span class="DCategoryTitle">নগর-মহানগর</span></a></div>
		<?php include_once("xhtml/bn_PublicDisaster.htm"); ?>
	</div>
	<div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>4/court/"><span class="DCategoryTitle">আইডিয়া ও প্রযুক্তি</span></a></div>
		<?php include_once("xhtml/bn_Court.htm"); ?>
	</div>
	<div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>13/organization-news/"><span class="DCategoryTitle">সম্পাদকে কথা</span></a></div>
		<?php include_once("xhtml/bn_OrganizationNews.htm"); ?>
	</div>
	<div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>15/reader-opinion/"><span class="DCategoryTitle">মাতৃভূমি</span></a></div>
		<?php include_once("xhtml/bn_ReaderOpinion.htm"); ?>
	</div>
</div>
</div>
<!--/Right Side-->

<!--New Row-->
<!--<div class="row">
	<div class="col-sm-3"><div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>sub/?newstype=10"><span class="DCategoryTitle">মহেশখালী</span></a></div>
		<?php include_once("xhtml/bn_sub_Moheshkhali.htm"); ?>
	</div></div>
	
	<div class="col-sm-3"><div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>sub/?newstype=11"><span class="DCategoryTitle">পেকুয়া</span></a></div>
		<?php include_once("xhtml/bn_sub_Pekua.htm"); ?>
	</div></div>
	<div class="col-sm-3"><div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>sub/?newstype=12"><span class="DCategoryTitle">রামু</span></a></div>
		<?php include_once("xhtml/bn_sub_Ramu.htm"); ?>
	</div></div>
	<div class="col-sm-3"><div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>sub/?newstype=13"><span class="DCategoryTitle">টেকনাফ</span></a></div>
		<?php include_once("xhtml/bn_sub_Teknaf.htm"); ?>
	</div></div>
</div>-->


<div class="row">
	<div class="col-sm-3"><div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>12/country/"><span class="DCategoryTitle">তারুন্যের ক্যাম্পাস</span></a></div>
		<?php include_once("xhtml/bn_Country.htm"); ?>
	</div></div>
	<div class="col-sm-3"><div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>9/education/"><span class="DCategoryTitle">শিক্ষা</span></a></div>
		<?php include_once("xhtml/bn_Education.htm"); ?>
	</div></div>
	<div class="col-sm-3"><div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>11/health/"><span class="DCategoryTitle">স্বাস্থ্য</span></a></div>
		<?php include_once("xhtml/bn_Health.htm"); ?>
	</div></div>
	<div class="col-sm-3"><div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>14/interview/"><span class="DCategoryTitle">স্বাক্ষাৎকার</span></a></div>
		<?php include_once("xhtml/bn_Interview.htm"); ?>
	</div></div>
</div>

<div class="row">
	<div class="col-sm-4"><div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>7/entertainment/"><span class="DCategoryTitle">বিনোদন</span></a></div>
		<?php include_once("xhtml/bn_Entertainment.htm"); ?>
	</div></div>
	<div class="col-sm-4"><div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>6/sports/"><span class="DCategoryTitle">খেলাধূলা</span></a></div>
		<?php include_once("xhtml/bn_Sports.htm"); ?>
	</div></div>
	<div class="col-sm-4"><div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>16/science-technology/"><span class="DCategoryTitle">বিজ্ঞান ও প্রযুক্তি</span></a></div>
		<?php include_once("xhtml/bn_ScienceTechnology.htm"); ?>
	</div></div>
</div>

<div class="row">
	<div class="col-sm-4"><div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>8/religion/"><span class="DCategoryTitle">ধর্ম</span></a></div>
		<?php include_once("xhtml/bn_Religion.htm"); ?>
	</div></div>
	<div class="col-sm-4"><div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>10/lifestyle/"><span class="DCategoryTitle">লাইফস্টাইল</span></a></div>
		<?php include_once("xhtml/bn_Lifestyle.htm"); ?>
	</div></div>
	<div class="col-sm-4"><div class="DCategoryNews">
		<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>17/etcetera/"><span class="DCategoryTitle">ইত্যাদি</span></a></div>
		<?php include_once("xhtml/bn_Etcetera.htm"); ?>
	</div></div>
</div>

<div class="DCategoryNews">
<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>photogallery"><span class="DCategoryTitle">ছবি গ্যালারি</span></a></div>
<div class="row">
	<div class="col-sm-8">
		<div class="DPhotoGallery">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner" role="listbox"><?php include_once("xhtml/p_PhotoDaily.htm"); ?></div>
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div>
	<div class="col-sm-4 DPhotoGalleryList"><div class="row"><?php include_once("xhtml/p_PhotoArchives.htm"); ?></div></div>
</div>
</div>

<div class="DCategoryNews DMarginBottom20">
<div class="border_bottom"><a href="<?php echo $sSiteURL; ?>videogallery"><span class="DCategoryTitle">ভিডিও গ্যালারি</span></a></div>
<div class="row DVideoGallery"><?php include_once("xhtml/tv_Home.htm"); ?></div>
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
</body>
</html>