<?php ob_start();session_cache_expire(30);session_start();require_once("../../common/mysqli_conneCT.php");require_once("../../common/config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Sub-Category - Update (Bangla)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<script language="javascript">
function setfocus(){document.frmInsert.txtSubCategoryName.focus();}
$(document).ready(function(){
	$("#frmUpdate").validate({
	rules:{
	txtSubCategoryName:{required:true},
	txtPriority:{required:true,number:true}}
	});
});
</script>
</head>
<body onload="setfocus();">
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">
	<?php $iUpdateID=$_REQUEST["updateid"];
	$qUpdate="SELECT * FROM bn_bas_subcategory WHERE SubCategoryID=".$iUpdateID;
	$resultUpdate=mysqli_query($connEMM, $qUpdate);
	$rsUpdate=mysqli_fetch_assoc($resultUpdate);
	$resultCategory=mysqli_query($connEMM, "SELECT CategoryID, CategoryName FROM bn_bas_category WHERE Deletable=1 ORDER BY CategoryName") or die(mysqli_error($connEMM)); ?>
	<form id="frmUpdate" name="frmUpdate" method="post" action="subCatUpdateAction.php?updateid=<?php echo $iUpdateID; ?>" enctype="multipart/form-data">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
		<tr><td align="right" valign="middle" colspan="2"><a href="subCatUpdateList.php">Update</a></td></tr>
		<tr><th colspan="2">Sub-Category - Update (Bangla)</th></tr>
		<?php if(isset($_REQUEST["msg"])){ ?><tr><td colspan="2" class="TdDuplicate">Sub-Category Name Already exist. Please type a different Sub-Category Name.</td></tr><?php } ?>
		<tr>
			<td align="right" valign="middle">Category:</td>
			<td align="left" valign="middle">
				<select name="cboCategory" class="selBN">
				<?php while($rsCategory=mysqli_fetch_assoc($resultCategory)){ ?>
					<option value="<?php echo $rsCategory["CategoryID"]; ?>"<?php if($rsCategory["CategoryID"]==$rsUpdate["CategoryID"]){echo "selected='selected'";} ?>><?php echo $rsCategory["CategoryName"]; ?></option>
				<?php }mysqli_free_result($resultCategory); ?>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right" valign="middle">Sub-Category Name:</td>
			<td align="left">
			<input type="text" id="txtSubCategoryName" name="txtSubCategoryName" maxlength="200" class="inpBN required" value="<?php echo $rsUpdate["SubCategoryName"]; ?>" required autofocus>
			<?php echo $sMsgRequired; ?>
			</td>
		</tr>
		<tr>
			<td align="right" valign="middle">Slug:</td>
			<td align="left" valign="middle">
			<input type="text" id="txtSlug" name="txtSlug" maxlength="200" class="inpBN required" value="<?php echo $rsUpdate["Slug"]; ?>" required><?php echo $sMsgRequired; ?>
			</td>
		</tr>
		<tr>
			<td align="right" valign="top">End Note:</td>
			<td align="left" valign="top"><textarea id="txtEndNote" name="txtEndNote" class="txtBN1"><?php echo $rsUpdate["EndNote"]; ?></textarea></td>
		</tr>
		<tr>
			<td align="right" valign="top">Remarks:</td>
			<td align="left" valign="top"><textarea name="txtRemarks" class="txtBN1"><?php echo $rsUpdate["Remarks"]; ?></textarea></td>
		</tr>
		<tr>
			<td align="right" valign="middle">Priority:</td>
			<td align="left" valign="middle">
			<input type="text" id="txtPriority" name="txtPriority" class="required" maxlength="3" size="2" value="<?php echo $rsUpdate["Priority"]; ?>">
			<?php echo $sMsgRequired.$sMsgNumber; ?>
			Show in Menu: <input type="radio" name="rdoShow" value="1" <?php if($rsUpdate["ShowData"]==1) echo "checked='checked'"; ?>>Yes <input type="radio" name="rdoShow" value="2" <?php if($rsUpdate["ShowData"]==2) echo "checked='checked'"; ?>>No
			</td>
		</tr>
		<tr>
			<td align="right" valign="middle">Image (Icon):<?php echo $sMsgImgCatIcon; ?></td>
			<td align="left" valign="top">
				<?php if($rsUpdate["ImagePathIcon"]!=""){ ?><img src="<?php echo $sSiteURL; ?>media/category/<?php echo $rsUpdate["ImagePathIcon"]; ?>"><?php } ?><br>
				<input type="file" name="txtImageIcon"> (jpg, jpeg, jpe, gif, png, bmp)
			</td>
		</tr>
		<tr>
			<td align="right" valign="middle">Image (Menu):<?php echo $sMsgImgCatMenu; ?></td>
			<td align="left" valign="top">
				<?php if($rsUpdate["ImagePathMenu"]!=""){ ?><img src="<?php echo $sSiteURL; ?>media/category/<?php echo $rsUpdate["ImagePathMenu"]; ?>"><?php } ?><br>
				<input type="file" name="txtImageMenu"> (jpg, jpeg, jpe, gif, png, bmp)
			</td>
		</tr>
		<tr>
			<td align="right" valign="middle">Image (Cover Home):<?php echo $sMsgImgCatCoverHome; ?></td>
			<td align="left" valign="top">
				<?php if($rsUpdate["ImagePathCoverHome"]!=""){ ?><img src="<?php echo $sSiteURL; ?>media/category/<?php echo $rsUpdate["ImagePathCoverHome"]; ?>"><?php } ?><br>
				<input type="file" name="txtImageCoverHome"> (jpg, jpeg, jpe, gif, png, bmp)
			</td>
		</tr>
		<tr>
			<td align="right" valign="middle">Image (Cover Inner):<?php echo $sMsgImgCatCoverInner; ?></td>
			<td align="left" valign="top">
				<?php if($rsUpdate["ImagePathCoverInner"]!=""){ ?><img src="<?php echo $sSiteURL; ?>media/category/<?php echo $rsUpdate["ImagePathCoverInner"]; ?>"><?php } ?><br>
				<input type="file" name="txtImageCoverInner"> (jpg, jpeg, jpe, gif, png, bmp)
			</td>
		</tr>
		<tr><td colspan="2" align="center"><input type="submit" name="btnSubmit" value="Update" class="inpSubmit"></td></tr>
	</table>
	</form>
</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
<script type="text/javascript">
CKEDITOR.replace('txtEndNote');
CKEDITOR.replace('txtRemarks');
</script>
</body>
</html>