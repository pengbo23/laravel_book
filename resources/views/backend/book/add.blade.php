@extends('layouts.backend')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" >
        <legend>增加书籍</legend>
    </fieldset>
    <form class="layui-form layui-form-pane" method="POST" id="userForm" action="{{route('book.add')}}">
        {{ csrf_field() }}
        <div class="layui-form-item">
            <label class="layui-form-label">书名</label>
            <div class="layui-input-block">
                <input type="text" name="title" autocomplete="off" placeholder="请输入书名" class="layui-input"  lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">标签</label>
            <div class="layui-input-block">
                @foreach ($bookTag as $item)
                    <input name="tag[{{$item->id}}]" title="{{$item->tag}}" type="checkbox">
                @endforeach
            </div>
        </div>
        <div class="layui-upload">
            <button type="button" class="layui-btn" id="imgUpload">封面图片</button>
            <input  name="pic" id="pic" value=""  type="hidden">
                <div class="layui-upload-list">
                    <img class="layui-upload-img" id="demo1">
                    <p id="demoText"></p>
                </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">简介</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入简介" name="introduction"   class="layui-textarea" lay-verify="required"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">发布日期</label>
            <div class="layui-input-block">
                <input type="text" name="publish_date" id="date1" autocomplete="off" class="layui-input"  lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item">
            <button class="layui-btn" lay-submit="" lay-filter="demo2">确定</button>
        </div>
    </form>
@endsection
@section('js')
    <script>
        layui.use(['form', 'laydate','jquery','upload'], function(){
            var form = layui.form
                ,layer = layui.layer
                , $ = layui.$
                ,laydate = layui.laydate
                ,upload = layui.upload;
            laydate.render({
                elem: '#date1'
            });

            //普通图片上传
            var uploadInst = upload.render({
                elem: '#imgUpload'
                ,url: '{{route('backend.upload')}}'
                ,data: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                }
                ,before: function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){
                        $('#demo1').attr('src', result); //图片链接（base64）
                    });
                }
                ,done: function(res){
                    console.log(res);
                    //如果上传失败
                    if(res.code > 0){
                        return layer.msg('上传失败');
                    }
                    $('#pic').val(res.data.path);
                    //上传成功
                }
                ,error: function(){
                    //演示失败状态，并实现重传
                    var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function(){
                        uploadInst.upload();
                    });
                }
            });

            //监听提交
            form.on('submit(demo2)', function(data){
                var index;
                $.ajax({
                    type: "POST",
                    url:"{{route('book.add')}}",
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




