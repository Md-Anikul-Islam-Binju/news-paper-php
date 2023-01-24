<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Fix ULR Alies (Bangla)</title>
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
function setfocus(){document.frmInsert.txtContentIDFrom.focus();}
$(document).ready(function(){
	$("#frmInsert").validate({rules:{
		txtContentIDFrom:{required:true,number:true}},
		txtContentIDTo:{required:true,number:true}}
	});
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
	<form id="frmInsert" name="frmInsert" method="post" action="FixURLAliexBn.php">
	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><th colspan="3">Fix ULR Alies (Bangla)</th></tr>
	<tr><td colspan="3">
	Total unsolved URL: 
	<?php
   		$qCount='SELECT COUNT(ContentID) AS TotalBlank FROM bn_content WHERE URLAlies=""';
		$resultCount=mysqli_query($connEMM, $qCount) or die(mysqli_error($connEMM));
		$rsCount=mysqli_fetch_array($resultCount);
		echo $rsCount["TotalBlank"];
		mysqli_free_result($resultCount);
	?>
	</td></tr>
	<tr><td colspan="3">
	<?php
   		$qCount='SELECT ContentID FROM bn_content WHERE URLAlies="" ORDER BY ContentID ASC LIMIT 10';
		$resultCount=mysqli_query($connEMM, $qCount) or die(mysqli_error($connEMM));
		while($rsCount=mysqli_fetch_array($resultCount)){
			echo "Unsolved ContentID: ".$rsCount["ContentID"]."<br>";
		}mysqli_free_result($resultCount);
	?>
	</td></tr>
	<tr>
		<td align="left" valign="top">
		Contend ID:
		From: <input type="text" name="txtContentIDFrom" maxlength="6" value="1">
		To: <input type="text" name="txtContentIDTo" maxlength="6" value="1000">
		<input type="submit" name="btnSubmit" value="Fix">
		</td>
	</tr>
	</table>
	</form>

	<?php
	if(isset($_REQUEST["btnSubmit"])){
		$iContentIDFrom=$dtDate;$iContentIDTo=$dtDate;$iContentIDFrom=1;

		$iContentIDFrom=$_POST["txtContentIDFrom"];
		$iContentIDFrom=$iContentIDFrom-1;
		$iContentIDTo=$_POST["txtContentIDTo"];

		$qShow='SELECT ContentID, ContentHeading FROM bn_content WHERE URLAlies="" ORDER BY ContentID ASC LIMIT '.$iContentIDFrom.', '.$iContentIDTo;
		//echo "qShow: ".$qShow."<br>";
		$resultShow=mysqli_query($connEMM, $qShow) or die(mysqli_error($connEMM));
		while($rsShow=mysqli_fetch_assoc($resultShow)){
			$iContentID=$rsShow["ContentID"];
			$sContentHeading=fFormatURL($rsShow["ContentHeading"]);
			//echo $iContentID." - ".$sContentHeading."<br>";

			$qUpdate="UPDATE bn_content SET URLAlies='".$sContentHeading."' WHERE ContentID=".$iContentID;
			//echo "qUpdate: ".$qUpdate."<br>";
			$resultUpdate=mysqli_query($connEMM, $qUpdate) or die(mysqli_error($connEMM));
			echo "Completed ContentID=".$iContentID."<br>";
		}mysqli_free_result($resultShow);
	}else{echo "Not posted";}
	?>
</div>

</td>

</tr>

<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>

</table>

</body>

</html>