@extends('layouts.backend')
@section('content')
    <div class="layui-btn-group demoTable" style="margin-top: 5px;">
        <a  href="{{route('book.add')}}" class="layui-btn">增加书籍</a>
        <button class="layui-btn" data-type="getCheckData">获取选中行数据</button>
        <button class="layui-btn" data-type="getCheckLength">获取选中数目</button>
        <button class="layui-btn" data-type="isAll">验证是否全选</button>
    </div>
    <div style="margin-top: 5px;">
        <form class="layui-form layui-form-pane"  method="get" action="{{route('book')}}">
            <input type="hidden" name="page" value="{{request('page')}}">
            <input type="hidden" name="limit" value="{{request('limit')}}">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">书籍名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" value="{{request('title')}}" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <div class="layui-input-inline">
                    <button class="layui-btn" lay-submit="" lay-filter="demo2">查询</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <table class="layui-table" lay-data="{ height:700, url:'{{route('getBook')}}',where: {title: '{{request('title')}}', id: 123}, page:true, id:'idTest'}" lay-filter="demo">
        <thead>
        <tr>
            <th lay-data="{checkbox:true, fixed: true}"></th>
            <th lay-data="{field:'id', width:80, sort: true, fixed: true}">ID</th>
            <th lay-data="{field:'title', width:200}">书名</th>
            <th lay-data="{field:'introduction', width:200, sort: true}">简介</th>
            <th lay-data="{field:'created_at', width:200}">创建时间</th>
            <th lay-data="{fixed: 'right', width:160, align:'center', toolbar: '#barDemo'}">操作</th>
        </tr>
        </thead>
    </table>

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-mini" lay-event="edit" >编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
    </script>
@endsection
@section('js')
    <script>
        layui.use('table', function(){
            var table = layui.table;

            //监听表格复选框选择
            table.on('checkbox(demo)', function(obj){
                console.log(obj)
            });
            //监听工具条
            table.on('tool(demo)', function(obj){
                var data = obj.data;
                if(obj.event === 'detail'){
                    layer.msg('ID：'+ data.id + ' 的查看操作');
                } else if(obj.event === 'del'){
                    console.log(data.id);
                    layer.confirm('真的删除行么', function(index){
                        var index1 =0;
                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url:"{{route('book.delete')}}",
                            data: {id:data.id},
                            dataType: 'json',
                            beforeSend:function(){
                                index1 =  layer.load();
                            },
                            complete:function(){
                                layer.close(index1);
                            },
                            success: function (data) {
                                obj.del();
                                layer.close(index);
                            }
                        });

                    });
                } else if(obj.event === 'edit'){
                    console.log(data);
                    window.location.href = data.editUrl;
                }
            });

            var $ = layui.$, active = {
                getCheckData: function(){ //获取选中数据
                    var checkStatus = table.checkStatus('idTest')
                        ,data = checkStatus.data;
                    layer.alert(JSON.stringify(data));
                }
                ,getCheckLength: function(){ //获取选中数目
                    var checkStatus = table.checkStatus('idTest')
                        ,data = checkStatus.data;
                    layer.msg('选中了：'+ data.length + ' 个');
                }
                ,isAll: function(){ //验证是否全选
                    var checkStatus = table.checkStatus('idTest');
                    layer.msg(checkStatus.isAll ? '全选': '未全选')
                }
            };

            $('.demoTable .layui-btn').on('click', function(){
                var type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });
        });
    </script>
@endsection




