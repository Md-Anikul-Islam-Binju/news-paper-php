<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Web TV - Update</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMMEn;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<script type="text/javascript">
function setfocus(){document.frmInsert.txtWebTVHeading.focus();}
$(document).ready(function(){$("#frmInsert").validate();});
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
	$qUpdate="SELECT * FROM tv_webtv WHERE WebTVID=".$iUpdateID;
	$resultUpdate=mysqli_query($connEMM, $qUpdate);$rsUpdate=mysqli_fetch_assoc($resultUpdate); ?>
	<form action="webTVUpdateAction.php?updateid=<?php echo $iUpdateID; ?>" name="frmUpdate" enctype="multipart/form-data" method="post">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><th>Web TV - Update</th></tr>
	<tr><td align="left" valign="middle">
		<p>
		Category:
		<select name="cboCategory">
		<?php $resultSQL=mysqli_query($connEMM, "SELECT CategoryID, CategoryName FROM tv_webtv_category WHERE Deletable=1");
		while($rsSQL=mysqli_fetch_assoc($resultSQL)){ ?>
			<option value="<?php echo $rsSQL["CategoryID"]; ?>" <?php if($rsUpdate["CategoryID"]==$rsSQL["CategoryID"]){echo 'selected="selected"';} ?>><?php echo $rsSQL["CategoryName"]; ?></option>
		<?php } ?>
		</select>
		Type:
		<select name="cboWebTVType">
			<option value="1" <?php if($rsUpdate["WebTVType"]==1){echo ' selected="selected"';} ?>>YouTube</option>
			<option value="2" <?php if($rsUpdate["WebTVType"]==2){echo ' selected="selected"';} ?>>Vimeo</option>
		</select>
		Heading:
		<input type="text" name="txtWebTVHeading" value="<?php echo $rsUpdate["WebTVHeading"]; ?>" required autofocus><?php echo $sMsgRequired; ?>
		Vimeo Video Number:
		<input type="text" name="txtWebTVLink" value="<?php echo $rsUpdate["WebTVLinkCode"]; ?>" required><?php echo $sMsgRequired; ?>
		</p>
		<p>
		Highlight at Home page:
		<select name="cboHighlightHome">
			<option value="1" <?php if($rsUpdate["TopHome"]==1){echo 'selected="selected"';} ?>>Yes</option>
			<option value="2" <?php if($rsUpdate["TopHome"]==2){echo 'selected="selected"';} ?>>No</option>
		</select>
		Highlight at Inner page:
		<select name="cboHighlightInner">
			<option value="1" <?php if($rsUpdate["TopInner"]==1){echo 'selected="selected"';} ?>>Yes</option>
			<option value="2" <?php if($rsUpdate["TopInner"]==2){echo 'selected="selected"';} ?>>No</option>
		</select>
		Video Footage:
		<select name="cboVideoFootage">
			<option value="1" <?php if($rsUpdate["Footage"]==1){echo 'selected="selected"';} ?>>Yes</option>
			<option value="2" <?php if($rsUpdate["Footage"]==2){echo 'selected="selected"';} ?>>No</option>
		</select>
		Today's Highlight:
		<select name="cboTodayHighlight">
			<option value="1" <?php if($rsUpdate["TodayHighlight"]==1){echo 'selected="selected"';} ?>>Yes</option>
			<option value="2" <?php if($rsUpdate["TodayHighlight"]==2){echo 'selected="selected"';} ?>>No</option>
		</select>
		</p>
		<p>
		<?php if($rsUpdate["WebTVType"]==1){ ?>
		<iframe width="330" height="186" src="//www.youtube.com/embed/<?php echo $rsUpdate["WebTVLinkCode"]; ?>" frameborder="0" allowfullscreen></iframe>
		<?php }elseif($rsUpdate["WebTVType"]==2){ ?>
		<iframe src="http://player.vimeo.com/video/<?php echo $rsUpdate["WebTVLinkCode"]; ?>" width="330" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		<?php } ?>
		</p>
		<p><input type="submit" name="btnSubmit" value="Update" class="inpSubmit"></p>
	</td></tr>
	</table>
	</form>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>