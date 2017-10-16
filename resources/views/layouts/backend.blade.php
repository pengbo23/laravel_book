<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'book') }}</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('layui/css/layui.css') }}" rel="stylesheet">
    <link href="{{ asset('layui/css/global.css') }}" rel="stylesheet">
</head>
<body>
<div class="layui-layout layui-layout-admin">
    <div class="layui-header header header-demo">
        <div class="layui-main">
            <a class="logo" href="/" style="color: white">
               主页
            </a>s
            <ul class="layui-nav" pc>
                <li class="layui-nav-item" pc>
                    <a href="javascript:;">{{session('backend_user_data.user_name')}}</a>
                    <dl class="layui-nav-child">
                        <dd><a href="#"  >简介</a></dd>
                        <dd><a href="#" >修改密码</a></dd>
                        <dd><a href="{{route('backendLogout')}}" >退出</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item" mobile>
                    <a href="javascript:;">更多</a>
                    <dl class="layui-nav-child">
                        <dd><a href="http://fly.layui.com/" target="_blank">社区</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">

            <ul class="layui-nav layui-nav-tree site-demo-nav">

                <li class="layui-nav-item layui-nav-itemed">
                    <a class="javascript:;" href="javascript:;">开发工具</a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="/demo/">调试预览</a>
                        </dd>
                    </dl>
                </li>

                <li class="layui-nav-item layui-nav-itemed">
                    <a class="javascript:;" href="javascript:;">book</a>
                    <dl class="layui-nav-child">
                        <dd class="layui-this">
                            <a href="{{ route('book') }}">book</a>
                        </dd>
                        <dd class="">
                            <a href="{{ route('book.tag') }}">book_tag</a>
                        </dd>
                    </dl>
                </li>

                <li class="layui-nav-item" style="height: 30px; text-align: center"></li>
            </ul>

        </div>
    </div>
    <div class="layui-body site-demo">
        <div style="margin-left: 8px;">
        @yield('content')
        </div>
    </div>
    <div class="layui-footer footer footer-demo" >
        <div class="layui-main">
            <p>&copy; 2017 <a href="/">book</a> Book license</p>
        </div>
    </div>

    <div class="site-tree-mobile layui-hide">
        <i class="layui-icon">&#xe602;</i>
    </div>
    <div class="site-mobile-shade"></div>
    <script src="{{ asset('layui/layui.js') }}"></script>
    <script>
            layui.use(['jquery', 'layer','element'], function(){
                var $ = layui.$ //重点处
                    ,layer = layui.layer;
                $('.site-tree-mobile').on('click',function(){
                    $('body').addClass('site-mobile');
                     $('.layui-side').show();
                });
                $('.site-mobile-shade').on('click',function(){
                    $('body').removeClass('site-mobile');
                });
            });
    </script>
    @yield('js')
</div>
</body>
</html>