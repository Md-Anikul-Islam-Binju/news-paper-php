<?php ob_start();session_cache_expire(30);session_start();require_once("common/mysqli_conneCT.php");require_once("common/config.php"); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>Final Check</title>

<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<?php
echo $cssEMM;
echo $jsjQuery;
echo $jsEMM;
echo $cssFontAwesomeCSS;
?>

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style type="text/css">
.modal-header, h4, .close{background-color:#5cb85c;color:white !important;text-align:center;font-size:30px;}
.modal-footer{background-color:#f9f9f9;}
</style>
</head>
<body>
<div class="container">

	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="padding:35px 50px;">
				<button type="button" name="btnClose" id="btnClose" class="close" data-dismiss="modal">&times;</button>
				<h4><span class="glyphicon glyphicon-lock"></span> Final Security Checking</h4>
			</div>
			<div class="modal-body" style="padding:40px 50px;">
			<form action="final.php" method="post" name="frmFinal" id="frmFinal" role="form">
				<div class="form-group">
					<label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
					<input type="text" class="form-control" id="txtUser" name="txtUser" value="" placeholder="Type user">
				</div>
				<div class="form-group">
					<label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
					<input type="text" class="form-control" id="txtPass" name="txtPass" value="" placeholder="Enter password">
				</div>
				<button type="submit" name="btnSubmit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
			</form>
			</div>
		</div>
		</div>
	</div> 
</div>

<?php
if(!isset($_SESSION["sessUserName"])){
	if(trim(isset($_SESSION["sessUserName"]))==""){
		session_start();
		$_SESSION["sessUserName"]=NULL;
		session_unset();
		session_destroy();
		if(isset($connEMM)){mysqli_close($connEMM);}
		header("location:".$sAdmnURL);
		exit();
	}
} ?>
<br><br>
<?php
if(isset($_POST["btnSubmit"])){ //If SUBMITTED //Vabna_09
	if( ($_POST["txtUser"]=="dailyakash") && (md5($_POST["txtPass"])=="f31bd6e0c69c7a9139b160392309edc0")){
		$_SESSION["sessUserNameFinal"]="dailyakash";
		header("Location: home.php");
	}else{
		header("Location: ".$sAdmnURL."?err=Invalid Login Information");
	}
} ?>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script type="text/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
$(window).on('load',function(){
	$('#myModal').modal('show');
});
$(document).ready(function(){
	$("#btnClose").click(function(){
		//alert("<?php //echo $_SESSION["sessUserName"]; ?>");
		//window.location="<?php //echo $sAdmnURL; ?>";
		document.write("<?php echo header("Location: ".$sAdmnURL."?err=Invalid Login Information"); ?>");
	});
});
</script>
</body>
</html>