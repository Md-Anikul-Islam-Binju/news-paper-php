<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Web Radio - Update (Bangla)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMMEn;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
</head>

<body onload="setfocus();">
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

	<?php $iUpdateID=$_REQUEST["updateid"];
	$qUpdate="SELECT * FROM bn_content WHERE ContentID=".$iUpdateID;
	$resultUpdate=mysqli_query($connEMM, $qUpdate) or die("Cannot run SELECT: ".mysqli_error($connEMM));
	$rsUpdate=mysqli_fetch_assoc($resultUpdate);
	$iCategoryID=$rsUpdate["CategoryID"];

	$resultCategory=mysqli_query($connEMM, "SELECT CategoryName FROM bn_bas_category WHERE CategoryID=$iCategoryID") or die(mysqli_error($connEMM)); ?>
	<form id="frmUpdate" name="frmUpdate" method="post" action="contentUpdateAction.php?updateid=<?php echo $iUpdateID; ?>" enctype="multipart/form-data" onsubmit="return checkLength();">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><th colspan="2">Content - Update (Bangla)</th></tr>
	<tr>
		<td align="right" valign="top">Type of Content:</td>
		<td align="left" valign="top">
			<div class="DFloating1"><?php echo $rsCategory["CategoryName"]; ?></div>
			<div class="DFloating2">
			Home Page:
				<?php if($rsUpdate["TopHome"]==1){echo "NONE'";} ?>
				<?php if($rsUpdate["TopHome"]==2){echo "Top 1";} ?>
				<?php if($rsUpdate["TopHome"]==3){echo "List";} ?>
			Inner Page:
				<?php if($rsUpdate["TopInner"]==1){echo "NONE";} ?>
				<?php if($rsUpdate["TopInner"]==2){echo "Show Box";} ?>
			</div>
		</td>
	</tr>
	<tr>
		<td align="right" valign="top">Sub-Heading:</td>
		<td align="left" valign="top"><?php echo $rsUpdate["ContentSubHeading"]; ?></td>
	</tr>
	<tr>
		<td align="right" valign="top">Content Heading:</td>
		<td align="left" valign="top"><?php echo $rsUpdate["ContentHeading"]; ?></td>
	</tr>
	<tr>
		<td align="right" valign="top">Brief Content:</td>
		<td align="left" valign="top"><?php echo $rsUpdate["ContentBrief"]; ?></td>
	</tr>
	<tr>
		<td align="right" valign="middle">Image (Small):</td>
		<td align="left" valign="middle">
		<?php $sImageSMPath=$rsUpdate["ImageSMPath"];
		if($sImageSMPath!=""){
			echo "<p><b>Image:</b> ".$sImageSMPath." - ";
			$sPos=strrchr($sImageSMPath, "/");
			$sPos=str_replace("/", "", $sPos);
			echo "<b>File Name:</b> ".$sPos."<br>";?>

			<p><img src="<?php echo $sSiteURL; ?>media/imgAll/<?php echo $sImageSMPath; ?>"></p><br>
		<?php } ?>
		</td>
	</tr>
	<tr>
		<td align="right" valign="middle">Image (LARGE):</td>
		<td align="left" valign="middle">
		<?php $sImageBGPath=$rsUpdate["ImageBGPath"];
		if($sImageBGPath!=""){
			echo "<p><b>Image:</b> ".$sImageBGPath." - ";
			$sPos=strrchr($sImageBGPath, "/");
			$sPos=str_replace("/", "", $sPos);
			echo "<b>File Name:</b> ".$sPos."<br>"; ?>
			<p><img src="<?php echo $sSiteURL; ?>media/imgAll/<?php echo $sImageBGPath; ?>"></p><br>
		<?php } ?>
		</td>
	</tr>
	<tr>
		<td align="right" valign="middle">ogg File:</td>
		<td align="left" valign="middle">
   		<?php if($rsUpdate["SoundPath"]!=""){ ?>
		<div class="DSubSpeCategory">
			<b>Sound</b>: <?php echo $rsUpdate["SoundPath"]; ?><br>
			<audio controls>
				<source src="<?php echo $sSiteURL; ?>media/Audio/<?php echo $rsUpdate["SoundPath"]; ?>" type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php } ?>
		<input type="file" name="txtSoundClip" required autofocus>
		</td>
	</tr>
	<tr>
		<td align="right" valign="middle">YouTube Video ID:</td>
		<td align="left" valign="middle">
   		<input type="text" id="txtYouTubeVideoID" name="txtYouTubeVideoID" value="<?php echo $rsUpdate["VideoPath"]; ?>">
		<div class="DSubSpeCategory">
		   	<?php if($rsUpdate["VideoPath"]!=""){ ?>
			<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $rsUpdate["VideoPath"]; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			<?php }?>
		</div>
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
</body>
</html>