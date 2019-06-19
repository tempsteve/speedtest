//SERVER AUTO SELECTION
function initServers(){
	fastSelectServer(SPEEDTEST_SERVERS,function(server){
		if(server!=null){ //at least 1 server is available
			I("loading").className="hidden"; //hide loading message
			//configure speedtest to use the specified server
			changeServer(server);
			//populate server list for manual selection
			for(var i=0;i<SPEEDTEST_SERVERS.length;i++){
				if(SPEEDTEST_SERVERS[i].pingT==-1) continue;
				var option=document.createElement("option");
				option.value=i;
				option.textContent=SPEEDTEST_SERVERS[i].name;
				if(SPEEDTEST_SERVERS[i]===server) option.selected=true;
				I("server").appendChild(option);
			}
			//show test UI
			I("testWrapper").className="visible";
			initUI();
		}else{ //no servers are available, the test cannot proceed
			I("message").innerHTML="No servers available";
		}
	});
}

function changeServer(server){
	speedtestSettings.url_dl=server.server+server.dlURL;
	speedtestSettings.url_ul=server.server+server.ulURL;
	speedtestSettings.url_ping=server.server+server.pingURL;
	speedtestSettings.url_getIp=server.server+server.getIpURL;
	speedtestSettings.telemetry_extra=JSON.stringify({server:server.name}); //add server name as extra data in the telemetry
}

var meterBk="#E0E0E0";
var dlColor="#6060AA",
	ulColor="#309030",
	pingColor="#AA6060",
	jitColor="#AA6060";
var progColor="#EEEEEE";

//CODE FOR GAUGES
function drawMeter(c,amount,bk,fg,progress,prog){
	var ctx=c.getContext("2d");
	var dp=window.devicePixelRatio||1;
	var cw=c.clientWidth*dp, ch=c.clientHeight*dp;
	var sizScale=ch*0.0055;
	if(c.width==cw&&c.height==ch){
		ctx.clearRect(0,0,cw,ch);
	}else{
		c.width=cw;
		c.height=ch;
	}
	ctx.beginPath();
	ctx.strokeStyle=bk;
	ctx.lineWidth=16*sizScale;
	ctx.arc(c.width/2,c.height-58*sizScale,c.height/1.8-ctx.lineWidth,-Math.PI*1.1,Math.PI*0.1);
	ctx.stroke();
	ctx.beginPath();
	ctx.strokeStyle=fg;
	ctx.lineWidth=16*sizScale;
	ctx.arc(c.width/2,c.height-58*sizScale,c.height/1.8-ctx.lineWidth,-Math.PI*1.1,amount*Math.PI*1.2-Math.PI*1.1);
	ctx.stroke();
	if(typeof progress !== "undefined"){
		ctx.fillStyle=prog;
		ctx.fillRect(c.width*0.3,c.height-16*sizScale,c.width*0.4*progress,4*sizScale);
	}
}
function mbpsToAmount(s){
	return 1-(1/(Math.pow(1.3,Math.sqrt(s))));
}
function msToAmount(s){
	return 1-(1/(Math.pow(1.08,Math.sqrt(s))));
}

//SPEEDTEST AND UI CODE
var w=null; //speedtest worker
var data=null; //data from worker
var speedtestSettings={
	telemetry_level:"basic"
};
function startStop(){
	if(w!=null){
		//speedtest is running, abort
		w.postMessage('abort');
		w=null;
		data=null;
		I("startStopBtn").className="";
		I("server").disabled=false;
		initUI();
	}else{
		//test is not running, begin
		w=new Worker('speedtest_worker.min.js');
		w.postMessage('start '+JSON.stringify(speedtestSettings)); //Add optional parameters as a JSON object to this command
		I("startStopBtn").className="running";
		I("server").disabled=true;
		w.onmessage=function(e){
			data=JSON.parse(e.data);
			var status=data.testState;
			if(status>=4){
				//test completed
				I("startStopBtn").className="";
				I("server").disabled=false;
				w=null;
				updateUI(true);
			}
		};
	}
}
//this function reads the data sent back by the worker and updates the UI
function updateUI(forced){
	if(!forced&&(!data||!w)) return;
	var status=data.testState;
	I("ip").textContent=data.clientIp;
	I("dlText").textContent=(status==1&&data.dlStatus==0)?"...":data.dlStatus;
	drawMeter(I("dlMeter"),mbpsToAmount(Number(data.dlStatus*(status==1?oscillate():1))),meterBk,dlColor,Number(data.dlProgress),progColor);
	I("ulText").textContent=(status==3&&data.ulStatus==0)?"...":data.ulStatus;
	drawMeter(I("ulMeter"),mbpsToAmount(Number(data.ulStatus*(status==3?oscillate():1))),meterBk,ulColor,Number(data.ulProgress),progColor);
	I("pingText").textContent=data.pingStatus;
	drawMeter(I("pingMeter"),msToAmount(Number(data.pingStatus*(status==2?oscillate():1))),meterBk,pingColor,Number(data.pingProgress),progColor);
	I("jitText").textContent=data.jitterStatus;
	drawMeter(I("jitMeter"),msToAmount(Number(data.jitterStatus*(status==2?oscillate():1))),meterBk,jitColor,Number(data.pingProgress),progColor);
}
function oscillate(){
	return 1+0.02*Math.sin(Date.now()/100);
}
//poll the status from the worker (this will call updateUI)
setInterval(function(){
	if(w) w.postMessage('status');
},200);
//update the UI every frame
window.requestAnimationFrame=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.msRequestAnimationFrame||(function(callback,element){setTimeout(callback,1000/60);});
function frame(){
	requestAnimationFrame(frame);
	updateUI();
}
frame(); //start frame loop
//function to (re)initialize UI
function initUI(){
	drawMeter(I("dlMeter"),0,meterBk,dlColor,0);
	drawMeter(I("ulMeter"),0,meterBk,ulColor,0);
	drawMeter(I("pingMeter"),0,meterBk,pingColor,0);
	drawMeter(I("jitMeter"),0,meterBk,jitColor,0);
	I("dlText").textContent="";
	I("ulText").textContent="";
	I("pingText").textContent="";
	I("jitText").textContent="";
	I("ip").textContent="";
}
