<table border="0" cellpadding="0" cellspacing="0" align="center" class="TblMenu">
<tr><td>

<?php if($_SESSION["sessAdmnBangla"]==1){ ?>
	<table border="0" cellpadding="5" cellspacing="0" class="TblAsh">
	<tr><th align="left" colspan="2"><a href="#" class="ABangla">Bangla</a></th></tr>
	</table>
	<div class="DBangla">
	<table border="0" cellpadding="5" cellspacing="0" class="TblAshD">
	<tr>
		<td align="left"><a href="<?php echo $sAdmnURL; ?>Bangla/contentInsert.php">Content</a></td>
		<td class="Td50"><a href="<?php echo $sAdmnURL; ?>Bangla/contentUpdateList.php?categoryid=0&page=1">Update</a></td>
	</tr>
	<tr><td align="left"><a href="<?php echo $sAdmnURL; ?>Bangla/subContentUpdateList.php?subcatid=0&page=1">Content (Sub-Category)</a></td><td>&nbsp;</td></tr>
	<tr><td align="left"><a href="<?php echo $sAdmnURL; ?>Bangla/speContentUpdateList.php?specatid=0&page=1">Content (Special-Category)</a></td><td>&nbsp;</td></tr>
	<tr><td align="left"><a href="<?php echo $sAdmnURL; ?>Bangla/manageTopUpdateList.php">Manage Top</a></td><td>&nbsp;</td></tr>
	<tr><td align="left"><a href="<?php echo $sAdmnURL; ?>Bangla/manageSpeTopUpdateList.php">Manage Top (Special Category)</a></td><td>&nbsp;</td></tr>
	<tr><td align="left"><a href="<?php echo $sAdmnURL; ?>Bangla/headingUpdateList.php">Update Heading</a></td><td>&nbsp;</td></tr>
	<tr><td align="left"><a href="<?php echo $sAdmnURL; ?>Bangla/scrollInsert.php">SCROLL</a></td><td>&nbsp;</td></tr>
	<tr><td align="left"><a href="<?php echo $sAdmnURL; ?>Bangla/breakingInsert.php">BREAKING</a></td><td>&nbsp;</td></tr>
	<tr>
		<td align="left"><a href="<?php echo $sAdmnURL; ?>Bangla/scheduleContentInsert.php">Schedule Post</a></td>
		<td class="Td50"><a href="<?php echo $sAdmnURL; ?>Bangla/scheduleContentUpdateList.php">Update</a></td>
	</tr>
	<tr>
		<td align="left"><a href="<?php echo $sAdmnURL; ?>Bangla/noticeInsert.php">Notice</a></td>
		<td class="Td50"><a href="<?php echo $sAdmnURL; ?>Bangla/noticeUpdateList.php">Update</a></td>
	</tr>
	<tr>
		<td align="left"><a href="<?php echo $sAdmnURL; ?>Bangla/tagInsert.php">Tag</a></td>
		<td><a href="<?php echo $sAdmnURL; ?>Bangla/tagUpdateList.php">Update</a></td>
	</tr>
	</table>
	</div>
<?php } ?>

<?php if($_SESSION["sessAdmnPhoto"]==1){ ?>
	<table border="0" cellpadding="5" cellspacing="0" class="TblAsh">
	<tr><th align="left" colspan="2"><a href="#" class="APhotoGallery">Photo Gallery</a></th></tr>
	</table>
	<div class="DPhotoGallery">
	<table border="0" cellpadding="5" cellspacing="0" class="TblAshD">
	<tr>
		<td align="left"><a href="<?php echo $sAdmnURL; ?>Photo/albumInsert.php">Create Gallery</a></td>
		<td class="Td50"><a href="<?php echo $sAdmnURL; ?>Photo/albumUpdateList.php">Update</a></td>
	</tr>
	<tr>
		<td align="left"><a href="<?php echo $sAdmnURL; ?>Photo/photoInsert.php">Manage Gallery</a></td>
		<td><a href="<?php echo $sAdmnURL; ?>Photo/photoUpdateList.php">Update</a></td>
	</tr>
	<tr><td align="left"><a href="<?php echo $sAdmnURL; ?>Photo/ManualPhotoInsert.php">Single Image</a></td><td>&nbsp;</td></tr>
	<tr><td align="left"><a href="<?php echo $sAdmnURL; ?>Photo/AdvtPhotoInsert.php">Advertisement</a></td><td>&nbsp;</td></tr>
	</table>
	</div>
<?php } ?>


