<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Manage Album - Update List</title>
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
	<tr><td align="right" colspan="8"><a href="albumInsert.php">Insert</a></td></tr>
	<tr><th colspan="6">Manage Album - Update List</th></tr>
	<tr class="TrHeadings">
		<th>Album Type</th>
		<th>Album Name</th>
		<th>Description</th>
		<th>Image</th>
		<th class="Td50">UPDATE</th>
		<th class="Td50">DELETE</th>
	</tr>
	<?php $rowsPerPage=30;$pageNum=1;
	if(isset($_GET["page"])){ $pageNum=$_GET["page"]; }
	if(isset($_GET["AlbumID"])){$iAlbumID=$_GET["AlbumID"];}else{$iAlbumID=0;}
	$offset=($pageNum-1)*$rowsPerPage;
	$qSQL="SELECT * FROM p_album WHERE Deletable=1 ORDER BY AlbumID DESC LIMIT $offset, $rowsPerPage";
	$resultAlbum=mysqli_query($connEMM, $qSQL) or die(mysqli_error($connEMM));
	while($rsAlbum=mysqli_fetch_assoc($resultAlbum)){ ?>
	<tr class="TrHeadings">
		<td align="left" valign="top">
			<span style="font-size:14px;font-weight:bold;">
			<?php if($rsAlbum["AlbumType"]==1){echo "Daily Gallery";}elseif($rsAlbum["AlbumType"]==2){echo "Photo Album";} ?>
			</span>
		</td>
		<td align="left" valign="top"><?php echo $rsAlbum["AlbumName"]; ?></td>
		<td align="left" valign="top"><?php echo $rsAlbum["Description"]; ?></td>
		<td align="left" valign="top">
			<?php echo $rsAlbum["ImagePath"]; ?>
			<?php if($rsAlbum["ImagePath"]!=""){ ?><br><img src="<?php echo $sSiteURL; ?>media/PhotoGallery/<?php echo $rsAlbum["ImagePath"]; ?>"><?php } ?>
		</td>
		<td align="center" valign="top"><a href="albumUpdate.php?updateid=<?php echo $rsAlbum["AlbumID"]; ?>">Update</a></td>
		<td align="center" valign="top"><a href="albumDelete.php?deleteid=<?php echo $rsAlbum["AlbumID"]; ?>">Delete</a></td>
	</tr>
	<?php }mysqli_free_result($resultAlbum); ?>

	<tr><td align="right" valign="top" colspan="8">
	<?php //how many rows we have in database
	if($iAlbumID<=0){$qCounter="SELECT COUNT(AlbumID) AS numrows FROM p_album WHERE Deletable=1";
	}else{$qCounter="SELECT COUNT(PhotoID) AS numrows FROM p_photo WHERE Deletable=1 AND AlbumID=".$iAlbumID;}
	$result=mysqli_query($connEMM, $qCounter) or die("Error, query failed");
	$row=mysqli_fetch_assoc($result);
	$numrows=$row["numrows"];
	$maxPage=ceil($numrows/$rowsPerPage);
	$self=$_SERVER["PHP_SELF"];$nav="";

	for($page=1;$page<=$maxPage;$page++){if($page==$pageNum){$nav.=" $page ";}else{$nav.=" <a href=\"$self?page=$page\">$page</a> ";}}
	if($pageNum>1){
		$page=$pageNum-1;
		$prev=" <a href=\"$self?page=$page\">[Prev]</a> ";
		$first=" <a href=\"$self?page=1\">[First Page]</a> ";
	}else{$prev="&nbsp;";$first="&nbsp;";}
	if($pageNum<$maxPage){
		$page=$pageNum+1;
		$next=" <a href=\"$self?page=$page\">[Next]</a> ";
		$last=" <a href=\"$self?page=$maxPage\">[Last Page]</a> ";
	}else{$next="&nbsp;";$last="&nbsp;";}mysqli_free_result($result); ?>
	<div class="DPaginationL"><?php echo $first.$prev; ?></div><div class="DPaginationR"><?php echo $next.$last; ?></div>
	</td></tr>
	</table>

</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php $_SESSION["sessAlbum"]=$_SERVER["REQUEST_URI"];include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>