<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Content - Update List (Bangla)</title>
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
function confirmContentID(){alert("Please type a valid NUMBER for Content");return;}
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
	<tr><td align="right" valign="middle" colspan="5"><a href="scheduleContentInsert.php">Insert</a></td></tr>
	<tr><th colspan="5">Content - Update List (Bangla)</th></tr>
	<tr class="TrHeadings">
		<th>Category</th>
		<th>Heading</th>
		<th>Brief Content</th>
		<th class="Td50">UPDATE</th>
		<th class="Td50">DELETE</th>
	</tr>
	<?php
	$qContent="SELECT bn_content_schedule.*, bn_bas_category.CategoryName, bn_bas_category.Slug, bn_bas_subcategory.SubCategoryName, bn_bas_specialcategory.SpecialCategoryName,  bn_totalhit.TotalHit FROM bn_content_schedule INNER JOIN bn_bas_category ON bn_content_schedule.CategoryID=bn_bas_category.CategoryID INNER JOIN bn_bas_subcategory ON bn_content_schedule.SubCategoryID=bn_bas_subcategory.SubCategoryID INNER JOIN bn_bas_specialcategory ON bn_bas_specialcategory.SpecialCategoryID=bn_content_schedule.SpecialCategoryID INNER JOIN bn_totalhit ON bn_totalhit.ContentID=bn_content_schedule.ContentID WHERE bn_content_schedule.Deletable=1 ORDER BY bn_content_schedule.ContentID DESC";
	$resultContent=mysqli_query($connEMM, $qContent) or die(mysqli_error($connEMM));
	while($rsContent=mysqli_fetch_assoc($resultContent)){
	$sContentID=$rsContent["ContentID"];
	$sHead=$rsContent["ContentHeading"]; ?>
	<tr class="TrUpdateListSelect">
	<td align="left" valign="top" class="TdCategory">
	<div class="DCategory"><?php echo $rsContent["CategoryName"]; ?></div>
	<div class="DSubSpeCategory">
	Sub Category: <?php echo $rsContent["SubCategoryName"]; ?>
	Top: <?php echo $rsContent["SubCategoryIDPos"]-1; ?>
	</div>
	<div class="DSubSpeCategory">
	Special Category: <?php echo $rsContent["SpecialCategoryName"]; ?>
	Top: <?php echo $rsContent["SpecialCategoryIDPos"]-1; ?>
	</div>
	<b>Insert</b>: <?php echo $rsContent["DateTimeInserted"]; ?><br>
	<b>Update</b>: <?php echo $rsContent["DateTimeUpdated"]; ?><br>
	<b>Home</b>:
	<?php if($rsContent["TopHome"]==1){
		echo "NONE";
	}elseif($rsContent["TopHome"]==2){
		echo "<span class='SpnTop'>List</span>";
	}
	for($iTop=3;$iTop<=7;$iTop++){
		if($rsContent["TopHome"]==$iTop){
			$i=$iTop-2;
			echo "<span class='SpnTop'>".$i."</span>";
		}
	}
	?><br>
	<b>Inner</b>:
	<?php
	if($rsContent["TopInner"]==1){echo "NONE";}
		for($iTop=2;$iTop<=6;$iTop++){
			if($rsContent["TopInner"]==$iTop){
				$i=$iTop-1;
				echo "<span class='SpnTop'>".$i."</span>";
			}
		} ?><br>
	<b>Hit</b>: <?php echo $rsContent["TotalHit"]; ?><br>
		
		<div class="DSubSpeCategory">
		<?php
		$iInvalidS=0;$iInvalidB=0;

		$sImageSMPath=$rsContent["ImageSMPath"];
		$sImgPathSM=$sPathProjDir."/media/imgAll/".$sImageSMPath;
		$sImgURLSM=$sSiteURL."/media/imgAll/".$sImageSMPath;

		if($sImageSMPath!=""){
			if(file_exists($sImgPathSM)){
				if(getimagesize($sImgPathSM)){
					list($iWidthS, $iHeightS, $iTypeS, $iAttrS)=getimagesize($sImgPathSM);
					if($iWidthS<600){$iInvalidS=1;}
					if($iHeightS<315){$iInvalidS=1;}
				}else{
					echo $sMsgImgInvalidFile;
				}
			}else{
				echo $sMsgImgInvalidFile;
			}
		}

		$sImageBGPath=$rsContent["ImageBGPath"];
		$sImgPathBG=$sPathProjDir."/media/imgAll/".$sImageBGPath;
		$sImgURLBG=$sSiteURL."/media/imgAll/".$sImageBGPath;

		if($sImageBGPath!=""){
			if(file_exists($sImgPathBG)){
				if(getimagesize($sImgPathBG)){
					list($iWidthS, $iHeightS, $iTypeS, $iAttrS)=getimagesize($sImgPathBG);
					if($iWidthS<600){$iInvalidB=1;}
					if($iHeightS<315){$iInvalidB=1;}
				}else{
					echo $sMsgImgInvalidFile;
				}
			}else{
				echo $sMsgImgInvalidFile;
			}
		} ?>
		</div>
	</td>
	<td align="left" valign="top" class="bn">
	<?php
		if($sImageBGPath!=""){
			if($iInvalidB==1){echo "<p class='pInvalid'>Invalide Image Size</p>";}
		}elseif($sImageSMPath!=""){
			if($iInvalidS==1){echo "<p class='pInvalid'>Invalide Image Size</p>";}
		}
	?>
		<a href="<?php echo $sSiteURL.fFormatURL($rsContent["Slug"]).'-news/'.$sContentID; ?>" target="_blank">
		<?php echo "<h4>".$rsContent["ContentSubHeading"]."</h4>".$sHead; ?>
		</a>
	</td>
	<td align="left" valign="top" class="bn"><?php echo $rsContent["ContentBrief"]; ?></td>
	<td align="center" valign="top" class="Td50"><a href="scheduleContentUpdate.php?updateid=<?php echo $rsContent["ContentID"]; ?>">Update</a></td>
	<td align="center" valign="top" class="Td50"><a href="scheduleContentDelete.php?deleteid=<?php echo $rsContent["ContentID"]; ?>" onclick="return confirmDelete();">Delete</a></td>
	</tr>
	<?php }mysqli_free_result($resultContent); ?>
	</table>
	<?php $_SESSION["sessRedirectPageBN"]=$_SERVER["REQUEST_URI"]; ?>
</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>