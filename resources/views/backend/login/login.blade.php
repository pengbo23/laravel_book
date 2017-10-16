<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>登录--layui后台管理模板</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}" media="all" />
	<style>
		body{overflow:hidden;background-color: white}
		.video_mask{ width:100%; height:100%; position:absolute; left:0; top:0; z-index:90; background-color:rgba(42, 117, 79, 0.5); }
		.login{ height:260px;width:260px;padding: 20px;background-color:rgba(0,0,0,0.5);border-radius: 4px;position:absolute;left: 50%;top: 50%; margin:-150px 0 0 -150px;z-index:99;}
		.login h1{ text-align:center; color:#fff; font-size:24px; margin-bottom:20px; }
		.form_code{ position:relative; }
		.form_code .code{ position:absolute; right:0; top:1px; cursor:pointer; }
		.login_btn{ width:100%; }
	</style>
</head>
<body>
	<div class="video_mask"></div>
	<div class="login">
	    <h1>layuiCMS-管理登录</h1>
	    <form class="layui-form" id="userForm">
			{{ csrf_field() }}
	    	<div class="layui-form-item">
				<input class="layui-input" name="username" placeholder="用户名" lay-verify="required" type="text" autocomplete="off">
		    </div>
		    <div class="layui-form-item">
				<input class="layui-input" name="password" placeholder="密码" lay-verify="required" type="password" autocomplete="off">
		    </div>
		    <div class="layui-form-item form_code">
				<input class="layui-input" name="code" placeholder="验证码" lay-verify="required" type="text" autocomplete="off">
				<div class="code"><img src="{{url('backendLoginCaptcha')}}" data-url="{{url('backendLoginCaptcha')}}" class="VerifyCode">
				</div>
		    </div>
			<button class="layui-btn login_btn" lay-submit="" lay-filter="login">登录</button>
		</form>
	</div>
	<script src="{{ asset('layui/layui.js') }}"></script>
	<script>
        layui.use(['jquery', 'layer','element','form'], function(){
            var $ = layui.$ //重点处
                ,layer = layui.layer,form = layui.form;
            $('body').on('click','.VerifyCode',function(){
                $(this).attr('src',$(this).data('url') + '?id=' + Math.random());
            });
            form.on('submit(login)', function(data){
                var index;
                $.ajax({
                    type: "POST",
                    url:"{{url('backendSignIn')}}",
                    data: $('#userForm').serialize(),
                    dataType: 'json',
                    beforeSend:function(){
                        index =  layer.load();
                    },
                    complete:function(){
                        layer.close(index);
                    },
                    success: function (data) {
                        if (data.code == 1) {
                            layer.alert(data.msg, {icon: 5});
                        }
                        if (data.code == 2) {
                            layer.msg(data.msg,{icon:1,time: 1000});
                            window.location.href = "{{route('backend.index')}}";
                        }
                    }
                });
                return false;
            });

        });
	</script>
</body>
</html>