<!-- Global site tag (gtag.js) - Google Analytics -->
<script type="text/javascript" async src="https://www.googletagmanager.com/gtag/js?id=UA-128956003-10"></script>
<script type="text/javascript">window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-128956003-10');</script>
<?php include_once("common/class.banglaDate.php");include_once('common/I18N/Arabic.php');

$bn=new BanglaDate(time());$bn->set_time(time(), 6);$date=$bn->get_date();
$dtDateBN=$date[1]."&nbsp;".$date[0]."&nbsp;".$date[2];

$ar=new I18N_Arabic('Date');
$dtDateAr=$ar->date('d F Y', time()+$dtTimeDifference); ?>
<header>
<div class="DHeaderTop">
	<div class="row">
		<div class="col-sm-6 DHeaderDate"><p><?php echo fEn2Bn($dtDateTime); ?> &nbsp; <?php echo $dtDateBN; ?> &nbsp; <?php echo fEn2Bn($dtDateAr); ?></p></div>
	</div>
</div>

<div class="row">
	<div class="col-sm-4"><div class="DLogo"><a href="<?php echo $sSiteURL; ?>"><img src="<?php echo $sLogoURL; ?>"media/common/logo-torun.png" alt="" title="" class="img-responsive"></a></div></div>
</div>
</header>