<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Web TV - Insert</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMMEn;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<script type="text/javascript">
function setfocus(){document.frmInsert.txtWebTVHeading.focus();}
$(document).ready(function(){$("#frmInsert").validate();});
</script>
</head>
<body onload="setfocus();">
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

	<form id="frmInsert" name="frmInsert" method="post" action="webTVInsertAction.php" enctype="multipart/form-data">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><th>Web TV - Insert</th></tr>
	<tr><td align="left" valign="middle">
		<p>Category:
		<select name="cboCategory">
		<?php $resultSQL=mysqli_query($connEMM, "SELECT CategoryID, CategoryName FROM tv_webtv_category WHERE Deletable=1");
		while($rsSQL=mysqli_fetch_assoc($resultSQL)){ ?>
			<option value="<?php echo $rsSQL["CategoryID"]; ?>"><?php echo $rsSQL["CategoryName"]; ?></option>
		<?php } ?>
		</select>
		Type:
		<select name="cboWebTVType">
			<option value="1">YouTube</option>
			<option value="2">Vimeo</option>
		</select>
		Heading:
		<input type="text" name="txtWebTVHeading" value="" required autofocus><?php echo $sMsgRequired; ?>
		Video ID:
		<input type="text" name="txtWebTVLink" value="" required><?php echo $sMsgRequired; ?></p>
		<p>Highlight at Home page:
		<select name="cboHighlightHome">
			<option value="1" selected="selected">Yes</option>
			<option value="2">No</option>
		</select>
		Highlight at Inner page:
		<select name="cboHighlightInner">
			<option value="1" selected="selected">Yes</option>
			<option value="2">No</option>
		</select>
		Video Footage:
		<select name="cboVideoFootage">
			<option value="1">Yes</option>
			<option value="2" selected="selected">No</option>
		</select>
		Today's Highlight:
		<select name="cboTodayHighlight">
			<option value="1">Yes</option>
			<option value="2" selected="selected">No</option>
		</select>
		</p>
		<p><input type="submit" name="btnSubmit" value="Insert" class="inpSubmit"></p>
	</td></tr>
	</table>
	</form>


	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr class="TrHeadings"><th colspan="6"><h3>
	<a href="webTVInsert.php">All</a> &nbsp;&nbsp;
		<?php $resultSQL=mysqli_query($connEMM, "SELECT CategoryID, CategoryName FROM tv_webtv_category WHERE Deletable=1");
		while($rsSQL=mysqli_fetch_assoc($resultSQL)){ ?>
			<a href="<?php echo $_SERVER["PHP_SELF"]."?CategoryID=".$rsSQL["CategoryID"]; ?>"><?php echo $rsSQL["CategoryName"]; ?></a> &nbsp;&nbsp;
		<?php } ?>
	</h3></th></tr>
	<tr class="TrHeadings">
		<th>Video Info</th>
		<th>Status</th>
		<th>Web TV Heading</th>
		<th>Vimeo Video Number & Perview</th>
		<th class="Td50">UPDATE</th>
		<th class="Td50">DELETE</th>
	</tr>

	<?php $rowsPerPage=50;$pageNum=1;
	if(isset($_GET["page"])){$pageNum=$_GET["page"];}
	if(isset($_GET["CategoryID"])){$iCagoryID=$_GET["CategoryID"];}else{$iCagoryID=0;}
	$offset=($pageNum-1)*$rowsPerPage;

	if($iCagoryID>0){
		$qContent="SELECT tv_webtv.*, tv_webtv_category.CategoryName FROM tv_webtv INNER JOIN tv_webtv_category ON tv_webtv_category.CategoryID=tv_webtv.CategoryID WHERE tv_webtv.Deletable=1 AND tv_webtv.CategoryID=".$iCagoryID." ORDER BY tv_webtv.WebTVID DESC LIMIT $offset, $rowsPerPage";
	}else{
		$qContent="SELECT tv_webtv.*, tv_webtv_category.CategoryName FROM tv_webtv INNER JOIN tv_webtv_category ON tv_webtv_category.CategoryID=tv_webtv.CategoryID WHERE tv_webtv.Deletable=1 ORDER BY tv_webtv.WebTVID DESC LIMIT $offset, $rowsPerPage";
	}
	$resultContent=mysqli_query($connEMM, $qContent) or die(mysqli_error($connEMM));
	while($rsContent=mysqli_fetch_assoc($resultContent)){ ?>
	<tr class="TrUpdateListSelect">
		<td align="left" valign="top">
			<?php echo $rsContent["CategoryName"]; ?><br>
			<?php if($rsContent["WebTVType"]==1){echo "YouTube";}else{echo "Vimeo";} ?>
		</td>
		<td align="left" valign="top">
			Home: <?php if($rsContent["TopHome"]==1){echo "Yes";}else{echo "No";} ?><br>
			Inner: <?php if($rsContent["TopInner"]==1){echo "Yes";}else{echo "No";} ?>
		</td>
		<td align="left" valign="top"><?php echo $rsContent["WebTVHeading"]; ?></td>
		<td align="left" valign="top">
			<?php echo $rsContent["WebTVLinkCode"]; ?><br>
			<?php if($rsContent["WebTVType"]==1){ ?>
			<img src="http://img.youtube.com/vi/<?php echo $rsContent["WebTVLinkCode"]; ?>/default.jpg">
			<?php }elseif($rsContent["WebTVType"]==2){ ?>
			<iframe src="http://player.vimeo.com/video/<?php echo $rsContent["WebTVLinkCode"]; ?>" width="330" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			<?php } ?>
		</td>
		<td align="center" valign="top"><a href="webTVUpdate.php?updateid=<?php echo $rsContent["WebTVID"]; ?>">Update</a></td>
		<td align="center" valign="top"><a href="webTVDelete.php?deleteid=<?php echo $rsContent["WebTVID"]; ?>">Delete</a></td>
	</tr>
	<?php }mysqli_free_result($resultContent); ?>

	<tr><td valign="top" colspan="10">
	<?php
	if($iCagoryID>0){
		$qSQL="SELECT COUNT(WebTVID) AS numrows FROM tv_webtv WHERE Deletable=1 AND CategoryID=".$iCagoryID;
	}else{
		$qSQL="SELECT COUNT(WebTVID) AS numrows FROM tv_webtv WHERE Deletable=1";
	}
	$result=mysqli_query($connEMM, "SELECT COUNT(WebTVID) AS numrows FROM tv_webtv WHERE Deletable=1") or die("Error, query failed");
	$row=mysqli_fetch_assoc($result);
	$numrows=$row["numrows"];
	$maxPage=ceil($numrows/$rowsPerPage);
	$self=$_SERVER["PHP_SELF"];$nav="";

	for($page=1;$page<=$maxPage;$page++){if($page==$pageNum){$nav.=" $page ";}else{$nav.=" <a href=\"$self?page=$page\">$page</a> ";}}
	if($pageNum>1){
		$page=$pageNum-1;
		$prev=" <a href=\"$self?page=$page\">[Prev]</a> ";
		$first=" <a href=\"$self?page=1\">[First Page]</a> ";
	}else{$prev="&nbsp;";$first="&nbsp;";}
	if($pageNum<$maxPage){
		$page=$pageNum+1;
		$next=" <a href=\"$self?page=$page\">[Next]</a> ";
		$last=" <a href=\"$self?page=$maxPage\">[Last Page]</a> ";
	}else{$next="&nbsp;";$last="&nbsp;";}mysqli_free_result($result); ?>
	<div class="DPaginationL"><?php echo $first.$prev; ?></div><div class="DPaginationR"><?php echo $next.$last; ?></div>
	</td></tr>
	</table>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>