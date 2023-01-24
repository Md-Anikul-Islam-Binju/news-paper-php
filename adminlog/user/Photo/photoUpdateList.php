<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Create Gallery - Update List</title>
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

<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><td align="right" colspan="4"><a href="photoInsert.php">Insert</a></td></tr>
	<tr><th colspan="4">Create Gallery - Update List</th></tr>
	<tr><td colspan="4" class="TdUpdateCat">
		<a href="photoUpdateList.php" class="AEn">All</a>
		<?php $qSQL="SELECT AlbumID, AlbumName FROM p_album WHERE Deletable=1 ORDER BY AlbumID DESC LIMIT 20";
			$resultAlbum=mysqli_query($connEMM, $qSQL) or die(mysqli_error($connEMM));
			while($rsAlbum=mysqli_fetch_assoc($resultAlbum)){
				echo "<a href='photoUpdateList.php?albumid=".$rsAlbum["AlbumID"]."' class='AEn'>". $rsAlbum["AlbumName"]."</a>";
			}mysqli_free_result($resultAlbum); ?>
		<!--a href="photoUpdateListShow.php">Show at Home</a-->
	</td></tr>
	<tr><td colspan="4" class="TdSearch">
	<form name="frmContentID" action="photoUpdateList.php" method="post">
	Search by: <select name="cboSearchType">
			<option value="1">Photo ID</option>
			<option value="2">Caption</option>
		</select>
		<input type="text" name="SearchTxt" value="" placeholder="Search">
		<input type="submit" name="btnSubmit" value="Search">
	</form>
	</td></tr>
	<tr class="TrHeadings">
		<th>Album, Caption, Image Type</th>
		<th>Image</th>
		<th class="Td50">UPDATE</th>
		<th class="Td50">DELETE</th>
	</tr>
	<?php $rowsPerPage=30;$pageNum=1;
	if(isset($_GET["page"])){ $pageNum=$_GET["page"]; }
	if(isset($_GET["albumid"])){ $iAlbumID=$_GET["albumid"]; }else{ $iAlbumID=0; }
	$offset=($pageNum-1)*$rowsPerPage;
	if($iAlbumID>0){
		$qSQL="SELECT p_photo.AlbumID, p_album.AlbumName, p_photo.PhotoID, p_photo.ImagePath, p_photo.Caption, p_photo.ImageType, p_photo.ShowAtHome, p_photo.DateTimeInserted, p_photo.DateTimeUpdated, p_photo.ContentID FROM p_album INNER JOIN p_photo ON p_photo.AlbumID=p_album.AlbumID WHERE p_photo.Deletable=1 AND p_photo.AlbumID=".$iAlbumID." ORDER BY p_photo.PhotoID DESC LIMIT $offset, $rowsPerPage";
	}else{
		$qSQL="SELECT p_photo.AlbumID, p_album.AlbumName, p_photo.PhotoID, p_photo.ImagePath, p_photo.Caption, p_photo.ImageType, p_photo.ShowAtHome, p_photo.DateTimeInserted, p_photo.DateTimeUpdated, p_photo.ContentID FROM p_album INNER JOIN p_photo ON p_photo.AlbumID=p_album.AlbumID WHERE p_photo.Deletable=1 ORDER BY p_photo.PhotoID DESC LIMIT $offset, $rowsPerPage";
	}
	if(isset($_REQUEST["txtPhotoID"])){
		$iPhotoID=$_REQUEST["txtPhotoID"];
		$qSQL="SELECT p_photo.AlbumID, p_album.AlbumName, p_photo.PhotoID, p_photo.ImagePath, p_photo.Caption, p_photo.ImageType, p_photo.ShowAtHome, p_photo.DateTimeInserted, p_photo.DateTimeUpdated, p_photo.ContentID FROM p_album INNER JOIN p_photo ON p_photo.AlbumID=p_album.AlbumID WHERE p_photo.Deletable=1 AND p_photo.PhotoID=".$iPhotoID." ORDER BY p_photo.PhotoID DESC LIMIT $offset, $rowsPerPage";
	}
	if(isset($_REQUEST["btnSearch"])){
		$sSearchText=$_REQUEST["txtSearch"];
		$qSQL="SELECT p_photo.AlbumID, p_album.AlbumName, p_photo.PhotoID, p_photo.ImagePath, p_photo.Caption, p_photo.ImageType, p_photo.ShowAtHome, p_photo.DateTimeInserted, p_photo.DateTimeUpdated, p_photo.ContentID FROM p_album INNER JOIN p_photo ON p_photo.AlbumID=p_album.AlbumID WHERE p_photo.Deletable=1 AND p_photo.Caption LIKE '%".$sSearchText."%' OR p_photo.CaptionBN LIKE '%".$sSearchText."%') ORDER BY p_photo.PhotoID DESC LIMIT $offset, $rowsPerPage";
	}
	//echo $qSQL."<br>";
	$resultGallery=mysqli_query($connEMM, $qSQL) or die(mysqli_error($connEMM));
	while($rsGallery=mysqli_fetch_assoc($resultGallery)){
	$sImagePath=$rsGallery["ImagePath"]; ?>
	<tr class="TrUpdateListSelect">
		<td align="left" valign="top">
			<b>Album</b>: <?php echo $rsGallery["AlbumName"]; ?><br>
			<b>Image Type</b>: <?php if($rsGallery["ImageType"]==1){echo "Horizontal";}else{echo "Vertical";} ?><br>
			<b>Insert Time</b>: <?php echo $rsGallery["DateTimeInserted"]; ?><br>
			<b>Show at Home Page</b>: <?php if($rsGallery["ShowAtHome"]==1){echo "<font color='blue'>Show</font>";}else{echo "Don't Show";} ?><br>
			<b>Caption:</b> <span class="spnBn"><?php echo $rsGallery["Caption"]; ?></span>
		</td>
		<td align="left" valign="top">
			<?php
            $sImageFile=$sPathProjDir."media/PhotoGallery/".$sImagePath;
			//$sImageFile=$sPathProjDir."/media/imgAll/".$sImageSMPath;

			echo $sImageFile."<br>";
			$iSize=filesize($sImageFile)/1024;
			if($iSize>$iMaxImgSizeGallery){$iSize="<font color='red' size='4'>".$iSize."<font>";}else{$iSize=$iSize;} ?>
			File Name: <?php echo $sImagePath; ?> --- Size: <b><?php echo $iSize; ?> KB</b><br>
			<img src="<?php echo $sSiteURL; ?>media/PhotoGallery/<?php echo $sImagePath; ?>">
		</td>
		<td align="center" valign="top"><a href="photoUpdate.php?updateid=<?php echo $rsGallery["PhotoID"]; ?>">Update</a></td>
		<td align="center" valign="top"><a href="photoDelete.php?deleteid=<?php echo $rsGallery["PhotoID"]; ?>">Delete</a></td>
	</tr>
	<?php }mysqli_free_result($resultGallery); ?>

	<tr><td align="right" valign="top" colspan="10">
	<?php //how many rows we have in database
	if($iAlbumID<=0){
		$qSQL="SELECT COUNT(PhotoID) AS numrows FROM p_photo WHERE Deletable=1";
	}else{
		$qSQL="SELECT COUNT(PhotoID) AS numrows FROM p_photo WHERE Deletable=1 AND AlbumID=".$iAlbumID;
	}
	$result=mysqli_query($connEMM, $qSQL) or die("Error, query failed");
	$row=mysqli_fetch_assoc($result);
	$numrows=$row["numrows"];
	$maxPage=ceil($numrows/$rowsPerPage);
	$self=$_SERVER["PHP_SELF"];$nav="";

	for($page=1;$page<=$maxPage;$page++){if($page==$pageNum){$nav.=" $page ";}else{$nav.=" <a href=\"$self?albumid=$iAlbumID&page=$page\">$page</a> ";}}
	if($pageNum>1){
		$page=$pageNum-1;
		$prev=" <a href=\"$self?albumid=$iAlbumID&page=$page\">[Prev]</a> ";
		$first=" <a href=\"$self?albumid=$iAlbumID&page=1\">[First Page]</a> ";
	}else{$prev="&nbsp;";$first="&nbsp;";}
	if($pageNum<$maxPage){
		$page=$pageNum+1;
		$next=" <a href=\"$self?albumid=$iAlbumID&page=$page\">[Next]</a> ";
		$last=" <a href=\"$self?albumid=$iAlbumID&page=$maxPage\">[Last Page]</a> ";
	}else{$next="&nbsp;";$last="&nbsp;";}mysqli_free_result($result); ?>
	<div class="DPaginationL"><?php echo $first.$prev; ?></div><div class="DPaginationR"><?php echo $next.$last; ?></div>
	</td></tr>
	</table>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php $_SESSION["sessRedirectDailyPhoto"]=$_SERVER["REQUEST_URI"];include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>