<?php if($_SESSION["sessAdmnTv"]==1){ ?>
	<table border="0" cellpadding="5" cellspacing="0" class="TblAsh">
	<tr><th align="left" colspan="2"><a href="#" class="AWebTV">Web TV</a></th></tr>
	</table>
	<div class="DWebTV">
	<table border="0" cellpadding="5" cellspacing="0" class="TblAshD">
	<tr><td align="left"><a href="<?php echo $sAdmnURL; ?>WebTV/webTVInsert.php">Web TV</a></td><td>&nbsp;</td></tr>
	</table>
	</div>
<?php } ?>


<?php if($_SESSION["sessAdmnRadio"]==1){ ?>
	<table border="0" cellpadding="5" cellspacing="0" class="TblAsh">
	<tr><th align="left" colspan="2"><a href="#" class="AWebRadio">Web Radio</a></th></tr>
	</table>
	<div class="DWebRadio">
	<table border="0" cellpadding="5" cellspacing="0" class="TblAshD">
	<tr><td align="left"><a href="<?php echo $sAdmnURL; ?>WebRadio/contentUpdateList.php">Web Radio</a></td><td class="Td50">&nbsp;</td></tr>
	</table>
	</div>
<?php } ?>


<?php if($_SESSION["sessAdmnPoll"]==1){ ?>
	<table border="0" cellpadding="5" cellspacing="0" class="TblAsh">
	<tr><th align="left" colspan="2"><a href="#" class="APoll">Poll</a></th></tr>
	</table>
	<div class="DPoll">
	<table border="0" cellpadding="5" cellspacing="0" class="TblAshD">
	<tr><td align="left"><a href="<?php echo $sAdmnURL; ?>Poll/pollDetailsInsert.php">Poll</a></td><td class="Td50">&nbsp;</td></tr>
	</table>
	</div>
<?php } ?>


<?php if($_SESSION["sessAdmnSetup"]==1){ ?>
	<table border="0" cellpadding="5" cellspacing="0" class="TblAsh">
	<tr><th align="left" colspan="2"><a href="#" class="ASetup">Setup</a></th></tr>
	</table>
	<div class="DSetup">
	<table border="0" cellpadding="5" cellspacing="0" class="TblAshD">
	<tr><td align="left"><a href="<?php echo $sAdmnURL; ?>Setup/createMonthlyImageFolder.php">Create Montly Folder</a></td><td>&nbsp;</td></tr>
	<tr>
		<td align="left"><a href="<?php echo $sAdmnURL; ?>Setup/Bangla/categoryInsert.php">Category (Bangla)</a></td>
		<td class="Td50"><a href="<?php echo $sAdmnURL; ?>Setup/Bangla/categoryUpdateList.php">Update</a></td>
	</tr>
	<tr>
		<td align="left"><a href="<?php echo $sAdmnURL; ?>Setup/Bangla/subCatInsert.php">Sub-Category (Bangla)</a></td>
		<td><a href="<?php echo $sAdmnURL; ?>Setup/Bangla/subCatUpdateList.php">Update</a></td>
	</tr>
	<tr>
		<td align="left"><a href="<?php echo $sAdmnURL; ?>Setup/Bangla/speCatInsert.php">Special Category (Bangla)</a></td>
		<td><a href="<?php echo $sAdmnURL; ?>Setup/Bangla/speCatUpdateList.php">Update</a></td>
	</tr>
	</table>
	</div>
<?php } ?>


