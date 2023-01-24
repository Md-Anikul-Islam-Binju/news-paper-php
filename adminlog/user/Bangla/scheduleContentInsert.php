<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Content - Insert (Bangla)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;

echo $jsCkEditorFull;
echo $cssChosen;
echo $jsChosen;
echo $jsPrism;
?>
<script language="javascript">
function setfocus(){document.frmInsert.txtPublishedDate.focus();}
function checkLength(){
var iSubHead=document.frmInsert.txtSubHeading.value.length;
var iHead=document.frmInsert.txtHeading.value.length;
var iTotalhead=iSubHead+iHead;
if(iTotalhead>65){
	alert("Type SHORT Heading, Your heading must be within 65 Character...");
	document.frmInsert.txtHeading.focus();
	return false;
}}
$(document).ready(function(){
	$.get('loadSubCat.php?cboCategory=' + $("#cboCategory").val(), function(data){
		$("#cboSubCategoryID").html(data);
	});
	$("#cboCategory").change(function(){
		$.get('loadSubCat.php?cboCategory=' + $(this).val(), function(data){
			$("#cboSubCategoryID").html(data);
		});
	});
	$("#frmInsert").validate({rules:{
		txtHeading:{required:true}
		}
	});
});
</script>
<link rel="stylesheet" type="text/css" href="<?php echo $sAdmnURL; ?>common/Datetime-Picker-jQuery-Moment/css/datetimepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.0/moment-with-locales.min.js"></script>
<script type="text/javascript" src="<?php echo $sAdmnURL; ?>common/Datetime-Picker-jQuery-Moment/js/datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="https://www.jqueryscript.net/css/jquerysctipttop.css">
<script type="text/javascript">
$(document).ready( function(){
	$('#picker').dateTimePicker();
	$('#picker-no-time').dateTimePicker({showTime: true, dateFormat: 'YYYY-MM-DD '});
})
</script>
</head>
<body onload="setfocus();">
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

	<?php $resultCategory=mysqli_query($connEMM, "SELECT CategoryID, CategoryName FROM bn_bas_category WHERE Deletable=1 ORDER BY CategoryName") or die(mysqli_error($connEMM));
	$resultSpecCat=mysqli_query($connEMM, "SELECT SpecialCategoryID, SpecialCategoryName FROM bn_bas_specialcategory ORDER BY SpecialCategoryID") or die(mysqli_error($connEMM));
	$resultDistrict=mysqli_query($connEMM, "SELECT DistrictID, DistrictName FROM bas_district ORDER BY DistrictName") or die(mysqli_error($connEMM));
	$resultTags=mysqli_query($connEMM, "SELECT TagID, TagName FROM bn_tag ORDER BY TagName") or die(mysqli_error($connEMM)); ?>

	<form name="frmInsert" id="frmInsert" method="post" action="scheduleContentInsertAction.php" enctype="multipart/form-data" onsubmit="return checkLength();">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><td align="right" valign="middle" colspan="2"><a href="scheduleContentUpdateList.php">Update</a></td></tr>
	<tr><th colspan="3">Content - Insert (Bangla)</th></tr>
	<tr>
		<td align="right" valign="top">Published Date:</td>
		<td align="left" valign="top"><div id="picker"> </div><input type="hidden" id="result" name="txtPublishedDateTime" value=""></td>
	</tr>
	<tr>
		<td align="right" valign="top">Type of Content:</td>
		<td align="left" valign="top">
			<div class="DFloating1">
			<select name="cboCategory" id="cboCategory" class="selBN">
			<?php while($rsCategory=mysqli_fetch_assoc($resultCategory)){ ?>
				<option value="<?php echo $rsCategory["CategoryID"]; ?>"><?php echo $rsCategory["CategoryName"]; ?></option>
			<?php }mysqli_free_result($resultCategory); ?>
			</select>
			</div>
			<div class="DFloating2">
			<b>Position</b>:
			Home Page: <select name="cboTopHome">
				<option value="1">NONE</option>
				<option value="2">Top 1</option>
				<option value="3">List</option>
				<?php /*for($iTop=3;$iTop<=7;$iTop++){ ?>
				<option value="<?php echo $iTop; ?>">Top <?php echo $iTop-2; ?></option>
				<?php }*/ ?>
			</select>
			Inner Page: <select name="cboTopInner">
				<option value="1">NONE</option>
				<option value="2">Top 1</option>
				<?php /*for($iTop=2;$iTop<=8;$iTop++){ ?>
				<option value="<?php echo $iTop; ?>">Top <?php echo $iTop-1; ?></option>
				<?php }*/ ?>
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
			<b>Position</b>:
			<select name="cboSubCategoryIDPos">
				<option value="1">NONE</option>
				<option value="2">Top 1</option>
				<option value="3">List</option>
				<?php /*for($iTop=2;$iTop<=7;$iTop++){ ?>
				<option value="<?php echo $iTop; ?>">Top <?php echo $iTop-1; ?></option>
				<?php }*/ ?>
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
				<option value="<?php echo $rsSpecCat["SpecialCategoryID"]; ?>"><?php echo $rsSpecCat["SpecialCategoryName"]; ?></option>
			<?php }mysqli_free_result($resultSpecCat); ?>
			</select>
			</div>
			<div class="DFloating2">
			<b>Position</b>:
			<select name="cboSpecialCategoryIDPos">
				<option value="1">NONE</option>
				<?php for($iTop=2;$iTop<=9;$iTop++){ ?>
				<option value="<?php echo $iTop; ?>">Top <?php echo $iTop-1; ?></option>
				<?php } ?>
			</select>
			</div>

			<div class="DFloating1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;District: </div>
			<div class="DFloating2">
			<select name="cboDistrictID">
			<?php while($rsDistrict=mysqli_fetch_assoc($resultDistrict)){ ?>
				<option value="<?php echo $rsDistrict["DistrictID"]; ?>" <?php if($rsDistrict["DistrictID"]==19){echo " selected='selected'";} ?>><?php echo $rsDistrict["DistrictName"]; ?></option>
			<?php }mysqli_free_result($resultDistrict); ?>
			</select>
			</div>
		</td>
	</tr>
	<tr>
		<td align="right" valign="top">Content Sub-Heading:</td>
		<td align="left" valign="top"><input type="text" name="txtSubHeading" maxlength="65" class="inpBN" value=""></td>
	</tr>
	<tr>
		<td align="right" valign="top">Content Heading:</td>
		<td align="left" valign="top"><input type="text" id="txtHeading" name="txtHeading" maxlength="65" class="inpBN required" value="" required autofocus><?php echo $sMsgRequired; ?></td>
	</tr>
	<tr>
		<td align="right" valign="top">Writer(s):</td>
		<td align="left" valign="top"><input type="text" name="txtWriter" class="inpBN" value=""></td>
	</tr>
	<!--tr>
		<td align="right" valign="top">Tag Names(s):</td>
		<td align="left" valign="top">
			<div class="form-group">
				<select name="txtTagNames[]" id="txtTagNames" class="chosen-select cboTag" placeholder="রণাঙ্গন" multiple>
					<?php /*while($rsTags=mysqli_fetch_assoc($resultTags)){?>
					<option><?php echo $rsTags['TagName'];?></option>
					<?php }*/ ?>
				</select>
			</div>
		</td>
	</tr-->
	<tr>
		<td align="right" valign="top">Initial:</td>
		<td align="left" valign="top"><input type="text" name="txtInitial" class="" value="<?php echo $sInitialBN; ?>"></td>
	</tr>
	<tr>
		<td align="right" valign="top">Brief Content:<?php echo $sMsgImgAll; ?></td>
		<td align="left" valign="top"><textarea id="txtContentBrief" name="txtContentBrief" class="txtBN1"></textarea></td>
	</tr>
	<tr>
		<td align="right" valign="top">Details Content:<?php echo $sMsgImgAll; ?></td>
		<td align="left" valign="top"><textarea id="txtContentDetails" name="txtContentDetails" class="txtBN2"></textarea></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Image (Small):<?php echo $sMsgImgHm.$sMsgImgSlide; ?></td>
		<td align="left" valign="middle"><input type="file" name="txtImageSMPath"> (jpg, jpeg, jpe, gif, png, bmp)</td>
	</tr>
	<tr>
		<td align="right" valign="top">Image Caption:</td>
		<td align="left" valign="middle"><input type="text" name="txtImageSMPathCaption" class="inpBN" value=""></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Image (LARGE):<?php echo $sMsgImgInner; ?></td>
		<td align="left" valign="middle"><input type="file" name="txtImageBGPath"> (jpg, jpeg, jpe, gif, png, bmp)</td>
	</tr>
	<tr>
		<td align="right" valign="top">Image Caption (Large):</td>
		<td align="left" valign="middle"><input type="text" name="txtImageBGPathCaption" class="inpBN" value=""></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Show Content?:</td>
		<td align="left" valign="middle">
			<div class="DFloating1">
			<input type="radio" name="rdoShowContent" value="1" checked="checked">Yes
			<input type="radio" name="rdoShowContent" value="2">No
			</div>
			<div class="DFloating2">
			Show in scroll?:
			<input type="radio" name="rdoShowInScroll" value="1">Yes
			<input type="radio" name="rdoShowInScroll" value="2" checked="checked">No
			</div>
			<div class="DFloating2">
			YouTube Video ID:
			<input type="text" id="txtYouTubeVideoID" name="txtYouTubeVideoID" value="">
			</div>
		</td>
	</tr>
	<tr><td colspan="2" align="center" valign="middle"><input type="submit" name="btnSubmit" class="inpSubmit" value="Insert"></td></tr>
	</table>
	</form>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
