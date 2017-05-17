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
    var password = $('#password').val();
    if(userName==null||userName==""|| password==null|| password==""){
        flag = false;
    }

    if(flag==false){
        alert("输入错误");
    }
    else{
        $.ajax({
            method:"POST",
            url:"http://112.74.89.4/DecisionSystem/index.php/Index_Controller/login",
            data:"userName="+userName+"&passWord="+password,
            dataType: 'json',
            async:false,
            success:function(data){
                var a = eval(data);
                if(a.state==true){

                    //turn(a);
                }
                else{
                    alert(a.errorMessage);

                }
            }
        });

    }

}


function register() {
    var flag = true;
    var phoneNum = $('#phoneNum').val();
    var userName2 = $('#userName2').val();
    var password2 = $('#password2').val();
    var password3 = $('#password3').val();
    if(phoneNum==null||phoneNum==""||userName2==null||userName2==""|| password2==null|| password2==""|| password3==null|| password3==""|| password2 != password3){
        flag = false;
    }

    if(flag==false){
        alert("输入错误");
    }
    else{
        $.ajax({
            method:"POST",
            url:"http://112.74.89.4/DecisionSystem/index.php/Index_Controller/register",
            data:"phoneNum="+phoneNum+"&userName="+userName2+"&password=",
            dataType: 'json',
            async:false,
            success:function(data){
                var a = eval(data);
                if(a.state==true){

                    //turn(a);
                }
                else{
                    alert(a.errorMessage);
                }
            }
        });

    }

}

function turn(token){   //跳转页面与存cookies
    document.cookie = "token=" + token;
    window.href = ""
}


