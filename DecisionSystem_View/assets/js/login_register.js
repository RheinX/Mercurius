/**
 * Created by Wjl on 2017/5/10.
 */

//document.write("<script language=javascript src=’assets/js/dialog.js’></script>");

function login() {
    // var abc = dialog({
    //     title: '欢迎',
    //     content: '欢迎使用 artDialog 对话框组件！'
    // });
    var flag = true;
    var userName = $('#userName').val();
    var passWord = $('#passWord').val();
    if(userName==null||userName==""|| passWord==null|| passWord==""){
        flag = false;
    }

    if(flag==false){
        alert("输入错误");
    }
    else{
       // location.href = "../userView/user.html";
        $.ajax({
            method:"POST",
            url:"http://localhost/DecisionSystem/index.php/Index_Controller/login",
            data:"userName="+userName+"&passWord="+passWord,
            dataType: 'json',
            async:false,
            success:function(data){
                var json = eval(data);
                if(json.state==true){
                    turn(json.token);
                }
                else{
                    alert(json.errorMessage);

                }
            }
        });

    }

}


function register() {
    var flag = true;
    var phoneNum = $('#phoneNum').val();
    var userName2 = $('#userName2').val();
    var passWord2 = $('#passWord2').val();
    var passWord3 = $('#passWord3').val();
    if(phoneNum==null||phoneNum==""||userName2==null||userName2==""|| passWord2==null|| passWord2==""|| passWord3==null|| passWord3==""|| passWord2 != passWord3){
        flag = false;
    }

    if(flag==false){
        alert("输入错误");
    }
    else{

        $.ajax({
            method:"POST",
            url:"http://localhost/DecisionSystem/index.php/Index_Controller/register",
            data:"phoneNum="+phoneNum+"&userName="+userName2+"&passWord=" + passWord2,
            dataType: 'json',
            async:false,
            success:function(data){
                var json = eval(data);
                if(json.state == true){

                    turn(json.token);
                }
                else{
                    alert(json.errorMessage);
                }
            }
        });

    }

}

function turn(token){   //跳转页面与存cookies
    document.cookie = "token=" + token ;

    location.href = "/DecisionSystem_View/userView/user.html";
}


