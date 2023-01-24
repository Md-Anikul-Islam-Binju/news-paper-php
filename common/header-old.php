<!-- Global site tag (gtag.js) - Google Analytics -->
<script type="text/javascript" async src="https://www.googletagmanager.com/gtag/js?id=UA-128956003-10"></script>
<script type="text/javascript">window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-128956003-10');</script>
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
	<div class="col-sm-3 DHeaderSearch">
		<form class="navbar-form navbar-right">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search" name="search">
				<div class="input-group-btn">
					<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				</div>
			</div>
		</form>
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
    <div class="col-sm-8"><div class="DHeaderBanner">
    <?php $sImagePath="";$resultUpdate=mysqli_query($connEMM, "SELECT ImagePath FROM p_advt WHERE Position=2 ORDER BY AdvtImageID DESC LIMIT 1");
	$rsUpdate=mysqli_fetch_assoc($resultUpdate);
	$sImagePath=$rsUpdate["ImagePath"];mysqli_free_result($resultUpdate);
    if($sImagePath!=""){?><img src="media/common/banner-torun.jpg"<?php echo $sSiteURL; ?>media//<?php echo $sImagePath; ?>" alt="<?php echo $sInitialBN; ?>" title="<?php echo $sInitialBN; ?>" class="img-responsive img100"><?php } ?>
	</div></div>
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
						<li><a href="<?php echo $sSiteURL; ?>1/politics/">জাতীয়</a></li>
						<li><a href="<?php echo $sSiteURL; ?>2/city/">রাজনীতি</a></li>
						<li><a href="<?php echo $sSiteURL; ?>sub/?newstype=2">রাজধানী</a></li>
						<!--<li class="dropdown">
							<a href="<?php echo $sSiteURL; ?>3/out-of-city/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">  রাজধানী<span class="caret"></span></a>
							<!--<ul class="dropdown-menu">
								<li><a href="<?php echo $sSiteURL; ?>sub/?newstype=2">কক্সবাজার সদর</a></li>
								<li><a href="<?php echo $sSiteURL; ?>sub/?newstype=3">চকরিয়া</a></li>
								<li><a href="<?php echo $sSiteURL; ?>sub/?newstype=8">কুতুবদিয়া</a></li>
								<li><a href="<?php echo $sSiteURL; ?>sub/?newstype=9">উখিয়া</a></li>
								<li><a href="<?php echo $sSiteURL; ?>sub/?newstype=10">মহেশখালী</a></li>
								<li><a href="<?php echo $sSiteURL; ?>sub/?newstype=11">পেকুয়া</a></li>
								<li><a href="<?php echo $sSiteURL; ?>sub/?newstype=12">রামু</a></li>
								<li><a href="<?php echo $sSiteURL; ?>sub/?newstype=13">টেকনাফ</a></li>
							</ul>-->
						</li>
						<li><a href="<?php echo $sSiteURL; ?>4/court/">নগর-মহানগর</a></li>
						<li><a href="<?php echo $sSiteURL; ?>5/public-disaster/">ক্রিকেট</a></li>
						<li><a href="<?php echo $sSiteURL; ?>6/sports/">তরুণ বাংলা</a></li>
						<li><a href="<?php echo $sSiteURL; ?>7/entertainment/">বিজয়ের মাস</a></li>
						<li><a href="<?php echo $sSiteURL; ?>8/religion/">দূরদেশ</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">অন্যান্য <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo $sSiteURL; ?>9/education/">শিল্প বাণিজ্য</a></li>
								<li><a href="<?php echo $sSiteURL; ?>10/lifestyle/">সম্পাদকের কথা</a></li>
								<li><a href="<?php echo $sSiteURL; ?>11/health/">মাতৃভূমি</a></li>
								<li><a href="<?php echo $sSiteURL; ?>12/country/">তারুণে্যে ক্যাম্পাস</a></li>
								<li><a href="<?php echo $sSiteURL; ?>13/organization-news/">দেহগরি</a></li>
								<li><a href="<?php echo $sSiteURL; ?>14/interview/">বিনোদন কণ্ঠ</a></li>
								<li><a href="<?php echo $sSiteURL; ?>15/reader-opinion/">খেলার মাঠ</a></li>
								<li><a href="<?php echo $sSiteURL; ?>16/science-technology/">আইডিয়া ও প্রযুক্তি</a></li>
								<li><a href="<?php echo $sSiteURL; ?>photogallery">ছবি গ্যালারি</a></li>
								<li><a href="<?php echo $sSiteURL; ?>videogallery">ভিডিও গ্যালারি</a></li>
								<li><a href="<?php echo $sSiteURL; ?>17/etcetera/">ইত্যাদি</a></li>
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