<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Manage Content Top - Update (BANGLA)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;

echo $jsGetSub;
?>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

<?php $iUpdateID=$_REQUEST["updateid"];
$qUpdate="SELECT bn_content.ContentID, bn_content.CategoryID, bn_bas_category.CategoryName, bn_content.TopHome, bn_content.TopInner, bn_content.SubCategoryID, bn_bas_subcategory.SubCategoryName, bn_content.SubCategoryIDPos, bn_content.SpecialCategoryID, bn_bas_specialcategory.SpecialCategoryName, bn_content.SpecialCategoryIDPos, bn_content.ContentSubHeading, bn_content.ContentHeading, bn_content.ContentBrief, bn_content.DateTimeInserted, bn_content.DateTimeUpdated, bn_content.ImageSMPath FROM bn_content INNER JOIN bn_bas_category ON bn_content.CategoryID=bn_bas_category.CategoryID INNER JOIN bn_bas_subcategory ON bn_content.SubCategoryID=bn_bas_subcategory.SubCategoryID INNER JOIN bn_bas_specialcategory ON bn_bas_specialcategory.SpecialCategoryID=bn_content.SpecialCategoryID WHERE bn_content.Deletable=1 AND bn_content.ContentID=".$iUpdateID;
	$resultUpdate=mysqli_query($connEMM, $qUpdate);
	$rsUpdate=mysqli_fetch_assoc($resultUpdate);
	$iSubCategoryID=$rsUpdate["SubCategoryID"];

	$resultCategory=mysqli_query($connEMM, "SELECT CategoryID, CategoryName FROM bn_bas_category WHERE Deletable=1 ORDER BY Priority") or die(mysqli_error($connEMM));
	$resultSpecCat=mysqli_query($connEMM, "SELECT SpecialCategoryID, SpecialCategoryName FROM bn_bas_specialcategory ORDER BY SpecialCategoryID") or die(mysqli_error($connEMM)); ?>
	<form id="frmUpdate" name="frmUpdate" action="manageTopUpdateAction.php?updateid=<?php echo $iUpdateID; ?>" enctype="multipart/form-data" method="post">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><td align="right" valign="middle" colspan="2"><a href="manageTopUpdateList.php">List</a></td></tr>
	<tr><th colspan="2">Manage Content Top - Update (BANGLA)</th></tr>
	<tr>
		<td align="right" valign="top">Type of Content:</td>
		<td align="left" valign="top">
			<div class="DFloating1">
			<select name="cboCategory" class="selBN" onchange="getSubCatBNUp(this.value, <?php echo $iSubCategoryID; ?>)">
			<?php while($rsCategory=mysqli_fetch_assoc($resultCategory)){ ?>
				<option value="<?php echo $rsCategory["CategoryID"]; ?>" <?php if($rsCategory["CategoryID"]==$rsUpdate["CategoryID"]){echo "selected='selected'";} ?>><?php echo $rsCategory["CategoryName"]; ?></option>
			<?php }mysqli_free_result($resultCategory); ?>
			</select>
			</div>
			<div class="DFloating2">
			<b>Content Position</b>:
			Home Page: <select name="cboTopHome">
				<option value="1" <?php if($rsUpdate["TopHome"]==1){echo "selected='selected'";} ?>>NONE</option>
				<option value="2" <?php if($rsUpdate["TopHome"]==2){echo "selected='selected'";} ?>>Slide</option>
				<?php for($iTop=3;$iTop<=7;$iTop++){ ?>
				<option value="<?php echo $iTop; ?>" <?php if($rsUpdate["TopHome"]==$iTop){echo "selected='selected'";} ?>>Top <?php echo $iTop-2; ?></option>
				<?php } ?>
			</select>
			Inner Page: <select name="cboTopInner">
				<option value="1" <?php if($rsUpdate["TopInner"]==2){echo "selected='selected'";} ?>>NONE</option>
				<?php for($iTop=2;$iTop<=8;$iTop++){ ?>
				<option value="<?php echo $iTop; ?>" <?php if($rsUpdate["TopInner"]==$iTop){echo "selected='selected'";} ?>>Top <?php echo $iTop-1; ?></option>
				<?php } ?>
			</select>
			</div>
		</td>
	</tr>
	<tr>
		<td align="right" valign="top">Sub-Category:</td>
		<td align="left" valign="top">
			<div class="DFloating1">
			<select id="cboSubCategoryID" name="cboSubCategoryID" class="selBN">
			</select>
			</div>
			<div class="DFloating2">
			<b>Content Position</b>:
			<select name="cboSubCategoryIDPos">
				<option value="1" <?php if($rsUpdate["SubCategoryIDPos"]==1){echo "selected='selected'";} ?>>NONE</option>
				<?php for($iTop=2;$iTop<=8;$iTop++){ ?>
				<option value="<?php echo $iTop; ?>" <?php if($rsUpdate["SubCategoryIDPos"]==$iTop){echo "selected='selected'";} ?>>Top <?php echo $iTop-1; ?></option>
				<?php } ?>
			</select>
			</div>
		</td>
	</tr>
	<tr>
		<td align="right" valign="top">Special Category:</td>
		<td align="left" valign="top">
			<div class="DFloating1">
			<select name="cboSpecialCategoryID" class="selBN">
			<?php while($rsSpecCat=mysqli_fetch_assoc($resultSpecCat)){ ?>
				<option value="<?php echo $rsSpecCat["SpecialCategoryID"]; ?>" <?php if($rsSpecCat["SpecialCategoryID"]==$rsUpdate["SpecialCategoryID"]){echo "selected='selected'";} ?>><?php echo $rsSpecCat["SpecialCategoryName"]; ?></option>
			<?php }mysqli_free_result($resultSpecCat); ?>
			</select>
			</div>
			<div class="DFloating2">
			<b>Content Position</b>:
			<select name="cboSpecialCategoryIDPos">
				<option value="1" <?php if($rsUpdate["SpecialCategoryIDPos"]==1){echo "selected='selected'";} ?>>NONE</option>
				<?php for($iTop=2;$iTop<=8;$iTop++){ ?>
				<option value="<?php echo $iTop; ?>" <?php if($rsUpdate["SpecialCategoryIDPos"]==$iTop){echo "selected='selected'";} ?>>Top <?php echo $iTop-1; ?></option>
				<?php } ?>
			</select>
			</div>
		</td>
	</tr>
	<tr>
		<td align="right" valign="top">Content Heading:</td>
		<td align="left" valign="middle" class="tdBn">
		<i><?php echo $rsUpdate["ContentSubHeading"]; ?></i><br>
		<?php echo $rsUpdate["ContentHeading"]; ?>
		</td>
	</tr>
	<tr>
		<td align="right" valign="top">Content:</td>
		<td align="left" valign="middle" class="tdBn"><?php echo $rsUpdate["ContentBrief"]; ?></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Image (Small):</td>
		<td align="left" valign="top"><?php if($rsUpdate["ImageSMPath"]!=""){?><img src="<?php echo $sSiteURL; ?>media/imgAll/<?php echo $rsUpdate["ImageSMPath"]; ?>"><br><?php }else{echo "NO IMAGE"; } ?></td>
	</tr>
	<tr><td colspan="2" align="center" valign="middle"><input type="submit" name="btnSubmit" class="inpSubmit" value="Update"></td></tr>
	</table>
	</form>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>