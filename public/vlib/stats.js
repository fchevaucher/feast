
function createObject() {

var request_type;
var cfield;

var browser = navigator.appName;

if(browser == "Microsoft Internet Explorer"){
request_type = new ActiveXObject("Microsoft.XMLHTTP");}else{
	request_type = new XMLHttpRequest();}
 return request_type;
}


var http = createObject();

function autosuggest(fieldname) {
q = document.getElementById(fieldname).value;
nocache = Math.random();
cfield=fieldname;
http.open('get', 'vlib/stats.php?q=' + q + '&field='+ fieldname +'&nocache = '+nocache);
http.onreadystatechange = autosuggestReply;
http.send(null);
}

function autosuggestReply() {
if(http.readyState == 4){

var response = http.responseText;

e = document.getElementById('s'+cfield);
	if(response!=""){

e.innerHTML=response;
e.style.display="block";
} else {

e.style.display="none";
} } }

function setField(fieldname,pname,mid){
s = document.getElementById('s' + fieldname);
s.innerHTML = pname + ' <a href="javascript:reEdit(' + "'" + fieldname + "'" + ')">edit</a>';
s = document.getElementById('h' + fieldname);
s.value = mid;
s = document.getElementById(fieldname);
s.style.display="none";
}

function reEdit(fieldname){
e = document.getElementById(fieldname);
e.style.display="inline";
e = document.getElementById("s" + fieldname);
e.style.display="none";
s = document.getElementById('h' + fieldname);
s.value = "";
}

