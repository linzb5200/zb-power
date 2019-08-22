@extends('home.member.layouts.default')

@section('style')
    <style>
        body{height: 100%;}
        .gray-bg {
            background-color: #f3f3f4;
        }
        .drafts-iframe{min-height: 555px;}
        .drafts-iframe .drafts-left{float: left;width:360px;height: 557px;overflow-y: scroll;}
        .drafts-iframe .drafts-right{float: right;width: 273px;height: 557px;overflow-y: scroll;position: relative;}
        .drafts-iframe .drafts-left .drafts-content{margin:15px;overflow: hidden;}
        .drafts-left::-webkit-scrollbar-corner, .drafts-left::-webkit-scrollbar-track, .drafts-right::-webkit-scrollbar-corner, .drafts-right::-webkit-scrollbar-track{
            background-color: #e2e2e2;
        }
        ::-webkit-scrollbar {
            width: 6px;
            background-color: #F5F5F5;
        }
    </style>
@endsection
@section('content')
    <div class="drafts-iframe gray-bg">
        <div class="drafts-left">
            <div class="drafts-content">

            </div>

        </div>
        <div class="drafts-right">
            <ul class="list-group">
                @foreach($items as $item)
                    <li class="list-group-item" data-id="{{$item['id']}}">
                        <time>{{$item['created_at']}}</time>
                        <span class="drafts-btn">
                           <button class="preview">预览</button>
                           <button class="insert">插入</button>
                           <button class="del">删除</button>
                       </span>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
@endsection
@section('script')

    <script>
        $(function () {
            $('.preview').on('click' , function() {
                var $self = $(this);
                var id = $self.closest('li').data('id');
                var success = function(json){
                    $('.drafts-content').html(json.data.content);
                };
                ajaxTo('/member/drafts/info',{id:id},success);
                return false;
            });
            $('.del').on('click' , function() {
                var $self = $(this);
                var id = $self.closest('li').data('id');
                var success = function(json){
                    if(json.status == 1){
                        $('.drafts-content').html('');
                        $('li[data-id='+id+']').remove();
                    }else if(json.status == -1){
                        layer.close(index);
                        layer.msg("登录超时，请重新登录",{time:1000,anim:6},function(){parent.window.float_login();})
                    }else{
                        layer.msg(json.msg, {icon: 5,anim: 6})
                    }
                };
                ajaxTo('/member/drafts/del',{id:id},success);
                return false;
            });
            $('.insert').on('click' , function() {
                var htmlObj = $('.drafts-content').html();
                parent.UE.getEditor('editor_content').setContent(htmlObj);
                return false;
            });

        });
    </script>
@endsection