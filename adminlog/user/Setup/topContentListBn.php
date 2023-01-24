<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Top Content List (Bangla)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<script type="text/javascript">function confirmDelete(){return confirm("Are you sure you wish to delete this entry?");}</script>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">
	<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl98">
	<tr><td align="right" colspan="8"><a href="topContentListBn.php">[Bangla]</a> &nbsp; <a href="topContentListEn.php">[English]</a></td></tr>
	<tr><th colspan="8">Top Content List (Bangla)</th></tr>
	<tr><td colspan="8" class="TdUpdateCat">
		<a href="topContentListBn.php?catid=0&page=1" class="AEn">ALL</a>
		<?php $resultCategory=mysqli_query($connEMM, "SELECT * FROM bn_bas_category WHERE Deletable=1 ORDER BY CategoryName ASC") or die(mysqli_error($connEMM));
		while($rsCategory=mysqli_fetch_assoc($resultCategory)){
			echo "<a href='topContentListBn.php?catid=".$rsCategory["CategoryID"]."&page=1'>".$rsCategory["CategoryName"]."</a>";
		}mysqli_free_result($resultCategory); ?>
	</td></tr>
	<tr class="TrHeadings">
		<th>Category</th>
		<th>Heading</th>
		<th>Brief Content</th>
		<th>Content Situation</th>
	</tr>
	<?php $rowsPerPage=30;$pageNum=1;
	if(isset($_GET["page"])){$pageNum=$_GET["page"];}
	if(isset($_GET["catid"])){$iCategoryID=$_GET["catid"];}else{$iCategoryID=0;}
	$offset=($pageNum-1)*$rowsPerPage;

	if($iCategoryID>0){
		$qContent="SELECT bn_content.ContentID, bn_content.CategoryID, bn_bas_category.CategoryName, bn_bas_specialcategory.SpecialCategoryName, bn_content.ContentSubHeading, bn_content.ContentHeading, bn_content.ContentBrief, bn_totalhit.TotalHit, bn_content.Deletable FROM bn_content INNER JOIN bn_bas_category ON bn_content.CategoryID=bn_bas_category.CategoryID INNER JOIN bn_totalhit ON bn_totalhit.ContentID=bn_content.ContentID INNER JOIN bn_bas_specialcategory ON bn_bas_specialcategory.SpecialCategoryID=bn_content.SpecialCategoryID WHERE bn_content.CategoryID=".$iCategoryID." ORDER BY bn_totalhit.TotalHit DESC LIMIT $offset, $rowsPerPage";
	}else{
		$qContent="SELECT bn_content.ContentID, bn_content.CategoryID, bn_bas_category.CategoryName, bn_bas_specialcategory.SpecialCategoryName, bn_content.ContentSubHeading, bn_content.ContentHeading, bn_content.ContentBrief, bn_totalhit.TotalHit, bn_content.Deletable FROM bn_content INNER JOIN bn_bas_category ON bn_content.CategoryID=bn_bas_category.CategoryID INNER JOIN bn_totalhit ON bn_totalhit.ContentID=bn_content.ContentID INNER JOIN bn_bas_specialcategory ON bn_bas_specialcategory.SpecialCategoryID=bn_content.SpecialCategoryID ORDER BY bn_totalhit.TotalHit DESC LIMIT $offset, $rowsPerPage";}
	//echo $qContent."<br>";
	$resultContent=mysqli_query($connEMM, $qContent) or die(mysqli_error($connEMM));
	while($rsContent=mysqli_fetch_assoc($resultContent)){
	$sContentID=$rsContent["ContentID"];
	$sHead=$rsContent["ContentHeading"]; ?>
	<tr class="TrUpdateListSelect">
		<td align="left" valign="top" class="TdCategory tdBn">
		<div class="DCategory"><a href="../topContentListBn.php?catid=<?php echo $rsContent["CategoryID"]; ?>&page=1"><?php echo $rsContent["CategoryName"]; ?></a></div>
		<div class="DSubSpeCategory">Special Category: <?php echo $rsContent["SpecialCategoryName"]; ?></div>
		</td>
		<td align="left" valign="top" class="tdBn">
		<a href="<?php echo $sSiteURL.fFormatURL($sHead).'/'.$sContentID; ?>" target="_blank">
		<?php echo "<h4>".$rsContent["ContentSubHeading"]."</h4>".$rsContent["ContentHeading"]; ?>
		</a>
		</td>
		<td align="left" valign="top" class="tdBn"><?php echo $rsContent["ContentBrief"]; ?></td>
		<td align="left" valign="top">
		<h4>Total hit: <?php echo $rsContent["TotalHit"]; ?></h4>
		Deletable: <?php if($rsContent["Deletable"]==1){ echo "No";}else{echo "<b>Yes..</b>";} ?><br>
		</td>
	</tr>
	<?php }mysqli_free_result($resultContent); ?>

	<tr><td valign="top" colspan="10">
	<?php //how many rows we have in database
	if($iCategoryID>0){$qCoutner="SELECT COUNT(ContentID) AS numrows FROM bn_content WHERE CategoryID=".$iCategoryID;
	}else{$qCoutner="SELECT COUNT(ContentID) AS numrows FROM bn_content";}
	$result=mysqli_query($connEMM, $qCoutner) or die("Error, query failed");
	$row=mysqli_fetch_assoc($result);
	$numrows=$row["numrows"];
	$maxPage=ceil($numrows/$rowsPerPage);
	$self=$_SERVER["PHP_SELF"];$nav="";
	
	for($page=1;$page<=$maxPage;$page++){if($page==$pageNum){$nav.=" $page ";}else{$nav.=" <a href=\"$self?categoryid=$iCategoryID&page=$page\">$page</a> ";}}
	if($pageNum>1){
		$page=$pageNum-1;
		$prev=" <a href=\"$self?catid=$iCategoryID&page=$page\">[Prev]</a> ";
		$first=" <a href=\"$self?catid=$iCategoryID&page=1\">[First Page]</a> ";
	}else{$prev="&nbsp;";$first="&nbsp;";}
	if($pageNum<$maxPage){
		$page=$pageNum+1;
		$next=" <a href=\"$self?catid=$iCategoryID&page=$page\">[Next]</a> ";
		$last=" <a href=\"$self?catid=$iCategoryID&page=$maxPage\">[Last Page]</a> ";
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