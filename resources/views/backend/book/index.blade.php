@extends('layouts.backend')
@section('top')
    <style>
        .layui-table-cell{
            height: 60px;
        }
    </style>
@endsection
@section('content')
    <div class="layui-btn-group demoTable" style="margin-top: 5px;">
        <a href="{{route('book.add')}}" class="layui-btn">增加书籍</a>
        <button class="layui-btn" data-type="getCheckData">获取选中行数据</button>
        <button class="layui-btn" data-type="getCheckLength">获取选中数目</button>
        <button class="layui-btn" data-type="isAll">验证是否全选</button>
    </div>
    <div style="margin-top: 5px;">
        <form class="layui-form layui-form-pane" method="get" action="{{route('book')}}">
            <input type="hidden" name="page" value="{{request('page')}}">
            <input type="hidden" name="limit" value="{{request('limit')}}">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">书籍名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" value="{{request('title')}}" autocomplete="off"
                               class="layui-input">
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
    <table id="dataTable" lay-filter="dataTable"></table>
    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-mini" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
    </script>
    <script type="text/html" id="titleTpl">
        @{{#  if(d.pic){ }}
        <a href="/@{{d.pic}}" target="_blank"><img width="80px" height="60px" src="/@{{d.pic}}"></a>
        @{{#  } }}

    </script>
@endsection
@section('js')
    <script>
        layui.use('table', function () {
            var table = layui.table;
            table.render({
                id:'idTest',
                skin: 'row', //行边框风格
                even: true ,//开启隔行背景

                elem: '#dataTable',  //其它参数在此省略
                // height: 600,    //容器高度
                height: 'full-280',
                url: '{{route('getBook')}}',
                where: {title: '{{request('title')}}', id: 123},
                cols: [[ //标题栏
                    {checkbox: true}
                    , {field: 'id', title: 'ID', width: 80}
                    , {field: 'title', title: '书名', width: 120}
                    , {field: 'introduction', title: '简介', width: 120}
                    , {field: 'pic', title: '图片', width: 120, templet: '#titleTpl'}
                    , {field: 'created_at', title: '创建时间', width: 120}
                    , {field: 'updated_at', title: '更新时间', width: 120}
                    , {fixed: 'right', width: 150, align: 'center', toolbar: '#barDemo',title:'操作'}
                ]],
                page: true,
                done: function (res, curr, count) {
                    //如果是异步请求数据方式，res即为你接口返回的信息。
                    //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                    console.log(res);

                    //得到当前页码
                    console.log(curr);

                    //得到数据总量
                    console.log(count);
                }
            });
            //监听表格复选框选择
            table.on('checkbox(dataTable)', function (obj) {
                console.log(obj)
            });
            //监听工具条
            table.on('tool(dataTable)', function (obj) {
                var data = obj.data;
                if (obj.event === 'detail') {
                    layer.msg('ID：' + data.id + ' 的查看操作');
                } else if (obj.event === 'del') {
                    console.log(data.id);
                    layer.confirm('真的删除行么', function (index) {
                        var index1 = 0;
                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{route('book.delete')}}",
                            data: {id: data.id},
                            dataType: 'json',
                            beforeSend: function () {
                                index1 = layer.load();
                            },
                            complete: function () {
                                layer.close(index1);
                            },
                            success: function (data) {
                                obj.del();
                                layer.close(index);
                            }
                        });

                    });
                } else if (obj.event === 'edit') {
                    //console.log(data);
                    window.location.href = data.editUrl;
                }
            });

            var $ = layui.$, active = {
                getCheckData: function () { //获取选中数据
                    var checkStatus = table.checkStatus('idTest')
                        , data = checkStatus.data;
                    layer.alert(JSON.stringify(data));
                }
                , getCheckLength: function () { //获取选中数目
                    var checkStatus = table.checkStatus('idTest')
                        , data = checkStatus.data;
                    layer.msg('选中了：' + data.length + ' 个');
                }
                , isAll: function () { //验证是否全选
                    var checkStatus = table.checkStatus('idTest');
                    layer.msg(checkStatus.isAll ? '全选' : '未全选')
                }
            };

            $('.demoTable .layui-btn').on('click', function () {
                var type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });
        });
    </script>
@endsection




