function disableApplicationForm() {
	// alert("disableApplicationForm Reached");
	if (applied==true) {
		document.getElementById('yearOfStudy').disabled='true';
		document.getElementById('semester').disabled='true';
		document.getElementById('submit').disabled='true';
		//alert("disableApplicationForm Reached");
	}
}
function enableComfirm() {
	var check=document.getElementById('comfirmc');
	if (check.checked==true) {
		//alert("Errdfgd");
		//document.getElementById('comfirm').disabled='false';
	}
	
}
// AJAX SECTION FOR GETTING SUBJECTS
function getXMLHTTPRequest(){
	var req=false;
	try{
		req= new XMLHttpRequest();
	}
	catch(error){
		try{
			req= new ActiveXObject("Msxml12.XMLHTTP");
		}
		catch(error1){
			try{
				req=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(error2){
				req=false;
			}
		}
	}
	return req;
}
// creating the xmlhttp request
var xmlhttp=getXMLHTTPRequest();
// function to call ajax and get subjects
function searchName(){
	var roomMate=document.getElementById("roomMate").value;
	// build url
	var url="../students/getRoomMate.php?roomMate="+roomMate;
	xmlhttp.open("GET",url,true);
	// function to run when the response has arrived
	xmlhttp.onreadystatechange=showRoomMates;
	// send the request
	xmlhttp.send(null);

}
function showRoomMates() {
	// check if the request is completed and http response is okay
	if (xmlhttp.readyState==4) {
		if (xmlhttp.status==200) {
			// alert(xmlhttp.responseText);
			var roomMates= JSON.parse(xmlhttp.responseText);
			for(i in mySubjects){

				 
			}
			
			//document.getElementById("subjects").style.display='block';
		}
		else{
			alert(xmlhttp.status);
		}
	}
	else{
		//alert("Error "+xmlhttp.readyState+" "+xmlhttp.responseText);
	}
}
function setRoomMate() {
	var roomMate=document.getElementById('roomMate').value;
	document.getElementById('roomMateId').value=roomMate;
}
function fillSubjects(){
	// check if the request is completed and http response is okay
	if (xmlhttp.readyState==4) {
		if (xmlhttp.status==200) {
			// alert(xmlhttp.responseText);
			var mySubjects= JSON.parse(xmlhttp.responseText);
			var txt="Select Subjects this teacher will be teaching in "+document.getElementById("className").value+"<br>";
			var count=0; // to count number of subjects
			for(i in mySubjects){
				 count++;
				 txt += "<input type='checkbox' value'"+mySubjects[i]+"' name='S"+count+ "' >"+ mySubjects[i]+count + "<br>";

				 
			}
			txt+="<input type='text' name='count' value='"+count+"' hidden>";
			document.getElementById("subjects").innerHTML=txt;
			//document.getElementById("subjects").style.display='block';
		}
		else{
			alert(xmlhttp.status);
		}
	}
	else{
		//alert("Error "+xmlhttp.readyState+" "+xmlhttp.responseText);
	}
}
