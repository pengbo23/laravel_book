@extends('layouts.backend')
@section('content')
    <span id="testView"></span>
    <div id="test2"></div>
@endsection
@section('js')
    <script>
        layui.use(['laydate'], function(){
            var laydate = layui.laydate;
            laydate.render({
                elem: '#test2'
                ,position: 'static'
                ,change: function(value, date){ //监听日期被切换
                    lay('#testView').html(value);
                }
            });
        });
    </script>
@endsection

