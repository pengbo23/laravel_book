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
            <button type="button" class="layui-btn" id="imgUpload">封面上传</button>
            <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                预览图：
                <div class="layui-upload-list" id="imgUploadDiv"></div>
            </blockquote>
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
            //多图片上传
            upload.render({
                elem: '#imgUpload'
                ,url: '{{route('backend.upload')}}'
                ,multiple: false
                ,data: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                }
                ,before: function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){
                        $('#imgUploadDiv').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img">')
                    });
                }
                ,done: function(res){
                    //上传完毕
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




