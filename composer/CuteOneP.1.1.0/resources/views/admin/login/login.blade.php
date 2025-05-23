<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登录 - CuteOne</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/css/font-awesome.min.css" media="all">
    <link rel="stylesheet" href="/layui/rc/css/layui.css" media="all">
    <link rel="stylesheet" href="/css/admin.css" media="all">
    <link rel="stylesheet" href="/css/adminlogin.css" media="all">
</head>
<body>
<div id="LAY_app" class="layadmin-tabspage-none">
    <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">
        <div class="layadmin-user-login-main">
            <div class="layadmin-user-login-box layadmin-user-login-header">
                <h2>CuteOneP</h2>
                <p>这是一个优秀的OneDrive多账户管理系统</p>
            </div>
            <form class="layui-form" id="form1">
                {{ csrf_field() }}
                <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
                    <div class="layui-form-item">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-username"></label>
                        <input type="text" name="username" id="username" lay-verify="required" placeholder="用户名" class="layui-input">
                    </div>
                    <div class="layui-form-item">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-password"></label>
                        <input type="password" name="password" id="password" lay-verify="required" placeholder="密码" class="layui-input">
                    </div>
                </div>
                <div class="layadmin-user-login-box">
                    <div class="layui-form-item">
                        <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="login-submit">登 入</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="layui-trans layadmin-user-login-footer">
            <p>© 2019 <a href="https://github.com/Hackxiaoya/CuteOne" target="_blank">CuteOne</a></p>
        </div>
    </div>
</div>

<script type="application/javascript" src="/layui/layui.js"></script>
<script>
    layui.use(['form'], function(){
        var $ = layui.$
            ,form = layui.form;

        form.render();

        //提交
        form.on('submit(login-submit)', function(obj){
            $.ajax({
                url: "/admin/login"
                ,type: "POST"
                ,dataType: "json"
                ,data: $('#form1').serialize()
                ,success: function (data) {
                    if(data.code==0){
                        location.href = '/admin/index';
                    }else{
                        layer.msg(data.msg);
                    }
                }
            });
            return false;
        });

    });
</script>
</body>
</html>
