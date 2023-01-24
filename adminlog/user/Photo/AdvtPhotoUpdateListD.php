<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Advertisement Photo - Insert</title>
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

function confirmActivate(){return confirm("Are you sure you wish to Activate this entry?");}

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
	<tr><th colspan="5">Advertisement Photo - Update List <span style="float:right;"><a href="AdvtPhotoInsert.php">Active Advt</a></span></th></tr>
	<tr class="TrHeadings">
		<th>Position & Caption</th>
		<th>URL</th>
		<th>Image Name & Path</th>
		<th class="Td50">Activate</th>
	</tr>
	<?php $resultGallery=mysqli_query($connEMM, "SELECT * FROM p_advt WHERE Deletable=2 ORDER BY AdvtImageID DESC LIMIT 7") or die(mysqli_error($connEMM));
	while($rsGallery=mysqli_fetch_assoc($resultGallery)){ ?>
	<tr class="TrUpdateListSelect">
		<td align="left" valign="top">
		<b><?php $iPosition=$rsGallery["Position"];
		if($iPosition==1){
			echo "Banner Top (1180px X 90px)";
		}elseif($iPosition==2){
			echo "Banner (Beside Logo - 470px X 130px)";
		}elseif($iPosition==3){
			echo "Binodon (330px X 130px)";
		} ?></b>
		</td>
		<td align="left" valign="top"><?php echo $rsGallery["Caption"]; ?></td>
		<td align="left" valign="top">
			File Name: <?php echo $rsGallery["ImagePath"]; ?><br>
			<img src="<?php echo $sSiteURL; ?>media/PhotoGallery/<?php echo $rsGallery["ImagePath"]; ?>" style="max-width:700px;">
		</td>
		<td align="center" valign="top"><a href="AdvtPhotoDeleteA.php?ActID=<?php echo $rsGallery["AdvtImageID"]; ?>" onclick="return confirmActivate();">Activate</a></td>
	</tr>
	<?php }mysqli_free_result($resultGallery); ?>
	</table>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>