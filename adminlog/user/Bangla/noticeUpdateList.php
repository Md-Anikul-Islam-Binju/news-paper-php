<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Notice - Update List</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<script type="text/javascript">
function confirmDelete(){return confirm("Are you sure you wish to delete this entry?");}
function confirmNoticeID(){alert("Please type a valid NUMBER for NoticeID");return;}
</script>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><td align="right" valign="middle" colspan="8"><a href="noticeInsert.php">Insert</a></td></tr>
	<tr><th colspan="8">Notice - Update List</th></tr>
	<tr class="TrHeadings">
		<th>Notice Heading</th>
		<th>Brief Content</th>
		<th>Content Situation</th>
		<th class="Td50">UPDATE</th>
		<th class="Td50">DELETE</th>
	</tr>
	<?php $rowsPerPage=50;$pageNum=1;
	$iSearchType=0;$sSearch="";
	if(isset($_REQUEST["page"])){$pageNum=$_REQUEST["page"];}
	$offset=($pageNum-1)*$rowsPerPage;
	
	$qContent="SELECT NoticeID, NoticeHeading, NoticeBrief, DateTimeInserted, DateTimeUpdated FROM bn_notice WHERE Deletable=1 ORDER BY NoticeID DESC LIMIT $offset, $rowsPerPage";
	//echo $qContent."<br>";
	$resultContent=mysqli_query($connEMM, $qContent) or die(mysqli_error($connEMM));
	while($rsContent=mysqli_fetch_assoc($resultContent)){ ?>
	<tr class="TrUpdateListSelect">
		<td align="left" valign="top" class="TdCategory tdBn">
		<a href="<?php echo $sSiteURL; ?>notice.php?nssl=<?php echo $rsContent["EncryptedValue"]; ?>" target="_blank"><?php echo "</h4>".$rsContent["NoticeHeading"]; ?></a>
		</td>
		<td align="left" valign="top" class="tdBn"><?php echo $rsContent["NoticeBrief"]; ?></td>
		<td align="left" valign="top" class="TdContentInfo">
			<b>Insert</b>: <?php echo $rsContent["DateTimeInserted"]; ?><br>
			<b>Update</b>: <?php echo $rsContent["DateTimeUpdated"]; ?><br>
		</td>
		<td align="center" valign="top" class="Td50"><a href="noticeUpdate.php?updateid=<?php echo $rsContent["NoticeID"]; ?>">Update</a></td>
		<td align="center" valign="top" class="Td50"><a href="noticeDelete.php?deleteid=<?php echo $rsContent["NoticeID"]; ?>" onclick="return confirmDelete();">Delete</a></td>
	</tr>
	<?php }mysqli_free_result($resultContent); ?>

	<tr><td valign="top" colspan="8">
	<?php //how many rows we have in database
	$qCoutner="SELECT COUNT(NoticeID) AS numrows FROM bn_notice WHERE Deletable=1";
	$result=mysqli_query($connEMM, $qCoutner) or die("Error, query failed");
	$row=mysqli_fetch_assoc($result);
	$numrows=$row["numrows"];
	$maxPage=ceil($numrows/$rowsPerPage);
	$self=$_SERVER["PHP_SELF"];
	$nav="";

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
	<?php $_SESSION["sessRedirectPageBN"]=$_SERVER["REQUEST_URI"]; ?>
</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>