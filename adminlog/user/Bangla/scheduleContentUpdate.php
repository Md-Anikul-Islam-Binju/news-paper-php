<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Content - Update (Bangla)</title>
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
function setfocus(){document.frmUpdate.txtHeading.focus();}
function checkLength(){
var iSubHead=document.frmUpdate.txtSubHeading.value.length;
var iHead=document.frmUpdate.txtHeading.value.length;
var iTotalhead=iSubHead+iHead;
if(iTotalhead>65){
	alert("Type SHORT Heading, Your heading must be within 65 Character...");
	document.frmUpdate.txtHeading.focus();
	return false;
}}
$(document).ready(function(){
	$("#cboCategory").change(function() {
		$.get('loadSubCat.php?cboCategory=' + $(this).val(), function(data) {
			$("#cboSubCategoryID").html(data);
		});
	});
	$("#frmUpdate").validate({
		rules:{
			txtHeading:{required:true}//,
			//txtPrevContentID:{required:true,number:true}
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

	<?php $iUpdateID=$_REQUEST["updateid"];
	$qUpdate="SELECT * FROM bn_content_schedule WHERE ContentID=".$iUpdateID;
	$resultUpdate=mysqli_query($connEMM, $qUpdate) or die("Cannot run SELECT: ".mysqli_error($connEMM));
	$rsUpdate=mysqli_fetch_assoc($resultUpdate);
	$iSubCategoryID=$rsUpdate["SubCategoryID"];
	$iCategoryID=$rsUpdate["CategoryID"];
	$iSubCategoryID=$rsUpdate["SubCategoryID"];

	$resultCategory=mysqli_query($connEMM, "SELECT CategoryID, CategoryName FROM bn_bas_category WHERE Deletable=1 ORDER BY CategoryName") or die(mysqli_error($connEMM));
	$resultSubCategory=mysqli_query($connEMM, "SELECT SubCategoryID, SubCategoryName FROM bn_bas_subcategory WHERE CategoryID=$iCategoryID");
	$resultSpecCat=mysqli_query($connEMM, "SELECT SpecialCategoryID, SpecialCategoryName FROM bn_bas_specialcategory ORDER BY SpecialCategoryID") or die(mysqli_error($connEMM));
	$resultDistrict=mysqli_query($connEMM, "SELECT DistrictID, DistrictName FROM bas_district ORDER BY DistrictName") or die(mysqli_error($connEMM));
	$resultTag=mysqli_query($connEMM, "SELECT TagID, TagName FROM bn_tag ORDER BY TagName") or die(mysqli_error($connEMM)); ?>

	<form id="frmUpdate" name="frmUpdate" method="post" action="scheduleContentUpdateAction.php?updateid=<?php echo $iUpdateID; ?>" enctype="multipart/form-data" onsubmit="return checkLength();">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><th colspan="2">Content - Update (Bangla)</th></tr>
	<tr>
		<td align="right" valign="top">Published Date:</td>
		<td align="left" valign="top">
		<b><?php echo $rsUpdate["DateTimeInserted"]; ?></b>
		<span id="picker"> </span><input type="hidden" id="result" name="txtPublishedDateTime" value="<?php echo $rsUpdate["DateTimeInserted"]; ?>">
		</td>
	</tr>
	<tr>
		<td align="right" valign="top">Type of Content:</td>
		<td align="left" valign="top">
			<div class="DFloating1">
			<select name="cboCategory" id="cboCategory" class="selBN">
			<?php while($rsCategory=mysqli_fetch_assoc($resultCategory)){ ?>
				<option value="<?php echo $rsCategory["CategoryID"]; ?>" <?php if($rsCategory["CategoryID"]==$rsUpdate["CategoryID"]){echo "selected='selected'";} ?>><?php echo $rsCategory["CategoryName"]; ?></option>
			<?php }mysqli_free_result($resultCategory); ?>
			</select>
			</div>
			<div class="DFloating2">
			<b>Content Position</b>:
			Home Page: <select name="cboTopHome">
				<option value="1" <?php if($rsUpdate["TopHome"]==1){echo "selected='selected'";} ?>>NONE</option>
				<option value="2" <?php if($rsUpdate["TopHome"]==2){echo "selected='selected'";} ?>>Top 1</option>
				<option value="3" <?php if($rsUpdate["TopHome"]==3){echo "selected='selected'";} ?>>List</option>
				<?php /*for($iTop=2;$iTop<=7;$iTop++){ ?>
				<option value="<?php echo $iTop; ?>" <?php if($rsUpdate["TopHome"]==$iTop){echo "selected='selected'";} ?>>Top <?php echo $iTop-1; ?></option>
				<?php }*/ ?>
			</select>
			Inner Page: <select name="cboTopInner">
				<option value="1" <?php if($rsUpdate["TopInner"]==1){echo "selected='selected'";} ?>>NONE</option>
				<option value="2" <?php if($rsUpdate["TopInner"]==2){echo "selected='selected'";} ?>>Top 1</option>
				<?php /*for($iTop=2;$iTop<=8;$iTop++){ ?>
				<option value="<?php echo $iTop; ?>" <?php if($rsUpdate["TopInner"]==$iTop){echo "selected='selected'";} ?>>Top <?php echo $iTop-1; ?></option>
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
					<option value="1">None</option>
					<?php while($rsSubCategory=mysqli_fetch_array($resultSubCategory)){ ?>
						<option value="<?php echo $rsSubCategory["SubCategoryID"]; ?>" <?php if($rsSubCategory["SubCategoryID"]==$iSubCategoryID){echo "selected='selected'";} ?> ><?php echo $rsSubCategory["SubCategoryName"]; ?></option>
					<?php }mysqli_free_result($resultSubCategory); ?>
				</select>
			</div>
			<div class="DFloating2">
			<b>Content Position</b>:
			<select name="cboSubCategoryIDPos">
				<option value="1" <?php if($rsUpdate["SubCategoryIDPos"]==1){echo "selected='selected'";} ?>>NONE</option>
				<option value="2" <?php if($rsUpdate["SubCategoryIDPos"]==2){echo "selected='selected'";} ?>>Top 1</option>
				<option value="3" <?php if($rsUpdate["SubCategoryIDPos"]==3){echo "selected='selected'";} ?>>List</option>
				<?php /*for($iTop=2;$iTop<=7;$iTop++){ ?>
				<option value="<?php echo $iTop; ?>" <?php if($rsUpdate["TopHome"]==$iTop){echo "selected='selected'";} ?>>Top <?php echo $iTop-1; ?></option>
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
				<option value="<?php echo $rsSpecCat["SpecialCategoryID"]; ?>" <?php if($rsSpecCat["SpecialCategoryID"]==$rsUpdate["SpecialCategoryID"]){echo "selected='selected'";} ?>><?php echo $rsSpecCat["SpecialCategoryName"]; ?></option>
			<?php }mysqli_free_result($resultSpecCat); ?>
			</select>
			</div>
			<div class="DFloating2">
			<b>Content Position</b>:
			<select name="cboSpecialCategoryIDPos">
				<option value="1" <?php if($rsUpdate["SpecialCategoryIDPos"]==1){echo "selected='selected'";} ?>>NONE</option>
				<!-- option value="2" <?php //if($rsUpdate["SpecialCategoryIDPos"]==2){echo "selected='selected'";} ?>>Show Box</option -->
				<?php for($iTop=2;$iTop<=9;$iTop++){ ?>
				<option value="<?php echo $iTop; ?>" <?php if($rsUpdate["SpecialCategoryIDPos"]==$iTop){echo "selected='selected'";} ?>>Top <?php echo $iTop-1; ?></option>
				<?php } ?>
			</select>
			</div>

			<div class="DFloating1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;District: </div>
			<div class="DFloating2">
			<select name="cboDistrictID" class="selBN">
			<?php while($rsDistrict=mysqli_fetch_assoc($resultDistrict)){ ?>
				<option value="<?php echo $rsDistrict["DistrictID"]; ?>" <?php if($rsDistrict["DistrictID"]==$rsUpdate["DistrictID"]){echo " selected='selected'";} ?>><?php echo $rsDistrict["DistrictName"]; ?></option>
			<?php }mysqli_free_result($resultDistrict); ?>
			</select>
			</div>
		</td>
	</tr>
	<tr>
		<td align="right" valign="top">Content Sub-Heading:</td>
		<td align="left" valign="top"><input type="text" name="txtSubHeading" maxlength="65" class="inpBN" value="<?php echo $rsUpdate["ContentSubHeading"]; ?>"></td>
	</tr>
	<tr>
		<td align="right" valign="top">Content Heading:</td>
		<td align="left" valign="top"><input type="text" id="txtHeading" name="txtHeading" maxlength="65" class="inpBN required" value="<?php echo $rsUpdate["ContentHeading"]; ?>" required autofocus><?php echo $sMsgRequired; ?></td>
	</tr>
	<tr>
		<td align="right" valign="top">Writer(s):</td>
		<td align="left" valign="top"><input type="text" name="txtWriter" class="inpBN" value="<?php echo $rsUpdate["Writers"]; ?>"></td>
	</tr>
	<!--tr>
		<td align="right" valign="top">Tag Names(s):</td>
		<td align="left" valign="top">
		<?php
		/*$tnames=array();
		$tnames=explode(',',$rsUpdate["TagName"]);
		?>
		<div class="form-group">
			<select name="txtTagNames[]" id="txtTagNames" class="chosen-select cboTag" placeholder="রণাঙ্গন" multiple>
				<option value=""></option>
				<?php while($rsTag=mysqli_fetch_assoc($resultTag)){
					$tagSelected='';
					 foreach($tnames as $tname){
						if($rsTag['TagName']==$tname){
							$tagSelected='selected';
						}
					}?>
				<option <?php echo $tagSelected;?>><?php echo $rsTag['TagName'];?></option>
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
		<td align="left" valign="top"><textarea id="txtContentBrief" name="txtContentBrief" class="txtBN1"><?php echo $rsUpdate["ContentBrief"]; ?></textarea></td>
	</tr>
	<tr>
		<td align="right" valign="top">Details Content:<?php echo $sMsgImgAll; ?></td>
		<td align="left" valign="top"><textarea id="txtContentDetails" name="txtContentDetails" class="txtBN2"><?php echo $rsUpdate["ContentDetails"]; ?></textarea></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Image (Small):<?php echo $sMsgImgHm.$sMsgImgSlide; ?></td>
		<td align="left" valign="middle">
		<?php $sImageSMPath=$rsUpdate["ImageSMPath"];
		if($sImageSMPath!=""){
			echo "<p><b>DB:</b> ".$sImageSMPath." - ";
			$sPos=strrchr($sImageSMPath, "/");
			$sPos=str_replace("/", "", $sPos);
			echo "<b>Image:</b> ".$sPos."<br>";
			$_SESSION["sessImageSMPathBN"]=$sPos;
			$sImgPathSM=$sPathProjDir."/media/imgAll/".$sImageSMPath;

			if(@getimagesize($sImgPathSM)!=""){
				list($width, $height, $type, $attr)=getimagesize($sImgPathSM);
				echo "<b>Attribute:</b> " .$attr. "</p>";
			}else{
				echo $sMsgImgInvalidFile;
			} ?>

			<p><img src="<?php echo $sSiteURL; ?>media/imgAll/<?php echo $sImageSMPath; ?>"></p><br>
		<?php }else{$_SESSION["sessImageSMPathBN"]="";} ?>
		<input type="file" name="txtImageSMPath"> (jpg, jpeg, jpe, gif, png, bmp)
		</td>
	</tr>
	<tr>
		<td align="right" valign="top">Image Caption:</td>
		<td align="left" valign="middle"><input type="text" name="txtImageSMPathCaption" class="inpBN" value="<?php echo $rsUpdate["ImageSMPathCaption"]; ?>"></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Image (LARGE):<?php echo $sMsgImgInner; ?></td>
		<td align="left" valign="middle">
		<?php $sImageBGPath=$rsUpdate["ImageBGPath"];
		if($sImageBGPath!=""){
			echo "<p><b>DB:</b> ".$sImageBGPath." - ";
			$sPos=strrchr($sImageBGPath, "/");
			$sPos=str_replace("/", "", $sPos);
			echo "<b>Image:</b> ".$sPos."<br>";
			$_SESSION["sessImageBGPathBN"]=$sPos;
			$sImgPathBG=$sPathProjDir."/media/imgAll/".$sImageBGPath;

			if(@getimagesize($sImgPathBG)){
				list($width, $height, $type, $attr)=getimagesize($sImgPathBG);
				echo "<b>Attribute:</b> ".$attr."</p>";
			}else{
				echo $sMsgImgInvalidFile;
			} ?>
			<p><img src="<?php echo $sSiteURL; ?>media/imgAll/<?php echo $sImageBGPath; ?>"></p><br>
		<?php }else{$_SESSION["sessImageBGPathBN"]="";} ?>

		<input type="file" name="txtImageBGPath"> (jpg, jpeg, jpe, gif, png, bmp)
		</td>
	</tr>
	<tr>
		<td align="right" valign="top">Image Caption (Large):</td>
		<td align="left" valign="middle"><input type="text" name="txtImageBGPathCaption" class="inpBN" value="<?php echo $rsUpdate["ImageBGPathCaption"]; ?>"></td>
	</tr>
	<?php if($rsUpdate["SoundPath"]!=""){ ?>
	<tr>
		<td align="right" valign="middle">ogg File:</td>
		<td align="left" valign="middle">
   		<div class="DSubSpeCategory">
			<b>Sound</b>: <?php echo $rsUpdate["SoundPath"]; ?><br>
			<audio controls>
				<source src="<?php echo $sSiteURL; ?>media/Audio/<?php echo $rsUpdate["SoundPath"]; ?>" type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		</td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right" valign="middle">Show Content?:</td>
		<td align="left" valign="middle">
			<div class="DFloating1">
				<input type="radio" name="rdoShowContent" value="1" <?php if($rsUpdate["ShowContent"]==1){echo 'checked="checked"';} ?>>Yes
				<input type="radio" name="rdoShowContent" value="2" <?php if($rsUpdate["ShowContent"]==2){echo 'checked="checked"';} ?>>No
			</div>
			<div class="DFloating2">
				Show in scroll?:
				<input type="radio" name="rdoShowInScroll" value="1" <?php if($rsUpdate["ShowInScroll"]==1){echo 'checked="checked"';} ?>>Yes
				<input type="radio" name="rdoShowInScroll" value="2" <?php if($rsUpdate["ShowInScroll"]==2){echo 'checked="checked"';} ?>>No
			</div>
			<div class="DFloating2">
				YouTube Video ID:
				<input type="text" id="txtYouTubeVideoID" name="txtYouTubeVideoID" value="<?php echo $rsUpdate["VideoPath"]; ?>">
			</div>
				<?php if($rsUpdate["VideoPath"]!=""){ ?>
				<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $rsUpdate["VideoPath"]; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
				<?php }?>
		</td>
	</tr>
	<tr><td colspan="2" align="center" valign="middle"><input type="submit" name="btnSubmit" value="Update" class="inpSubmit"></td></tr>
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