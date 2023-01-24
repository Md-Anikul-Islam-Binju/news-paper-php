<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Fix Total Hit (Bn)</title>
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
				<?php
				$sSQL="SELECT ContentID FROM bn_content ORDER BY ContentID ASC";
				$result=mysqli_query($connEMM, $sSQL);
				while($rsSQL=mysqli_fetch_array($result)){
					$iContentID=$rsSQL["ContentID"];
					$sTotalHit="SELECT ContentID FROM bn_totalhit WHERE ContentID=".$iContentID;
					$resultTotalHit=mysqli_query($connEMM, $sTotalHit);
					if(!mysqli_num_rows($resultTotalHit)){
						$qTotalHitInsert="INSERT INTO bn_totalhit(ContentID) VALUES($iContentID)";
						echo $qTotalHitInsert."<br>";
						$resultTotalHitInsert=mysqli_query($connEMM, $qTotalHitInsert);
					}
				}?>
			</div>
		</td>
	</tr>
	<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>