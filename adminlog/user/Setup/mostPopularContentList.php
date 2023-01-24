<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Most Popular Content List (Bangla)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;

echo $jsCkEditorFull;
?>
<!-- DatePicker -->
<?php echo $jsjQueryUI; ?>
<?php echo $cssjQueryUI; ?>
<script language="javascript">
function setfocus(){document.frmDate.txtContentDate.focus();}
$(document).ready(function(){
	$("#frmDate").validate({});
	$("#txtContentDate").datepicker();
});
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
	<tr><td align="right" valign="middle" colspan="8"><a href="contentInsert.php">Insert</a></td></tr>
	<tr><th colspan="8">Most Popular Content List (Bangla)</th></tr>
	<tr><td colspan="8" class="TdSearch">
	<form name="frmDate" action="mostPopularContentList.php" method="post">
	Most popoular news of:
	<input type="text" id="txtContentDate" name="txtContentDate" maxlength="10" class="required" value="<?php echo date("m/d/Y"); ?>" readonly="readonly"><?php echo $sMsgRequired; ?>
	<input type="submit" name="btnSubmit" value="Search">
	</form>
	</td></tr>
	<tr class="TrHeadings">
		<th>Category</th>
		<th>Heading</th>
		<th>Brief Content</th>
		<th>Content Situation</th>
	</tr>
	<?php
	if(isset($_REQUEST["txtContentDate"])){$iSearchType=$_REQUEST["txtContentDate"];}else{$iSearchType=0;}

	$qContent="SELECT bn_content.ContentID, bn_content.CategoryID, bn_bas_category.CategoryName, bn_bas_subcategory.SubCategoryName, bn_bas_specialcategory.SpecialCategoryName, bn_content.ContentSubHeading, bn_content.ContentHeading, bn_content.ContentBrief, bn_content.DateTimeInserted, bn_content.DateTimeUpdated, bn_content.ShowContent, bn_content.Editable, bn_content.PrevContentID, bn_totalhit.TotalHit FROM bn_content INNER JOIN bn_bas_category ON bn_content.CategoryID=bn_bas_category.CategoryID INNER JOIN bn_bas_subcategory ON bn_content.SubCategoryID=bn_bas_subcategory.SubCategoryID INNER JOIN bn_bas_specialcategory ON bn_bas_specialcategory.SpecialCategoryID=bn_content.SpecialCategoryID INNER JOIN bn_totalhit ON bn_totalhit.ContentID=bn_content.ContentID WHERE bn_content.Deletable=1 ORDER BY bn_content.ContentID DESC LIMIT 20";
	if($iSearchType>0){
		$qContent="SELECT bn_content.ContentID, bn_content.CategoryID, bn_bas_category.CategoryName, bn_content.TopHome, bn_content.TopInner, bn_content.SubCategoryID, bn_bas_subcategory.SubCategoryName, bn_content.SubCategoryIDPos, bn_content.SpecialCategoryID, bn_bas_specialcategory.SpecialCategoryName, bn_content.SpecialCategoryIDPos, bn_content.ContentSubHeading, bn_content.ContentHeading, bn_content.ContentBrief, bn_content.DateTimeInserted, bn_content.DateTimeUpdated, bn_content.ShowContent, bn_content.Editable, bn_content.PrevContentID, bn_totalhit.TotalHit FROM bn_content INNER JOIN bn_bas_category ON bn_content.CategoryID=bn_bas_category.CategoryID INNER JOIN bn_bas_subcategory ON bn_content.SubCategoryID=bn_bas_subcategory.SubCategoryID INNER JOIN bn_bas_specialcategory ON bn_bas_specialcategory.SpecialCategoryID=bn_content.SpecialCategoryID INNER JOIN bn_totalhit ON bn_totalhit.ContentID=bn_content.ContentID WHERE bn_content.Deletable=1";
	if($iSearchType==1){
	//For Searching ContentID
	if(is_numeric($sSearch)){//For valid ContentID if Number
		$qContent.=" AND bn_content.ContentID=".$sSearch;
	}else{ ?>
	<script type="text/javascript">confirmContentID();</script>
	<?php }
	}elseif($iSearchType==2){
		//For Searching content in Head/ SubHead/Brief/Details
		$qContent.=" AND (bn_content.ContentHeading LIKE '%".$sSearch."%' OR bn_content.ContentSubHeading LIKE '%".$sSearch."%' OR bn_content.ContentBrief LIKE '%".$sSearch."%' OR bn_content.ContentDetails LIKE '%".$sSearch."%')";
	}elseif($iSearchType==3){
		//For Searching Writer
		$qContent.=" AND bn_content.Writers='".$sSearch."'";
	}
		$qContent.=" ORDER BY bn_content.ContentID DESC LIMIT $offset, $rowsPerPage";
	}
	//echo $qContent."<br>";
	$resultContent=mysqli_query($connEMM, $qContent) or die(mysqli_error($connEMM));
	while($rsContent=mysqli_fetch_assoc($resultContent)){
	$sContentID=$rsContent["ContentID"];
	$sHead=$rsContent["ContentHeading"]; ?>
	<tr class="TrUpdateListSelect">
		<td align="left" valign="top" class="TdCategory tdBn">
		<div class="DCategory"><a href="contentUpdateList.php?catid=<?php echo $rsContent["CategoryID"]; ?>&page=1"><?php echo $rsContent["CategoryName"]; ?></a></div>
		<div class="DSubSpeCategory">
		Sub Category: <a href="subContentUpdateList.php?subcatid=<?php echo $rsContent["SubCategoryID"]; ?>&page=1"><?php echo $rsContent["SubCategoryName"]; ?></a>
		Top: <?php echo $rsContent["SubCategoryIDPos"]-1; ?>
		</div>
		<div class="DSubSpeCategory">
		Special Category: <a href="speContentUpdateList.php?specatid=<?php echo $rsContent["SpecialCategoryID"]; ?>&page=1"><?php echo $rsContent["SpecialCategoryName"]; ?></a>
		Top: <?php echo $rsContent["SpecialCategoryIDPos"]-1; ?>
		</div>
		</td>
		<td align="left" valign="top" class="tdBn">
		<a href="<?php echo $sSiteURL.fFormatURL($sHead).'/'.$sContentID; ?>" target="_blank">
		<?php echo "<h4>".$rsContent["ContentSubHeading"]."</h4>".$sHead; ?>
		</a>
		</td>
		<td align="left" valign="top" class="tdBn"><?php echo $rsContent["ContentBrief"]; ?></td>
		<td align="left" valign="top" class="TdContentInfo">
		<b>Insert</b>: <?php echo $rsContent["DateTimeInserted"]; ?><br>
		<b>Update</b>: <?php echo $rsContent["DateTimeUpdated"]; ?><br>
		<b>Home</b>:
		<?php if($rsContent["TopHome"]==1){
			echo "NONE";
		}elseif($rsContent["TopHome"]==2){
			echo "<span class='SpnTop'>Slide</span>";
		}elseif($rsContent["TopHome"]==3){
			echo "<span class='SpnTop'>Sticky</span>";
		}
		/*for($iTop=3;$iTop<=7;$iTop++){
			if($rsContent["TopHome"]==$iTop){
				$i=$iTop-2;
				echo "<span class='SpnTop'>".$i."</span>";
			}
		}*/
		?><br>
		<b>Inner</b>:
		<?php
		if($rsContent["TopInner"]==1){echo "NONE";}
		if($rsContent["TopInner"]==2){echo "Sticky";}
			/*for($iTop=2;$iTop<=6;$iTop++){
				if($rsContent["TopInner"]==$iTop){
					$i=$iTop-1;
					echo "<span class='SpnTop'>".$i."</span>";
				}
			}*/ ?><br>
		<b>Hit</b>: <?php echo $rsContent["TotalHit"]; ?><br>
		</td>
	</tr>
	<?php }mysqli_free_result($resultContent); ?>

	<tr><td valign="top" colspan="8">
	<?php //how many rows we have in database
	if($iCategoryID>0){$qCoutner="SELECT COUNT(ContentID) AS numrows FROM bn_content WHERE CategoryID=".$iCategoryID." AND Deletable=1";
	}else{$qCoutner="SELECT COUNT(ContentID) AS numrows FROM bn_content WHERE Deletable=1";}
	if($iSearchType==1){
	if(is_numeric($sSearch)){//For valid ContentID if Number
		$qContent.="SELECT COUNT(ContentID) AS numrows FROM bn_content WHERE Deletable=1 AND ContentID=".$sSearch;
	}
	}elseif($iSearchType==2){
		$qCoutner="SELECT COUNT(ContentID) AS numrows FROM bn_content WHERE bn_content.Deletable=1 AND (ContentHeading LIKE '%".$sSearch."%' OR ContentSubHeading LIKE '%".$sSearch."%' OR ContentBrief LIKE '%".$sSearch."%' OR ContentDetails LIKE '%".$sSearch."%')";
	}elseif($iSearchType==3){
		$qContent.="SELECT COUNT(ContentID) AS numrows FROM bn_content WHERE Deletable=1 AND bn_content.Writers='".$sSearch."'";
	}
	$result=mysqli_query($connEMM, $qCoutner) or die("Error, query failed");
	$row=mysqli_fetch_assoc($result);
	$numrows=$row["numrows"];
	$maxPage=ceil($numrows/$rowsPerPage);
	$self=$_SERVER["PHP_SELF"];$nav="";

	for($page=1;$page<=$maxPage;$page++){if($page==$pageNum){$nav.=" $page ";}else{$nav.=" <a href=\"$self?catid=$iCategoryID&page=$page&SearchTxt=$sSearch\">$page</a> ";}}
	if($pageNum>1){
		$page=$pageNum-1;
		$prev=" <a href=\"$self?catid=$iCategoryID&page=$page&SearchTxt=$sSearch\">[Prev]</a> ";
		$first=" <a href=\"$self?catid=$iCategoryID&page=1&SearchTxt=$sSearch\">[First Page]</a> ";
	}else{$prev="&nbsp;";$first="&nbsp;";}
	if($pageNum<$maxPage){
		$page=$pageNum+1;
		$next=" <a href=\"$self?catid=$iCategoryID&page=$page&SearchTxt=$sSearch\">[Next]</a> ";
		$last=" <a href=\"$self?catid=$iCategoryID&page=$maxPage&SearchTxt=$sSearch\">[Last Page]</a> ";
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