<script type="text/javascript">
CKEDITOR.replace('txtContentBrief',{
filebrowserBrowseUrl: '<?php echo $sAdmnURL; ?>common/ckfinder/ckfinder.html',
filebrowserImageBrowseUrl: '<?php echo $sAdmnURL; ?>common/ckfinder/ckfinder.html?type=Images',
filebrowserUploadUrl: '<?php echo $sAdmnURL; ?>common/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
filebrowserImageUploadUrl: '<?php echo $sAdmnURL; ?>common/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
});
CKEDITOR.replace('txtContentDetails',{
filebrowserBrowseUrl: '<?php echo $sAdmnURL; ?>common/ckfinder/ckfinder.html',
filebrowserImageBrowseUrl: '<?php echo $sAdmnURL; ?>common/ckfinder/ckfinder.html?type=Images',
filebrowserUploadUrl: '<?php echo $sAdmnURL; ?>common/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
filebrowserImageUploadUrl: '<?php echo $sAdmnURL; ?>common/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
});
var config={
	'.chosen-select'		   : {},
	'.chosen-select-deselect'  : {allow_single_deselect:true},
	'.chosen-select-no-single' : {disable_search_threshold:10},
	'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
	'.chosen-select-width'	 : {width:"95%"}
}
for(var selector in config){
	$(selector).chosen(config[selector]);
}
</script>
</body>
</html>