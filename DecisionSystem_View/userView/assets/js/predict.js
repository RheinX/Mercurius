    //

    // var JSONObject= {
    //     "name":"Bill Gates",
    //    "street":"Fifth Avenue New York 666",
    //     "age":56,
    //     "phone":"555 1234567"};
    // //var obj = eval ("(" + txt + ")");-->
    // document.getElementById("h1").innerHTML=JSONObject.name
    // document.getElementById("h2").innerHTML=JSONObject.age
    // document.getElementById("h3").innerHTML=JSONObject.street
    // document.getElementById("h4").innerHTML=JSONObject.phone





    $(function () {

        var xmlhttp;
        var url="http://112.74.89.4/DecisionSystem/index.php/Core_Controller/predict/3/4";  xmlhttp=null;
        if (window.XMLHttpRequest)
        {// code for Firefox, Opera, IE7, etc.
            xmlhttp=new XMLHttpRequest();

        }
        else if (window.ActiveXObject)
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        if (xmlhttp!=null)
        {
            xmlhttp.onreadystatechange=state_Change;
            xmlhttp.open("GET",url,true);
            xmlhttp.send(null);

        }
        else
        {
            alert("Your browser does not support XMLHTTP.");
        }


        function state_Change()
        {

            if (xmlhttp.readyState==4)
            {// 4 = "loaded"
                
                if (xmlhttp.status==200)
                {// 200 = "OK"

                    var msg=xmlhttp.responseText;
                    
                    //var msg="{\"name\":\"Bill Gates\",\"street\":\"Fifth Avenue New York 666\",\"age\":56,\"phone555 1234567\"}";
                    var obj = eval ("(" + msg + ")");
                    document.getElementById("header1").innerHTML=obj[0].dishName;
                    document.getElementById("header2").innerHTML=obj[1].dishName;
                    document.getElementById("header3").innerHTML=obj[2].dishName;
                    document.getElementById("header4").innerHTML=obj[3].dishName;

                    document.getElementById("1day1").innerHTML=obj[0].volume[0];
                    document.getElementById("1day2").innerHTML=obj[0].volume[1];
                    document.getElementById("1day3").innerHTML=obj[0].volume[2];

                    document.getElementById("2day1").innerHTML=obj[1].volume[0];
                    document.getElementById("2day2").innerHTML=obj[1].volume[1];
                    document.getElementById("2day3").innerHTML=obj[1].volume[2];

                    document.getElementById("3day1").innerHTML=obj[2].volume[0];
                    document.getElementById("3day2").innerHTML=obj[2].volume[1];
                    document.getElementById("3day3").innerHTML=obj[2].volume[2];

                    document.getElementById("4day1").innerHTML=obj[3].volume[0];
                    document.getElementById("4day2").innerHTML=obj[3].volume[1];
                    document.getElementById("4day3").innerHTML=obj[3].volume[2];
                }
                else
                {
                    alert("Problem retrieving data:" + xmlhttp.statusText);
                }
            }
        }
        });