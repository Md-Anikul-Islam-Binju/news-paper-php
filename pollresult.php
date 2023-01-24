<?php include_once("common/mysqli_conneCT.php");include_once("common/config.php");
$sCurrURL=$sSiteURL."pollresult"; ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>অনলাইন জরিপ</title>

<meta name="description" content="Poll Result">
<meta name="keywords" content="Poll Result">

<meta http-equiv="refresh" content="300">
<meta name="author" content="<?php echo $sAuthor;?>">

<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="googlebot-news" content="index, follow">

<meta property="fb:app_id" content="2193803980899970">
<meta property="og:site_name" content="<?php echo $sSiteName;?>">
<meta property="og:title" content="Poll Result">
<meta property="og:description" content="Poll Result">
<meta property="og:url" content="<?php echo $sSiteURL; ?>pollresult.php">
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
						<li><a href="<?php echo $sSiteURL; ?>"><i class="fa fa-home" aria-hidden="true"></i> প্রচ্ছদ</a></li>
						<li class="active">অনলাইন জরিপ</li>
					</ol>
				</div>
			</div>

			<div class="row"><div class="col-sm-12">
				<table class="table table-hover">
				<thead>
				<tr>
					<th>প্রশ্ন</th>
					<th>হ্যাঁ</th>
					<th>না</th>
					<th>মন্তব্য নেই</th>
				</tr>
				</thead>
				<tbody>
				<?php $rowsPerPage=20;$pageNum=1;
				if(isset($_GET["page"])){$pageNum=$_GET["page"];}
				$offset=($pageNum-1)*$rowsPerPage;
				$qPollDetails="SELECT * FROM poll_question WHERE Deletable=1 AND PollDate<='".date("Y-m-d")."' ORDER BY PollID DESC LIMIT $offset, $rowsPerPage";
				$resultPollDetails=@mysqli_query($connEMM, $qPollDetails);
				while($rsPollDetails=@mysqli_fetch_array($resultPollDetails)){ ?>
				<tr>
					<td><?php echo fEn2Bn($rsPollDetails["PollQuestionBN"]); ?></td>
					<td><?php echo fEn2Bn($rsPollDetails["AnsYes"]); ?></td>
					<td><?php echo fEn2Bn($rsPollDetails["AnsNo"]); ?></td>
					<td><?php echo fEn2Bn($rsPollDetails["AnsNoComment"]); ?></td>
				</tr>
				<?php }@mysqli_free_result($resultPollDetails); ?>
				</table>
			</div></div>

			<div class="row"><div class="col-sm-12">
				<?php $qCoutner="SELECT COUNT(PollID) AS numrows FROM poll_question WHERE Deletable=1 AND PollDate<=".date("Y-m-d")."";
				$result=@mysqli_query($connEMM, $qCoutner) or die("Problem...");
				$row=@mysqli_fetch_array($result);
				$numrows=$row["numrows"];
				$maxPage=ceil($numrows/$rowsPerPage);
				$self=$_SERVER["PHP_SELF"];
				$nav="";

				for($page=1;$page<=$maxPage;$page++){
				   if($page==$pageNum){$nav.=" $page ";}else{$nav.=" <a href=\"$self?page=$page\">$page</a> ";}
				}
				if($pageNum>1){
					$page=$pageNum-1;
					$prev=" <a href=\"$self?page=$page\">[আগের পৃষ্ঠা]</a> ";
					$first=" <a href=\"$self?page=1\">[প্রথম]</a> ";
				}else{$prev="&nbsp;"; $first="&nbsp;";}
				if($pageNum<$maxPage){
					$page=$pageNum+1;
					$next=" <a href=\"$self?page=$page\">[পরের পৃষ্ঠা]</a> ";
					$last=" <a href=\"$self?page=$maxPage\">[সর্বশেষ]</a> ";
				}else{
					$next="&nbsp;";
					$last="&nbsp;";
				} ?>
				<div class="DPaginationL"><?php echo $first.$prev; ?></div>
				<div class="DPaginationR"><?php echo $next.$last; ?></div>
			</div></div>

			<div class="row DMarginT30"><div class="col-sm-12">
				<div class="addthis_relatedposts_inline"></div>
			</div></div>
		</div>
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