@extends('layouts.backend')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" >
        <legend>增加书籍标签</legend>
    </fieldset>
    <form class="layui-form layui-form-pane" method="POST" id="userForm" action="{{route('bookTag.add')}}">
        {{ csrf_field() }}
        <div class="layui-form-item">
            <label class="layui-form-label">标签</label>
            <div class="layui-input-block">
                <input type="text" name="tag" autocomplete="off" placeholder="请输入标签" class="layui-input"  lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item">
            <button class="layui-btn" lay-submit="" lay-filter="sub-commit">确定</button>
        </div>
    </form>
@endsection
@section('js')
    <script>
        layui.use(['form','jquery'], function(){
            var form = layui.form
                ,layer = layui.layer
                , $ = layui.$;
            //监听提交
            form.on('submit(sub-commit)', function(data){
                var index;
                $.ajax({
                    type: "POST",
                    url:"{{route('bookTag.add')}}",
                    data: $('#userForm').serialize(),
                    dataType: 'json',
                    beforeSend:function(){
                        index =  layer.load();
                    },
                    complete:function(){
                        layer.close(index);
                    },
                    success: function (msg) {
                        if (msg == true) {
                           layer.open({title:'提示',content:'操作成功',icon:1});
                        }else {
                            layer.msg(msg);
                        }
                    },
                    error:function (error) {
                        layer.msg('网路错误');
                    }
                });
                return false;
            });
        });
    </script>
@endsection




