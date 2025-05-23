@extends('admin.public.layout')

@section('style')
@endsection


@section('content')
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">前端设置</div>
                    <div class="layui-card-body">
                        <form class="layui-form" id="form1" onsubmit="return false" action="##" method="post">
                            {{ csrf_field() }}
                            <div class="layui-form-item">
                                <label class="layui-form-label">列表条数</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="page_number" value="{{ $data['page_number'] }}" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">每页显示的条数</div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">搜索类型</label>
                                <div class="layui-input-inline">
                                    <input type="checkbox" name="search_type" lay-text="是|否" @if ($data['search_type']=='1') checked @endif lay-skin="switch">
                                </div>
                                <div class="layui-form-mid layui-word-aux">搜索文件的时候，是否显示加密的文件</div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">音乐播放</label>
                                <div class="layui-input-inline">
                                    <input type="checkbox" name="is_music" lay-text="开启|关闭" @if ($data['is_music']=='1') checked @endif lay-skin="switch">
                                </div>
                                <div class="layui-form-mid layui-word-aux">是否开启前端音乐播放模块</div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">背景图</label>
                                <div class="layui-input-inline" style="width: 330px;">
                                    <input type="text" name="web_site_background" value="{{ $data['web_site_background'] }}" id="web_site_background" class="layui-input">
                                    <img class="layui-upload-img" id="upload-normal-img" style="width: 200px;height: 160px;" src="{{ $data['web_site_background'] }}">
                                    <button type="button" class="layui-btn" id="upload">
                                        <i class="layui-icon">&#xe67c;</i>上传图片
                                    </button>
                                </div>
                                <div class="layui-form-mid layui-word-aux">前端的背景图</div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <div class="layui-footer">
                                        <button id="form-submit" class="layui-btn">保存</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        layui.use(['form', 'layer', 'upload'], function(){
            var $ = layui.$; //重点处
            var form = layui.form;
            var upload = layui.upload;
            upload.render({
                elem: '#upload'
                ,url: './upload'
                ,data: {
                    '_token': "{{ csrf_token() }}"
                }
                ,done: function(res, index, upload){
                    console.log(res)
                    if(res.code == 0){
                        $("#web_site_background").val(res.data.src);
                        $("#upload-normal-img").attr("src", res.data.src);
                    }
                }
                ,accept: 'images'
                ,acceptMime: 'image/*'
            });

            // 确认按钮
            $('#form-submit').on('click', function () {
                $.ajax({
                    url: "./front"
                    ,type: "POST"
                    ,dataType: "json"
                    ,data: $('#form1').serialize()
                    ,success: function (data) {
                        if(!data.code){
                            layer.msg(data.msg, {
                                icon: 1
                                ,shade: 0.3
                                ,shadeClose: false
                                ,time: 1000 //2秒关闭（如果不配置，默认是3秒）
                            }, function(){
                                location.reload();  // 刷新当前页
                            });
                        }else{
                            layer.msg(data.msg)
                        }
                    }
                });

            });
        });
    </script>
@endsection