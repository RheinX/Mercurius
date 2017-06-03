function loadCommentBarReq() {
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
			
			//画柱形图
			if(jsonObj.state == true) {
				drawCommentBar(jsonObj)
			} else { //false
			    document.getElementById('chartActivity').innerHTML = jsonObj.errorMsg
			}
		}
	}
	xmlhttp.open("GET","http://localhost/DecisionSystem/index.php/Core_Controller/getCommentBar",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
}


function drawCommentBar(ajaxjsonobj) {
/*自适应大小
var commentBarContainer = document.getElementById('chartActivity')
var resizeCommentBarContainer = function() {
	alert(container.clientWidth)
	commentBarContainer.style.height = container.clientHeight
	commentBarContainer.style.width = container.clientWidth
}
*/


var commentBar = echarts.init(document.getElementById('chartActivity'));

var jsonObj = ajaxjsonobj

var dataArr = [];//js如何生成json数组
dataArr.push(jsonObj['0'])
dataArr.push(jsonObj['1'])
dataArr.push(jsonObj['2'])

commentBar.setOption({
	color: ['#3398DB'],
    tooltip : {
        trigger: 'axis',
        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
            type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
        }
    },
    grid: {
        left: '3%',
        right: '3%',
        bottom: '3%',
        containLabel: true
    },
    xAxis : [
        {
            type : 'category',
            data : jsonObj.keyword,
            axisTick: {
                alignWithLabel: true
            }
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'直接访问',
            type:'bar',
            barWidth: '35%',
            data:jsonObj.data
        }
    ]
})

/*
window.onresize = function(){
	resizeCommentBarContainer();
    commentBar.resize();
}
*/
}