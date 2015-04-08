var timerlen = 5;
var panelAniLen = 250;

var timerID = new Array();
var startTime = new Array();
var panel = new Array();
var endHeight = new Array();
var moving = new Array();
var pOut = new Array();
var dir = new Array();

function panel_setup(panelname){
	pOut[panelname] = "in";
}

function panelout2(panelname,ndheight){
        if(moving[panelname])
                return;

	if(pOut[panelname] == "out")
           return; // cannot panel out something that is already visible

        moving[panelname] = true;
        dir[panelname] = "out";
	pOut[panelname] = "out";
        startpanel2(panelname,ndheight);
}

function panelin2(panelname,ndheight){
        if(moving[panelname])
                return;

	if(pOut[panelname] == "in")
           return; // cannot panel out something that is already visible
        moving[panelname] = true;
        dir[panelname] = "in";
	pOut[panelname] = "in";
        startpanel2(panelname,ndheight);
}

function startpanel2(panelname,ndheight){
        panel[panelname] = document.getElementById(panelname);

        endHeight[panelname] = ndheight;
        startTime[panelname] = (new Date()).getTime();

        if(dir[panelname] == "out"){
                panel[panelname].style.height = "1px";
        }

        timerID[panelname] = setInterval('paneltick2(\'' + panelname + '\');',timerlen);
}
function paneltick2(panelname){
        var elapsed = (new Date()).getTime() - startTime[panelname];

        if (elapsed > panelAniLen)
                endpSlide2(panelname)
        else {
                var d =Math.round(elapsed / panelAniLen * endHeight[panelname]);
                if(dir[panelname] == "in")
                 d = endHeight[panelname] - d;
                if(d < 1)
                d = 1;
                panel[panelname].style.height = d + "px";
        }

        return;
}

function endpSlide2(panelname){
        clearInterval(timerID[panelname]);

                panel[panelname].style.height = endHeight[panelname] + "px";
if(dir[panelname] == "in")
               panel[panelname].style.height = "1px";

        delete(moving[panelname]);
        delete(timerID[panelname]);
        delete(startTime[panelname]);
        delete(endHeight[panelname]);
        delete(panel[panelname]);
        delete(dir[panelname]);

        return;
}

function vPanelOver(){
clearTimeout(pTimer);
pTimer=setTimeout("panelout2('fpanel',89)", 450);
//panelout2('fpanel',100);
}
function vPanelOut(){
clearTimeout(pTimer);
pTimer=setTimeout("panelin2('fpanel',89)", 750);
}

//function vPanelDown(){
//  if(pOut['fpanel'] == "out") {
//	panelin2('fpanel',89);
//  } else {
//	panelout2('fpanel',89);
//  }
//}
//pOut['fpanel'] == "in";

var pTimer=setTimeout("panel_setup('fpanel')", 10);


