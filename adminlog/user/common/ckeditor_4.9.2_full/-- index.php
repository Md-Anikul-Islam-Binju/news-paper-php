<!DOCTYPE html>
<html lang="en">
<head>
<title>CK Editor</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>
<body>

<div class="container">
<div class="row">
	<div class="col-sm-12">
	<textarea id="txtAddress" name="txtAddress"></textarea>
	</div>
</div>
</div>
<script type="text/javascript">
CKEDITOR.replace('txtAddress',{
filebrowserBrowseUrl: '/ckeditor_4.9.2_full/ckfinder/ckfinder.html',
filebrowserImageBrowseUrl: '/ckeditor_4.9.2_full/ckfinder/ckfinder.html?type=Images',
filebrowserUploadUrl: '/ckeditor_4.9.2_full/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
filebrowserImageUploadUrl: '/ckeditor_4.9.2_full/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
});
</script>
</body>
</html>