
function createObject() {

var request_type;

var browser = navigator.appName;

if(browser == "Microsoft Internet Explorer"){
request_type = new ActiveXObject("Microsoft.XMLHTTP");}else{
	request_type = new XMLHttpRequest();}
 return request_type;
}


var http = createObject();

function autocw(cMid) {
	if (document.getElementById('slctRel').selectedIndex < 5) {
	q = document.getElementById('rell_name').value;
	nocache = Math.random();
	http.open('get', 'clib/ncwid.php?q='+q+'&nocache='+nocache + '&cMid=' + cMid);
	http.onreadystatechange = autocwReply;
	http.send(null);
	} else {
	document.getElementById('cworkers').style.display="none";
	}
}

function autocwReply() {
if(http.readyState == 4){

var response = http.responseText;

e = document.getElementById('cworkers');
	if(response!=""){

e.innerHTML=response;
e.style.display="block";
} else {

e.style.display="none";
} } }
