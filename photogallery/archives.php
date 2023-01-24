<?php include_once("../common/mysqli_conneCT.php");include_once("../common/config.php");
$rowsPerPage=12;$iPageNum=1;
if(isset($_REQUEST["page"])){
	$iPageNum=$_REQUEST["page"];
	$iPageNum=filter_var($iPageNum, FILTER_SANITIZE_NUMBER_INT);
	$iPageNum=filter_var($iPageNum, FILTER_VALIDATE_INT);
}
$sURL=$sSiteURL.$_SERVER["REQUEST_URI"]; ?>
<!doctype html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>ফটো গ্যালারি আর্কাইভস <?php if($iPageNum>1){echo " - ".$iPageNum;} ?></title>

<meta name="description" content="ফটো গ্যালারি আর্কাইভস <?php if($iPageNum>1){echo " - ".$iPageNum;} ?>">
<meta name="keywords" content="ফটো গ্যালারি আর্কাইভস <?php if($iPageNum>1){echo " - ".$iPageNum;} ?>">

<meta http-equiv="refresh" content="600">
<meta name="author" content="<?php echo $sSiteName;?>">

<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="googlebot-news" content="index, follow">

<meta property="fb:app_id" content="s2193803980899970">
<meta property="og:site_name" content="<?php echo $sSiteName;?>">
<meta property="og:title" content="ফটো গ্যালারি আর্কাইভস <?php if($iPageNum>1){echo " - ".$iPageNum;} ?>">
<meta property="og:description" content="ফটো গ্যালারি আর্কাইভস <?php if($iPageNum>1){echo " - ".$iPageNum;} ?>">
<meta property="og:url" content="<?php echo $sURL; ?>">
<meta property="og:type" content="article">
<meta property="og:image" content="<?php echo $sLogoURLfb; ?>">
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

<main>
<div class="container">
<section>
<?php include_once("../common/headerGallery.php");?>
<div class="row"><div class="col-md-12">
	<ol class="breadcrumb">
		<li><a href="<?php echo $sSiteURL; ?>">প্রচ্ছদ</a></li>
		<li><a href="<?php echo $sSiteURL; ?>/photogallery/">ফটো গ্যালারি</a></li>
		<li class="active">ফটো গ্যালারি আর্কাইভস</li>
	</ol>
</div></div>

<div class="row"><div class="col-md-12">
	<h1>ফটো গ্যালারি আর্কাইভস</h1>
	<div class="row MarginTop30">
	<?php $iCounter=0;$offset=($iPageNum-1)*$rowsPerPage;

	$sSQL="SELECT p_album.AlbumID, p_album.AlbumName, p_photo.ImagePath FROM p_photo INNER JOIN p_album ON p_album.AlbumID=p_photo.AlbumID WHERE p_album.Deletable=1 AND p_photo.Deletable=1 AND p_photo.ImageType=1 GROUP BY p_photo.AlbumID ORDER BY p_photo.AlbumID DESC LIMIT $offset, $rowsPerPage";
	$resultSQL=@mysqli_query($connEMM, $sSQL) or die(" ");
	while($rsSQL=@mysqli_fetch_assoc($resultSQL)){
	$sAlbum=$rsSQL["AlbumName"];
	$sURL=$sSiteURL."photogallery/".fFormatURL($sAlbum)."/".$rsSQL["AlbumID"];
	if($iCounter==4){echo '</div><div class="row MarginTop30">';$iCounter=0;} ?>
	<div class="col-sm-3">
		<a href="<?php echo $sURL; ?>">
		<img class="img-responsive" src="<?php echo $sSiteURL; ?>media/PhotoGallery/<?php echo $rsSQL["ImagePath"]; ?>" alt="<?php echo $sAlbum ?>" title="<?php echo $sAlbum ?>">
		<p><?php echo $sAlbum; ?></p>
		</a>
	</div>
	<?php $iCounter++;}@mysqli_free_result($resultSQL); ?>
	</div>
</div></div>
<div class="row"><div class="col-sm-12 DSocialTop"><div class="addthis_inline_share_toolbox"></div></div></div>


<div class="row"><div class="col-sm-12">
	<?php $result=@mysqli_query($connEMM, "SELECT COUNT(AlbumID) AS numrows FROM p_album WHERE Deletable=1") or die("");
	$row=@mysqli_fetch_assoc($result);
	$numrows=$row["numrows"];
	$maxPage=ceil($numrows/$rowsPerPage);
	$self=$_SERVER["PHP_SELF"];
	$nav="";

	for($page=1;$page<=$maxPage;$page++){if($page==$iPageNum){$nav.=" $page ";}else{$nav.=" <a href=\"$self?page=$page\">$page</a> ";}}
	if($iPageNum>1){
		$page=$iPageNum-1;
		$prev=" <a href=\"$self?page=$page\"><span class='SPrev'> আগে</span></a> ";
		$first=" <a href=\"$self?page=1\"><span class='SFirst'> প্রথম</span></a> ";
	}else{$prev="&nbsp;";$first="&nbsp;";}
	if($iPageNum<$maxPage){
		$page=$iPageNum+1;
		$next=" <a href=\"$self?page=$page\"><span class='SNext'>পরে</span></a> ";
		$last=" <a href=\"$self?page=$maxPage\"><span class='SLast'> শেষ </span></a> ";
	}else{$next="&nbsp;";$last="&nbsp;";}
	@mysqli_free_result($result); ?>
	<div class="row"><div class="col-sm-12">
		<div class="DPaginationL"><?php echo $first.$prev; ?></div><div class="DPaginationR"><?php echo $next.$last; ?></div>
	</div></div>

</div></div>

</section>


</div>
</main>

<?php include_once("../common/footer.php");@mysqli_close($connEMM); ?>

<?php echo $sJSjQuery; ?>
<?php echo $sJSBootStrap; ?>

<!--[if lt IE 9]>
<?php echo $sJShtml5shiv; ?>
<?php echo $sJSrespond; ?>
<![endif]-->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5bdfe13c32a4ade7"></script>

</body>
</html>