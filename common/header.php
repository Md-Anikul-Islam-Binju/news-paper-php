<!-- Global site tag (gtag.js) - Google Analytics -->
<script type="text/javascript" async src="https://www.googlgr.com/gtag/js?id=--"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-70309952-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-70309952-1');
</script>
<!--<div class="row DMargin0 DBreaking">
	<div class="col-sm-12 DPadding0">
		<img src="https://www.dainikeidin.com/media/PhotoGallery/2018November/ICT-Banner-May-21-Kabbo-09-980-x-90-2005240105.jpg" alt="   এই দিন " title="   এই দিন " class="img-responsive img100">
	</div>
</div>-->
<?php include_once("common/class.banglaDate.php");include_once('common/I18N/Arabic.php');

$bn=new BanglaDate(time());$bn->set_time(time(), 6);$date=$bn->get_date();
$dtDateBN=$date[1]."&nbsp;".$date[0]."&nbsp;".$date[2];

$ar=new I18N_Arabic('Date');
$dtDateAr=$ar->date('d F Y', time()+$dtTimeDifference); ?>
<header>
<?php if(filesize("xhtml/gen_breaking.htm")>10){ ?>
<div class="row DMargin0 DBreaking">
	<div class="col-sm-1 DPadding0">ব্রেকিং:</div>
	<div class="col-sm-11 DPadding0">
		<marquee direction="left" speed="normal" scrollamount="4" behavior="loop" onmouseover="this.stop();" onmouseout="this.start();">
			<?php include_once("xhtml/gen_breaking.htm");?>
		</marquee>
	</div>
</div>
<?php } ?>
<div class="DHeaderTop">
<div class="row">
	<div class="col-sm-6 DHeaderDate"><p><?php echo fEn2Bn($dtDateTime); ?> &nbsp; <?php echo $dtDateBN; ?> &nbsp; <?php echo fEn2Bn($dtDateAr); ?></p></div>
	<div class="col-sm-2 DHeaderSearch">
		<form class="navbar-form navbar-right">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search" name="search">
				<div class="input-group-btn">
					<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-sm-1 DHeaderSearch">
		<a href="http://e.dailytorunkantho.com/"><button type="button" style="background: #222b46;color: #fff;margin-left: 82%; font-size: 1.1em;">ইপেপার</button></a>
	</div>
	<div class="col-sm-3 DSocialLink">
		<ul>
			<li><a href="https://www.facebook.com/dailytorunkantho/" target="_blank"><i class="fa fa-facebook-square fa-lg"></i></a></li>
			<li><a href="#" target="_blank"><i class="fa fa-youtube-square fa-lg"></i></a></li>
			<li><a href="#" target="_blank"><i class="fa fa-google-plus-square fa-lg"></i></a></li>
			<li><a href="#" target="_blank"><i class="fa fa-linkedin fa-lg"></i></a></li>
			<li><a href="#" target="_blank"><i class="fa fa-twitter-square fa-lg"></i></a></li>
			<li><a href="<?php echo $sSiteURL; ?>rss/rss.xml" target="_blank"><i class="fa fa-rss-square fa-lg"></i></a></li>
		</ul>
	</div>
</div>
</div>

<div class="row">
	<div class="col-sm-4"><div class="DLogo"><a href="<?php echo $sSiteURL; ?>"><img src="<?php echo $sLogoURL; ?>" alt="<?php echo $sSiteTitle; ?>" title="<?php echo $sSiteTitle; ?>" class="img-responsive"></a></div></div>
    <div class="col-sm-8">
    	<div class="DHeaderBanner">
    		<img src="http://www.dailytorunkantho.com/media/common/banner-torun.jpg" alt="তরুণ কণ্ঠ|Torunkantho" title="তরুণ কণ্ঠ|Torunkantho" class="img-responsive img100">
    	</div>
    </div>
</div>

<div class="row DHeaderNav">
	<div class="col-sm-12">
		<nav class="navbar navbar-default">
			<div class="container-fluid DPadding0">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="<?php echo $sSiteURL; ?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
						<li><a href="<?php echo $sSiteURL; ?>12/country/">জাতীয়</a></li>
						<li><a href="<?php echo $sSiteURL; ?>1/politics/">রাজনীতি</a></li>
						<li><a href="<?php echo $sSiteURL; ?>14/interview/">নগর-মহানগর</a></li>
						<li><a href="<?php echo $sSiteURL; ?>6/sports/">খেলার মাঠ</a></li>
						<li><a href="<?php echo $sSiteURL; ?>7/entertainment/">বিনোদন কণ্ঠ</a></li>
						<li><a href="<?php echo $sSiteURL; ?>8/religion/">ধর্ম ও জীবন</a></li>
						<li><a href="<?php echo $sSiteURL; ?>16/science-technology/">আইড়িয়া ও প্রযুক্তি</a></li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">অন্যান্য<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo $sSiteURL; ?>2/city/">রাজধানী</a></li>
								<li><a href="<?php echo $sSiteURL; ?>9/education/">তারুণ্যের ক্যাম্পাস</a></li>
								<li><a href="<?php echo $sSiteURL; ?>4/court/">মাতৃভূমি</a></li>
								<li><a href="<?php echo $sSiteURL; ?>5/public-disaster/">সম্পাদকের কথা</a></li>
								
								<li><a href="<?php echo $sSiteURL; ?>10/lifestyle/">তারুণ্যের স্টাইল</a></li>
								<li><a href="<?php echo $sSiteURL; ?>11/health/">তরুণ বাংলা</a></li>
								<li><a href="<?php echo $sSiteURL; ?>13/organization-news/">সংগঠন সংবাদ</a></li>
								<li><a href="<?php echo $sSiteURL; ?>14/interview/">নগর-মহানগর</a></li>
								<li><a href="<?php echo $sSiteURL; ?>15/reader-opinion/">পাঠকের চিন্তা</a></li>
								<li><a href="<?php echo $sSiteURL; ?>17/etcetera/">শিল্প-বাণিজ্য</a></li>
								<li><a href="<?php echo $sSiteURL; ?>photogallery">ছবি গ্যালারি</a></li>
								<li><a href="<?php echo $sSiteURL; ?>videogallery">ভিডিও গ্যালারি</a></li>
								
							</ul>
						</li>
						<li><a href="<?php echo $sSiteURL; ?>archives/">আর্কাইভ</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</div>

<?php if(filesize("xhtml/gen_scroll.htm")>10){ ?>
<div class="row DMargin0 DScroll DMarginBottom10">
	<div class="col-sm-1 DPadding0">সর্বশেষ:</div>
	<div class="col-sm-11 DPadding0">
		<marquee direction="left" speed="normal" scrollamount="4" behavior="loop" onmouseover="this.stop();" onmouseout="this.start();">
			<?php include_once("xhtml/gen_scroll.htm");?>
		</marquee>
	</div>
	
</div>
<?php } ?>
</header>