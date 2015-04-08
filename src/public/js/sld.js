var timerlen = 5;
var slideAniLen = 250;

var timerID = new Array();
var startTime = new Array();
var obj = new Array();
var endWidth = new Array();
var moving = new Array();
var oOut = new Array();
var dir = new Array();
function slideout2(objname,ndwidth){
        if(moving[objname])
                return;

	if(oOut[objname] == "out")
           return; // cannot slide out something that is already visible

        moving[objname] = true;
        dir[objname] = "out";
	oOut[objname] = "out";
        startslide2(objname,ndwidth);
}

function slidein2(objname,ndwidth){
        if(moving[objname])
                return;

	if(oOut[objname] == "in")
           return; // cannot slide out something that is already visible
        moving[objname] = true;
        dir[objname] = "in";
	oOut[objname] = "in";
        startslide2(objname,ndwidth);
}

function startslide2(objname,ndwidth){
        obj[objname] = document.getElementById(objname);

        endWidth[objname] = ndwidth;
        startTime[objname] = (new Date()).getTime();

        if(dir[objname] == "out"){
                obj[objname].style.width = "60px";
        }

        obj[objname].style.display = "block";

        timerID[objname] = setInterval('slidetick2(\'' + objname + '\');',timerlen);
}
function slidetick2(objname){
        var elapsed = (new Date()).getTime() - startTime[objname];

        if (elapsed > slideAniLen)
                endSlide2(objname)
        else {
                var d =Math.round(elapsed / slideAniLen * endWidth[objname]);
                if(dir[objname] == "in")
                 d = endWidth[objname] - d;
                if(d < 60)
                d = 60;
                obj[objname].style.width = d + "px";
        }

        return;
}

function endSlide2(objname){
        clearInterval(timerID[objname]);

                obj[objname].style.width = endWidth[objname] + "px";
if(dir[objname] == "in")
               obj[objname].style.width = "60px";

        delete(moving[objname]);
        delete(timerID[objname]);
        delete(startTime[objname]);
        delete(endWidth[objname]);
        delete(obj[objname]);
        delete(dir[objname]);

        return;
}
function srchBlur() {
document.getElementById('mq_sr').value = '';
autosuggest();
}

function vMenOver(){
clearTimeout(vTimer);
slideout2('sidmen',200);
}
function vMenOut(){
vTimer=setTimeout("slidein2('sidmen',200)", 1300);
}
var vTimer=setTimeout("slidein2('sidmen',200)", 500);

