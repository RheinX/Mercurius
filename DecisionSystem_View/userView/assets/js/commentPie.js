function loadCommentPieReq() {
    var xmlhttp;
	if(window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest(); 
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState==4 && xmlhttp.status==200) {
			var resJson = xmlhttp.responseText;
			var jsonObj = JSON.parse(resJson); //解析JSON字符串
			
			//画饼图
			if(jsonObj.state == true) {
				drawCommentPie(jsonObj)
			} else { //false
			    document.getElementById('chartPreferences').innerHTML = jsonObj.errorMsg
			}
		}
	}
	xmlhttp.open("GET","http://localhost/DecisionSystem/index.php/Core_Controller/getCommentPie",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
}


function drawCommentPie(ajaxjsonobj) {
/*自适应大小
var commentPieContainer = document.getElementById('chartPreferences')
var resizeCommentPieContainer = function() {
	alert(container.clientWidth)
	commentPieContainer.style.height = container.clientHeight
	commentPieContainer.style.width = container.clientWidth
}
*/


var commentPie = echarts.init(document.getElementById('chartPreferences'));
var jsonObj = ajaxjsonobj


var dataArr = [];//js如何生成json数组
dataArr.push(jsonObj['0'])
dataArr.push(jsonObj['1'])
dataArr.push(jsonObj['2'])

commentPie.setOption({
	tooltip: {
        trigger: 'item',
        formatter: "{a} <br/>{b}: {c} ({d}%)"
    },
    legend: {
        data:['好评','中评','差评']
    },
	series: [
		{
			name: '好中差评百分比',
			type: 'pie',
			radius: '55%',
			data: dataArr
		}
	]
})

/*
window.onresize = function(){
	resizeCommentPieContainer();
    commentPie.resize();
}
*/
}