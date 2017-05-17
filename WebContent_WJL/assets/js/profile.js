/**
 * Created by Wjl on 2017/5/10.
 */

function getProfile(){

    $.ajax({
        method:"POST",
        url:"http://112.74.89.4/DecisionSystem/index.php/Index_Controller/getProfile",
        data:a,
        dataType:'json',
        async:false,
        success:function(data){
            var json = eval(data);
            //document.getElementById("userName").value = json.userName;
            document.getElementById("userName").value = json.userName;
            document.getElementById("address").value = json.address;
            document.getElementById("pic").value = json.pic;
            document.getElementById("email").value = json.email;
            document.getElementById("city").value = json.city;
            document.getElementById("country").value = json.country;
            document.getElementById("postCode").value = json.postCode;
            document.getElementById("aboutMe").value = json.aboutMe;
        }
    });
}


