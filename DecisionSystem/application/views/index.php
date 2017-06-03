<!doctype html>
<base href="<?php  echo base_url();?>"/>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>后台管理系统</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="resources/assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="resources/assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="resources/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="resources/assets/css/admin.css">
    <link rel="stylesheet" href="resources/assets/css/app.css">
</head>

<body data-type="login">

<div class="am-g myapp-login">
    <div class="myapp-login-logo-block  tpl-login-max">
        <div class="myapp-login-logo-text">
            <div class="myapp-login-logo-text">
                后台管理<span> 系统</span> <i class="am-icon-skyatlas"></i>

            </div>
        </div>

        <div class="login-font">
            <i>Log In </i> or <span> Sign Up</span>
        </div>
        <div class="am-u-sm-10 login-am-center">
            <?php echo validation_errors(); ?>

            <?php echo form_open('Admin_Controller/loginHandle'); ?>
            <div class="am-form">
                <fieldset>
                    <div class="am-form-group">
                        <input type="email" class="" id="doc-ipt-email-1" placeholder="输入电子邮件" name="email">
                    </div>
                    <div class="am-form-group">
                        <input type="password" class="" id="doc-ipt-pwd-1" placeholder="设置个密码吧" name="password">
                    </div>
                    <p><button type="submit" class="am-btn am-btn-default">登录</button></p>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<script src="resources/assets/js/jquery.min.js"></script>
<script src="resources/assets/js/amazeui.min.js"></script>
<script src="resources/assets/js/app.js"></script>
</body>

</html>