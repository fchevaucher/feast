function showEdit() {

    var popScreen = document.getElementById('screen');
    var popDialog = document.getElementById('editDialog');

	//document.getElementById('start-download').className = 'show';
	getSize();
    popScreen.style.height = myScrollHeight + 'px';
    popScreen.style.display = 'block';
	
    popDialog.style.left = ((myWidth - popDialog.offsetWidth) / 2) + 'px';
    popDialog.style.top = (((myHeight - popDialog.offsetHeight) / 2) + 10 + myScroll) + 'px';
    popDialog.style.visibility = 'visible';
    
}

function setLocation(loc) {
	window.location = loc;
}

function hideEdit() {
    var popScreen = document.getElementById('screen');
    var popDialog = document.getElementById('editDialog');
    
    popDialog.style.visibility = 'hidden';
    popScreen.style.display = 'none';
}


function getSize() {

	// Window Size

	if (self.innerHeight) { // Everyone but IE
		myWidth = window.innerWidth;
		myHeight = window.innerHeight;
		myScroll = window.pageYOffset;
	} else if (document.documentElement && document.documentElement.clientHeight) { // IE6 Strict
		myWidth = document.documentElement.clientWidth;
		myHeight = document.documentElement.clientHeight;
		myScroll = document.documentElement.scrollTop;
	} else if (document.body) { // Other IE, such as IE7
		myWidth = document.body.clientWidth;
		myHeight = document.body.clientHeight;
		myScroll = document.body.scrollTop;
	}

	// Page size w/offscreen areas

	if (window.innerHeight && window.scrollMaxY) {	
		myScrollWidth = document.body.scrollWidth;
		myScrollHeight = window.innerHeight + window.scrollMaxY;
	} else if (document.body.scrollHeight > document.body.offsetHeight) { // All but Explorer Mac
		myScrollWidth = document.body.scrollWidth;
		myScrollHeight = document.body.scrollHeight;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		myScrollWidth = document.body.offsetWidth;
		myScrollHeight = document.body.offsetHeight;
	}
}

