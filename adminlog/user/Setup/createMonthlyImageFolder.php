<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Monthly Image Folder</title>

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<script language="javascript">
function setfocus(){document.frmInsert.txtImageFolderName.focus();}
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
	<?php if(isset($_REQUEST["btnSubmit"])){
		echo '<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl500"><tr><td align="right" valign="middle">';
		$sNewDir=fFormatString($_REQUEST["txtImageFolderName"]);
		$qInsert="INSERT INTO com_monthlyimagefoldername (FolderName, ImageFolderName) VALUES ('".$sNewDir."', '".$sNewDir."')";
		//echo $qInsert."<br>";

		if(mysqli_query($connEMM, $qInsert)){
			//Audit Trail
			$qAuditTrail="INSERT INTO com_audittrail_gen_bn(UserInfo, ActionType, TableName, RemoteIP, RequestFileName, QueryDetails, DateTimeOccered)
			VALUES('".$_SESSION["sessUserName"]."', 1, 'com_monthlyimagefoldername', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["REQUEST_URI"]."', '".fAuTrail($qInsert)."', '".$dtDateTime."')";
			mysqli_query($connEMMAudit, $qAuditTrail) or die($sMsgAuTrailInsert);

			//Create Directory Info ImageAll Folder
			$oldumask=umask(0);

			if(!file_exists($sPathProjDir.'media/imgAll/'.$sNewDir)){
				$sPathImgAll=$sPathProjDir.'media/imgAll/'.$sNewDir;
				$sPathImgAllSM=$sPathProjDir.'media/imgAll/'.$sNewDir.'/SM';
				$sPathPhotoAlbum=$sPathProjDir.'media/PhotoAlbum/'.$sNewDir;
				$sPathPhotoGallery=$sPathProjDir.'media/PhotoGallery/'.$sNewDir;
				$sPathAudio=$sPathProjDir.'media/Audio/'.$sNewDir;

				mkdir($sPathImgAll, 0777, true);
				chmod($sPathImgAll, 0777);
				mkdir($sPathImgAllSM, 0777, true);
				chmod($sPathImgAllSM, 0777);
				mkdir($sPathPhotoAlbum, 0777, true);
				chmod($sPathPhotoAlbum, 0777);
				mkdir($sPathPhotoGallery, 0777, true);
				chmod($sPathPhotoGallery, 0777);
				mkdir($sPathAudio, 0777, true);
				chmod($sPathAudio, 0777);

				$sData='<!doctype html><html lang="en"><head><meta charset="UTF-8"><title>'.$sSiteTitle.'</title><meta http-equiv="refresh" content="0;'.$sSiteURL.'"><script language="javascript">window.location="'.$sSiteURL.'";</script></head><body></body></html>';
				$sDataHt='#For Image Folders
#Disable directory browsing
Options -Indexes

#Disable directory listings
IndexIgnore *

#Block by User Agent String
BrowserMatchNoCase SpammerRobot bad_bot
BrowserMatchNoCase SecurityHoleRobot bad_bot
Order Deny,Allow
Deny from env=bad_bot

#Enable index.php Execution
<Files /index.php>
Order Allow,Deny
Allow from all
</Files>
<Files /index.html>
Order Allow,Deny
Allow from all
</Files>
<Files /index.htm>
Order Allow,Deny
Allow from all
</Files>

#Enable jpg, Execution
<FilesMatch ".*\.(jpg|jpeg|jpe|gif|png|bmp)$">
Order Allow,Deny
Allow from all
</FilesMatch>
';

				$myFile=$sPathImgAll."/index.html";
				$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
				$myFile=$sPathImgAll."/index.php";
				$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
				$myFile=$sPathImgAll."/.htaccess";
				$fh=fopen($myFile, "w");fwrite($fh, $sDataHt);fclose($fh);

				$myFile=$sPathImgAllSM."/index.html";
				$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
				$myFile=$sPathImgAllSM."/index.php";
				$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
				$myFile=$sPathImgAllSM."/.htaccess";
				$fh=fopen($myFile, "w");fwrite($fh, $sDataHt);fclose($fh);

				/*$myFile=$sPathPhotoAlbum."/index.html";
				$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
				$myFile=$sPathPhotoAlbum."/index.php";
				$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
				$myFile=$sPathPhotoAlbum."/.htaccess";
				$fh=fopen($myFile, "w");fwrite($fh, $sDataHt);fclose($fh);*/

				$myFile=$sPathPhotoGallery."/index.html";
				$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
				$myFile=$sPathPhotoGallery."/index.php";
				$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
				$myFile=$sPathPhotoGallery."/.htaccess";
				$fh=fopen($myFile, "w");fwrite($fh, $sDataHt);fclose($fh);

				$myFile=$sPathAudio."/index.html";
				$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
				$myFile=$sPathAudio."/index.php";
				$fh=fopen($myFile, "w");fwrite($fh, $sData);fclose($fh);
				$myFile=$sPathAudio."/.htaccess";
				$fh=fopen($myFile, "w");fwrite($fh, $sDataHt);fclose($fh);
			}else{
				echo "Directory Already exists<br>";
			}
			umask($oldumask);
			echo $sMsgInsert;
		}else{
			if(mysqli_errno($connEMM)==1062){header("Location:".$_SERVER["HTTP_REFERER"]."?msg=duplicate");}
			echo $sMsgInsertFail;
		}
	echo '</td></tr></table>';
	} ?>

	<form id="frmInsert" name="frmInsert" action="createMonthlyImageFolder.php" method="post">
	<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl500">
	<tr><th colspan="2">Monthly Image Folder</th></tr>
	<tr>
		<td align="left" valign="middle">Monthly Image Folder: <input id="txtImageFolderName" name="txtImageFolderName" type="text" class="required" value="<?php echo date("YF"); ?>"> <input type="submit" name="btnSubmit" value="Create"></td>
	</tr>
	</table>
	</form>

	<table border="0" cellpadding="5" cellspacing="0" align="center" class="Tbl500">
		<tr class="TrHeadings"><th>Content Folder</th><th>Photo Folder</th></tr>
		<?php if(isset($_REQUEST["msg"])){ ?><tr><td colspan="2" class="TdDuplicate">Folder Name Already exist. Please type a different Folder Name.</td></tr><?php } ?>
		<?php $resultList=mysqli_query($connEMM, "SELECT * FROM com_monthlyimagefoldername ORDER BY FolderID DESC") or die(mysqli_error($connEMM));
		while($rsList=mysqli_fetch_assoc($resultList)){ ?>
		<tr class="TrUpdateListSelect"><td align="center" valign="middle"><?php echo $rsList["FolderName"]; ?></td><td align="center" valign="middle"><?php echo $rsList["ImageFolderName"]; ?></td></tr>
		<?php }mysqli_free_result($resultList); ?>
	</table>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>