<?php if($_SESSION["sessAdmnAdminOperation"]==1){ ?>
	<table border="0" cellpadding="5" cellspacing="0" class="TblAsh">
	<tr><th align="left" colspan="2"><a href="#" class="AAdminOperation">Admin Operation</a></th></tr>
	</table>
	<div class="DAdminOperation">
	<table border="0" cellpadding="5" cellspacing="0" class="TblAshD">
	<tr>
		<td align="left">Generate</td>
		<td align="left">
		<div class="DDesc">
		<a href="<?php echo $sAdmnURL; ?>Setup/generateLatest24Bn.php" target="_blank">Latest (BN)</a>
		<a href="<?php echo $sAdmnURL; ?>Setup/generateTop24Bn.php" target="_blank">Top 10 (BN)</a>
		<a href="<?php echo $sAdmnURL; ?>Setup/generateTop10CategorizedBN30days.php" target="_blank">Top 10 Categorized (BN)</a>
		</div>
		</td>
	</tr>
	<tr>
		<td align="left">Top Hit</td>
		<td align="left">
		<div class="DDesc">
			<a href="<?php echo $sAdmnURL; ?>Setup/topContentListBn.php">Bangla</a>
		</div>
		</td>
	</tr>
	<tr>
		<td align="left">Fix URL Alice</td>
		<td align="left">
		<div class="DDesc">
			<a href="<?php echo $sAdmnURL; ?>Setup/FixURLAliexBn.php">Bangla</a>
		</div>
		</td>
	</tr>
	<tr>
		<td align="left">Fix Total Hit</td>
		<td align="left">
		<div class="DDesc">
			<a href="<?php echo $sAdmnURL; ?>Setup/FixTotalHitBn.php">Bangla</a>
		</div>
		</td>
	</tr>
	<tr><td align="left" colspan="2"><a href="<?php echo $sAdmnURL; ?>Setup/optimize.php">Optimized</a></td><td>&nbsp;</td></tr>
	<tr><td align="left" colspan="2"><a href="<?php echo $sAdmnURL; ?>Setup/adminuserInsert.php">Admin User</a></td></tr>
	</table>
	</div>
<?php } ?>



	<table border="0" cellpadding="5" cellspacing="0" class="TblAsh">
	<tr><th align="left" colspan="2"><a href="#" class="AReports">Reports</a></th></tr>
	</table>
	<div class="DReports">
	<table border="0" cellpadding="5" cellspacing="0" class="TblAshD">
	<tr>
		<td align="left">Audit Trail</td>
		<td align="left">
			<div class="DDesc">
			<a href="<?php echo $sAdmnURL; ?>Reports/auditTrailCommonBn.php">Common (BN)</a>
			<a href="<?php echo $sAdmnURL; ?>Reports/auditTrailBn.php">Content (BN)</a>
			<a href="<?php echo $sAdmnURL; ?>Reports/auditTrailPhoto.php">Photo</a>
			</div>
		</td>
	</tr>
	<tr>
		<td align="left">Access by IP</td>
		<td align="left">
		<div class="DDesc">
		<a href="<?php echo $sAdmnURL; ?>Reports/accessToCPCommonBn.php">Common (BN)</a>
		<a href="<?php echo $sAdmnURL; ?>Reports/accessToCPBn.php">Content (BN)</a>
		<a href="<?php echo $sAdmnURL; ?>Reports/accessToCPPhoto.php">Photo</a>
		</div>
		</td>
	</tr>
	<tr><td align="left" colspan="2"><a href="<?php echo $sAdmnURL; ?>Reports/report.php">Reports (Short)</a></td></tr>
	<tr><td align="left" colspan="2"><a href="<?php echo $sAdmnURL; ?>Reports/reportDetails.php">Reports (Details)</a></td></tr>
	</table>
	</div>

</td></tr>
</table>