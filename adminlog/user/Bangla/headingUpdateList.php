<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Content - Update List HEAD</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsjQueryValidate;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><th colspan="5">Content - Update HEADING (Bangla)</th></tr>
	<tr class="TrHeadings">
		<th>ID</th>
		<th>Heading</th>
		<th>Sub</th>
		<th>Writer</th>
		<th class="Td50">UPDATE</th>
	</tr>
	<?php $rowsPerPage=100;$pageNum=1;$iNumRows=0;
	if(isset($_GET["page"])){$pageNum=$_GET["page"];}
	$offset=($pageNum-1) * $rowsPerPage;
	$qContent="SELECT ContentID, ContentHeading, ContentSubHeading, Writers FROM bn_content WHERE Deletable=1 AND
	(
		ContentHeading LIKE '%font%' OR ContentSubHeading LIKE '%font%' OR Writers LIKE '%font%' OR
		ContentHeading LIKE '%<br>%' OR ContentSubHeading LIKE '%<br>%' OR Writers LIKE '%<br>%' OR
		ContentHeading LIKE '%<br>%' OR ContentSubHeading LIKE '%<br>%' OR Writers LIKE '%<br>%' OR
		ContentHeading LIKE '%<blink>%' OR ContentSubHeading LIKE '%<blink>%' OR Writers LIKE '%<blink>%' OR
		CHAR_LENGTH(ContentHeading)>65
	)
	ORDER BY ContentID ASC LIMIT $offset, $rowsPerPage";
	//echo $qContent."<br>";
	$resultContent=mysqli_query($connEMM, $qContent) or die(mysqli_error($connEMM));
	while($rsContent=mysqli_fetch_assoc($resultContent)){ ?>
	<tr class="TrUpdateListSelect">
		<td align="left" valign="top" class="tdBn"><?php echo $rsContent["ContentID"]; ?></td>
		<td align="left" valign="top" class="tdBn"><?php echo $rsContent["ContentHeading"]; ?></td>
		<td align="left" valign="top" class="tdBn"><?php echo $rsContent["ContentSubHeading"]; ?></td>
		<td align="left" valign="top" class="tdBn"><?php echo $rsContent["Writers"]; ?></td>
		<td align="center" valign="top"><a href="headingUpdate.php?updateid=<?php echo $rsContent["ContentID"]; ?>">Update</a></td>
	</tr>
	<?php }mysqli_free_result($resultContent); ?>

	<tr><td valign="top" colspan="10">
	<?php
	$qSQL="SELECT COUNT(ContentID) AS numrows FROM bn_content WHERE Deletable=1 AND
	(
		ContentHeading LIKE '%font%' OR ContentSubHeading LIKE '%font%' OR Writers LIKE '%font%' OR
		ContentHeading LIKE '%<br>%' OR ContentSubHeading LIKE '%<br>%' OR Writers LIKE '%<br>%' OR
		ContentHeading LIKE '%<br>%' OR ContentSubHeading LIKE '%<br>%' OR Writers LIKE '%<br>%' OR
		ContentHeading LIKE '%<blink>%' OR ContentSubHeading LIKE '%<blink>%' OR Writers LIKE '%<blink>%' OR
		CHAR_LENGTH(ContentHeading)>65
	)";
	$result=mysqli_query($connEMM, $qSQL) or die("Error, query failed");
	$row=mysqli_fetch_assoc($result);
	$iNumRows=$row["numrows"];
	$maxPage=ceil($iNumRows/$rowsPerPage);
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
	<div><h3>There are about <?php echo $iNumRows; ?> records</h3></div>
	<div class="DPaginationL"><?php echo $first.$prev; ?></div><div class="DPaginationR"><?php echo $next.$last; ?></div>
	</td></tr>
	</table>
	<?php $_SESSION["sessRedirectPageEN"]=$_SERVER["REQUEST_URI"]; ?>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>