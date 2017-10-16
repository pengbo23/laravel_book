@extends('layouts.backend')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" >
        <legend>修改书籍</legend>
    </fieldset>
    <form class="layui-form layui-form-pane" method="POST" id="userForm" action="{{route('book.update')}}">
        <input name="id" type="hidden" value="{{$book['id']}}">
        {{ csrf_field() }}
        <div class="layui-form-item">
            <label class="layui-form-label">书名</label>
            <div class="layui-input-block">
                <input type="text" name="title" autocomplete="off" placeholder="请输入书名" value="{{$book['title']}}" class="layui-input"  lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">简介</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入简介" name="introduction"   class="layui-textarea" lay-verify="required">{{$book['introduction']}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">发布日期</label>
            <div class="layui-input-block">
                <input type="text" name="publish_date" id="date1"   value="{{$book['publish_date']}}" autocomplete="off" class="layui-input"  lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item">
            <button class="layui-btn" lay-submit="" lay-filter="demo2">确定</button>
        </div>
    </form>
@endsection
@section('js')
    <script>
        layui.use(['form', 'laydate','jquery'], function(){
            var form = layui.form
                ,layer = layui.layer
                , $ = layui.$
                ,laydate = layui.laydate;
            laydate.render({
                elem: '#date1'
            });
            //监听提交
            form.on('submit(demo2)', function(data){
                var index;
                $.ajax({

                    type: "POST",
                    url:"{{route('book.update')}}",
                    data: $('#userForm').serialize(),
                    dataType: 'json',
                    beforeSend:function(){
                        index =  layer.load();
                    },
                    complete:function(){
                        layer.close(index);
                    },
                    success: function (msg) {
                        layer.open({title:'haha',content:'............'});
                        if (msg == 'true') {
                            layer.open({title:'haha',content:'............'});
                        }
                    }
                });
                return false;
            });
        });
    </script>
@endsection




