<?php ob_start();session_cache_expire(30);session_start();require_once("../common/mysqli_conneCT.php");require_once("../common/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Manage Content Top - Update List (BANGLA)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>
<script type="text/javascript">function confirmDelete(){return confirm("Are you sure you wish to REMOVE this entry top TOP?");}</script>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMain">
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/header.php"); ?></td></tr>
<tr>
<td align="left" valign="top" class="TdMenu"><?php include_once($sAdmnPath."common/menuLeft.php"); ?></td>
<td align="left" valign="top">
<div class="DContent">

	<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
	<tr><th colspan="2">Manage Content Top - Update List (BANGLA)</th></tr>
	<tr><td colspan="2" class="TdUpdateCat">
		<?php $resultCategory=mysqli_query($connEMM, "SELECT CategoryID, CategoryName FROM bn_bas_category WHERE Deletable=1 ORDER BY CategoryName ASC") or die(mysqli_error($connEMM));
		while($rsCategory=mysqli_fetch_assoc($resultCategory)){
			echo "<a href='manageTopUpdateList.php?categoryid=".$rsCategory["CategoryID"]."'>".$rsCategory["CategoryName"]."</a> &nbsp; &nbsp;";
		}mysqli_free_result($resultCategory); ?>
	</td></tr>
	<tr><td align="center" valign="top" colspan="2">
		<?php if(isset($_GET["categoryid"])){$iCagoryID=$_GET["categoryid"];}else{$iCagoryID=1;}
		if($iCagoryID==0){$sCategory="All";}else{
			$qCategory="SELECT CategoryName FROM bn_bas_category WHERE CategoryID=".$iCagoryID;
			$resultCategory=mysqli_query($connEMM, $qCategory) or die(mysqli_error($connEMM));
			$rsCategory=mysqli_fetch_assoc($resultCategory);
			$sCategory=$rsCategory["CategoryName"];
			mysqli_free_result($resultCategory);
		} ?>
		<h3 style="color:#FF0000"><?php echo $sCategory; ?></h3>
	</td></tr>
	<tr>
		<th align="center">Home Page</th>
		<th align="center">Inner Page</th>
	</tr>
	<tr>
	<td valign="top">
		<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
		<tr class="TrHeadings">
			<th>Content</th>
			<th class="Td50">Update</th>
			<th class="Td50">Remove</th>
		</tr>
		<tr class="TrUpdateListSelect"><td colspan="4">Slide</td></tr>
		<?php if($iCagoryID>0){
			$qContent="SELECT ContentID, ContentHeading, ContentBrief, DateTimeInserted FROM bn_content WHERE ShowContent=1 AND Deletable=1 AND TopHome=2 AND CategoryID=".$iCagoryID." ORDER BY ContentID DESC LIMIT 6";
			//echo $qContent."<br>";
			$resultContent=mysqli_query($connEMM, $qContent) or die(mysqli_error($connEMM));
			while($rsContent=mysqli_fetch_assoc($resultContent)){ ?>
			<tr class="TrUpdateListSelect">
				<td class="tdBn">
					<h3><?php echo $rsContent["ContentHeading"]; ?></h3>
					<i><?php echo $rsContent["ContentBrief"]; ?></i>
					<?php echo $rsContent["DateTimeInserted"]; ?>
				</td>
				<td><a href="manageTopUpdate.php?updateid=<?php echo $rsContent["ContentID"]; ?>">Update</a></td>
				<td><a href="manageTopDelete.php?deleteid=<?php echo $rsContent["ContentID"]; ?>&remove=1" onclick="return confirmDelete();">Remove</a></td>
			</tr>
		<?php }mysqli_free_result($resultContent);} ?>
	

		<?php for($i=3;$i<=7;$i++){ ?>
		<tr class="TrUpdateListSelectHead"><td colspan="4">TOP <?php echo $i-2; ?></td></tr>
		<?php if($iCagoryID>0){
		$qContent="SELECT ContentID, ContentHeading, ContentBrief, DateTimeInserted FROM bn_content WHERE ShowContent=1 AND Deletable=1 AND TopHome=".$i." AND CategoryID=".$iCagoryID." ORDER BY ContentID DESC LIMIT 6";
		//echo $qContent."<br>";
		$resultContent=mysqli_query($connEMM, $qContent) or die(mysqli_error($connEMM));
		while($rsContent=mysqli_fetch_assoc($resultContent)){ ?>
		<tr class="TrUpdateListSelect">
			<td class="tdBn">
				<h3><?php echo $rsContent["ContentHeading"]; ?></h3>
				<i><?php echo $rsContent["ContentBrief"]; ?></i>
				<?php echo $rsContent["DateTimeInserted"]; ?>
			</td>
			<td><a href="manageTopUpdate.php?updateid=<?php echo $rsContent["ContentID"]; ?>">Update</a></td>
			<td><a href="manageTopDelete.php?deleteid=<?php echo $rsContent["ContentID"]; ?>&remove=1" onclick="return confirmDelete();">Remove</a></td>
		</tr>
		<?php }mysqli_free_result($resultContent);}
		}//End-For ?>
		</table>
	</td>

	<td valign="top">
		<table align="center" border="0" cellpadding="5" cellspacing="0" class="Tbl98">
		<tr class="TrHeadings">
			<th>Content</th>
			<th class="Td50">Update</th>
			<th class="Td50">Remove</th>
		</tr>
		<?php for($i=2;$i<=6;$i++){ ?>
		<tr class="TrUpdateListSelect"><td colspan="4">TOP <?php echo $i-1; ?></td></tr>
			<?php if($iCagoryID>0){
				$qContent="SELECT ContentID, ContentHeading, ContentBrief, DateTimeInserted FROM bn_content WHERE ShowContent=1 AND Deletable=1 AND TopInner=".$i." AND CategoryID=".$iCagoryID." ORDER BY ContentID DESC LIMIT 6";
				//echo $qContent."<br>";
				$resultContent=mysqli_query($connEMM, $qContent) or die(mysqli_error($connEMM));
				while($rsContent=mysqli_fetch_assoc($resultContent)){ ?>
				<tr class="TrUpdateListSelect">
					<td class="tdBn">
						<h3><?php echo $rsContent["ContentHeading"]; ?></h3>
						<i><?php echo $rsContent["ContentBrief"]; ?></i>
						<?php echo $rsContent["DateTimeInserted"]; ?>
					</td>
					<td><a href="manageTopUpdate.php?updateid=<?php echo $rsContent["ContentID"]; ?>">Update</a></td>
					<td><a href="manageTopDelete.php?deleteid=<?php echo $rsContent["ContentID"]; ?>&remove=2" onclick="return confirmDelete();">Remove</a></td>
				</tr>
			<?php }mysqli_free_result($resultContent);}
			}//End-For ?>
		</table>
	</td></tr>

	<tr><th colspan="2">Special Category</th></tr>
	<tr><td colspan="2" class="TdUpdateCat">
		<a href="manageSpeTopUpdateList.php?specatid=0&page=1">ALL</a> &nbsp; &nbsp;
		<?php $resultCategory=mysqli_query($connEMM, "SELECT * FROM bn_bas_specialcategory WHERE Deletable=1 ORDER BY SpecialCategoryName ASC") or die(mysqli_error($connEMM));
		while($rsCategory=mysqli_fetch_assoc($resultCategory)){
			echo "<a href='manageSpeTopUpdateList.php?specatid=".$rsCategory["SpecialCategoryID"]."'>".$rsCategory["SpecialCategoryName"]."</a>&nbsp;&nbsp;";
		}mysqli_free_result($resultCategory); ?>
	</td></tr>
	</table>
	<?php $_SESSION["sessRedirectPageBN"]=$_SERVER["REQUEST_URI"]; ?>
</div>
</td>
</tr>
<tr><td align="left" valign="top" colspan="2"><?php include_once($sAdmnPath."common/footer.php"); ?></td></tr>
</table>
</body>
</html>