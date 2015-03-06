
function createObject() {

var request_type;

var browser = navigator.appName;

if(browser == "Microsoft Internet Explorer"){
request_type = new ActiveXObject("Microsoft.XMLHTTP");}else{
	request_type = new XMLHttpRequest();}
 return request_type;
}


var http = createObject();

function autosuggest() {
q = document.getElementById('mq_sr').value;
nocache = Math.random();
http.open('get', 'vlib/search.php?q='+q+'&nocache = '+nocache);
http.onreadystatechange = autosuggestReply;
http.send(null);
}

function autosuggestReply() {
if(http.readyState == 4){

var response = http.responseText;

e = document.getElementById('mq_ac');
	if(response!=""){

e.innerHTML=response;
e.style.display="block";
} else {

e.style.display="none";
} } }