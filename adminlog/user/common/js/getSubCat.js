function getSubCatBN(iCategoryID){
	var xmlhttp;
	if(window.XMLHttpRequest){
		//code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{
		//Code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("cboSubCategoryID").innerHTML=xmlhttp.responseText;
		}
	}
	sURL="getSubCategory.php?CatID="+iCategoryID;
	xmlhttp.open("GET",sURL,true);
	xmlhttp.send();
}
function getSubCatBNUp(iCategoryID, iSubCategoryID){
	var xmlhttp;
	if(window.XMLHttpRequest){
		//code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{
		//Code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("cboSubCategoryID").innerHTML=xmlhttp.responseText;
		}
	}
	sURL="getSubCategoryUp.php?CatID="+iCategoryID+"&SubCatID="+iSubCategoryID;
	xmlhttp.open("GET",sURL,true);
	xmlhttp.send();
}
function getSubCatEN(iCategoryID){
	var id=iCategoryID;
	var xmlhttp;
	if(window.XMLHttpRequest){
		//code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{
		//Code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("cboSubCategoryID").innerHTML=xmlhttp.responseText;
		}
	}
	sURL="getSubCategory.php?CatID="+id;
	xmlhttp.open("GET",sURL,true);
	xmlhttp.send();
}