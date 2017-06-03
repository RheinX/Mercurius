/**
 * Created by Wjl on 2017/5/10.
 */

function getProfile(){
    var token = document.cookie.split(";")[0].split("=")[1];

    $.ajax({
        method:"POST",
        url:"http://localhost/DecisionSystem/index.php/Index_Controller/getProfile",
        data:"token=" + token,
        dataType:'json',
        async:false,
        success:function(data){
            var json = eval(data);
            if(json.state == true){
                document.getElementById("resName").value = json.resName;
                document.getElementById("userName").value = json.userName;
                document.getElementById("email").value = json.email;
                document.getElementById("realName").value = json.realName;
                document.getElementById("address").value = json.address;
                document.getElementById("city").value = json.city;
                document.getElementById("country").value = json.country;
                document.getElementById("postCode").value = json.postCode;
                document.getElementById("aboutMe").value = json.aboutMe;

                //有value属性的标签可以用jquery中的val（）设值
                //$("#aboutMe").val(json.aboutMe);

                //无value属性的标签可以用jquery中的text（）设值
                //h3标签
                $("#realName2").text(json.realName);
                //small标签
                $("#userName2").text(json.userName);
                //p标签
                $("#aboutMe2").text(json.aboutMe);
            }else{
                //跳转至登录界面

                alert(json.errorMessage);
                window.location.href = '/DecisionSystem_View/index.html'
            }

        }
    });
}







function setProfile(){
	            resName = document.getElementById("resName").value;
                userName = document.getElementById("userName").value;
                email = document.getElementById("email").value;
                realName = document.getElementById("realName").value;
                address = document.getElementById("address").value;
                city = document.getElementById("city").value;
                country = document.getElementById("country").value;
                postCode = document.getElementById("postCode").value;
                aboutMe = document.getElementById("aboutMe").value;
				$.ajax({
					method:"POST",
					url:"http://localhost/DecisionSystem/index.php/Index_Controller/setProfile",
					data:"resName="+resName+"&userName="+userName2+"&email=" + email,
					dataType: 'json',
					async:false,
                    success:function(data){
                        var json = eval(data);
                        alert(json.state);
                    }
					});
}


