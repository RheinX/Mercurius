function loadCommentLineReq() {
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
			
			if(jsonObj.state == true) {
				drawCommentLine(jsonObj)
			} else { //false
			    document.getElementById('chartHours').innerHTML = jsonObj.errorMsg
			}
		}
	}
	xmlhttp.open("GET","http://localhost/DecisionSystem/index.php/Core_Controller/getCommentLine",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
}


function drawCommentLine(ajaxjsonobj) {
/*自适应大小
var commentLineContainer = document.getElementById('chartHours')
var resizeCommentLineContainer = function() {
	alert(container.clientWidth)
	commentLineContainer.style.height = container.clientHeight
	commentLineContainer.style.width = container.clientWidth
}
*/


var commentLine = echarts.init(document.getElementById('chartHours'));

var jsonObj = ajaxjsonobj
var obj1 = jsonObj['0']
var obj2 = jsonObj['1']
var obj3 = jsonObj['2']
//设置日期，当前日期的前七天
var myDate = new Date(); //获取今天日期
myDate.setDate(myDate.getDate() - 6);
var dateArray = []; 
var dateTemp; 
var flag = 1; 
for (var i = 0; i < 7; i++) {
    dateTemp = (myDate.getMonth()+1)+"-"+myDate.getDate();
    dateArray.push(dateTemp);
    myDate.setDate(myDate.getDate() + flag);
}

commentLine.setOption({
	title: {
        text: ''
    },
    tooltip : {
        trigger: 'axis',
        axisPointer: {
            type: 'cross',
            label: {
                backgroundColor: '#6a7985'
            }
        }
    },
    legend: {
        data:['好评','中评','差评']
    },
    toolbox: {
        feature: {
            saveAsImage: {}
        }
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    xAxis : [
        {
            type : 'category',
            boundaryGap : false,
            data : dateArray
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:obj1.name,
            type:'line',
            //areaStyle: {normal: {}},
			label: {
                normal: {
                    show: true,
                    position: 'top'
                }
            },
            data:obj1.data
        },
        {
            name:obj2.name,
            type:'line',
            //areaStyle: {normal: {}},
            data:obj2.data
        },
        {
            name:obj3.name,
            type:'line',
            //areaStyle: {normal: {}},
            data:obj3.data
        }
    ]
})

/*
window.onresize = function(){
	resizeCommentLineContainer();
    commentLine.resize();
}
*/
}