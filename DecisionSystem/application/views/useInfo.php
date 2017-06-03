 <div class="tpl-content-wrapper">
        <div class="tpl-content-page-title">
            Amaze UI 表单
        </div>
     <ol class="am-breadcrumb">
         <li><a href="index.php/Admin_Controller/user" class="am-icon-home">首页</a></li>
         <li><a href="index.php/Admin_Controller/user">用户</a></li>
         <li class="am-active">用户信息</li>
     </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 用户信息
                </div>

            </div>
            <div class="tpl-block ">

                <div class="am-g tpl-amazeui-form">


                    <div class="am-u-sm-12 am-u-md-9">
                        <form class="am-form am-form-horizontal">
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">姓名 / Name</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="user-name" placeholder="姓名 / Name" readonly="readonly"
                                        value="<?php echo $realName;?>">
<!--                                    -->
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-email" class="am-u-sm-3 am-form-label">电子邮件 / Email</label>
                                <div class="am-u-sm-9">
                                    <input type="email" id="user-email" placeholder="输入你的电子邮件 / Email" readonly="readonly"
                                       value="<?php echo $email?>" >

                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-phone" class="am-u-sm-3 am-form-label">电话 / Telephone</label>
                                <div class="am-u-sm-9">
                                    <input type="tel" id="user-phone" placeholder="输入你的电话号码 / Telephone" readonly="readonly"
                                       value="<?php echo $phone; ?>" >
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-QQ" class="am-u-sm-3 am-form-label">店铺名</label>
                                <div class="am-u-sm-9">
                                    <input type="number" pattern="[0-9]*" id="user-QQ" placeholder="输入你的QQ号码 " readonly="readonly"
                                    value="<?php echo $resName;?>">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">地址</label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="user-weibo" placeholder="输入你的微博 / Twitter" readonly="readonly"
                                           value="<?php echo $address;?>" >
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-intro" class="am-u-sm-3 am-form-label">简介 / Intro</label>
                                <div class="am-u-sm-9">
                                    <textarea class="" rows="5" id="user-intro" placeholder="输入个人简介" readonly="readonly"
                                     ><?php echo $aboutMessage;?></textarea>

                                </div>
                            </div>

<!--                            <div class="am-form-group">-->
<!--                                <div class="am-u-sm-9 am-u-sm-push-3">-->
<!--                                    <button type="button" class="am-btn am-btn-primary">保存修改</button>-->
<!--                                </div>-->
<!--                            </div>-->
                        </form>
                    </div>
                </div>
            </div>

        </div>










    </div>

</div>


<script src="resources/assets/js/jquery.min.js"></script>
<script src="resources/assets/js/amazeui.min.js"></script>
<script src="resources/assets/js/app.js"></script>
</body>

</html>