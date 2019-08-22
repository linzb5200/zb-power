<style>

    .upload-container li img{
        width: 100%;
    }
    .upload-container li.img-item {
        position:relative;
        display:inline-block;
        vertical-align:top;
        margin-bottom:5px;
        width:95px;
        height:95px;
        margin-right:10px;
        border-radius:3px;
        border:1px solid #ddd;
    }

    .upload-container li.img-item i {
        position:absolute;
        cursor:pointer;
        bottom:0;
        font-size:16px;
        color:#fff;
        width:23px;
        height:23px;
        text-align:center;
        opacity:0.75;
        background-color:rgba(0,0,0,0.5);
        line-height:23px;
        font-style: normal;
    }
    .upload-container li.img-item i.fa-arrow-left {
        left:0
    }
    .upload-container li.img-item i.fa-search-plus {
        left:24px
    }
    .upload-container li.img-item i.fa-trash {
        left:48px;
        color:#ec0707
    }
    .upload-container li.img-item i.fa-arrow-right {
        right:0
    }
    .upload-container li.img-item i.tip {
        width: 100%;
        height: 22px;
        font-size: 12px;
        position: absolute;
        left: 0;
        top: 0;
        line-height: 22px;
        text-align: center;
        color: #fff;
        background-color: #333;
        opacity: 0.6;
    }
</style>
<script>
    layui.use(['upload'],function () {
        var $ = layui.jquery,upload = layui.upload;

        var uploadImage = function (pick,server,multiple) {
            var newClass = 'ly_' + Math.ceil(Math.random()*(10000 - 1));
            var $container = $(pick).closest('.layui-upload').find('.upload-container').addClass(newClass);
            $container = $('.' + newClass);

            upload.render({
                elem: pick
                ,url: server
                ,multiple: multiple
                ,data:{"_token":"{{ csrf_token() }}"}
                ,before: function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){
                        // $(box).html('<li><img src="'+result+'" /><p>上传中</p></li>')
                    });

                }
                ,done: function(response){
                    //如果上传失败
                    if(response.code == 0){
                        var html = '<li data-id="'+response.data.id+'" class="img-item">'
                            +     '<img src="'+response.data.path+'" />'
                            +     '<i class="tip">上传成功</i>'
                            +     '<i class="fa fa-arrow-left"></i>'
                            +     '<i class="fa fa-search-plus"></i>'
                            +     '<i class="fa fa-trash"></i>'
                            +     '<i class="fa fa-arrow-right"></i>'
                            +'</li>';
                        if(multiple == false){
                            $container.html(html);
                            $container.closest('.layui-upload').find('.img-id').val(response.data.id);
                        }else{
                            // 图片已存在，则不重复上传
                            if (imageIsExist($container, response.data.id)) {
                                layer.msg('图片已存在',{icon:6});
                                return false;
                            }

                            $container.append(html);
                            updateImageIds($container);
                        }
                        upload.render();
                        return layer.msg(response.msg,{icon:6});
                    }
                    return layer.msg(response.msg,{icon:5});
                }
            });

            // 左移动
            $container.on('click', '.fa-arrow-left', function () {
                var $cot = $(this).closest('.upload-container');
                var id = $(this).closest('.img-item').attr('data-id');
                var index = 1;
                $cot.find('.img-item').each(function () {
                    if ($(this).attr('data-id') == id) {
                        return false;
                    }
                    ++ index;
                });
                if (index <= 1) return false;

                $prev = $cot.find('.img-item').eq(index - 2);
                $curr = $cot.find('.img-item').eq(index - 1);

                swapImageItem($prev, $curr)
            });
            // 右移动
            $container.on('click', '.fa-arrow-right', function () {
                var $cot = $(this).closest('.upload-container');
                var id = $(this).closest('.img-item').attr('data-id');
                var index = 1;
                $cot.find('.img-item').each(function () {
                    if ($(this).attr('data-id') == id) {
                        return false;
                    }
                    ++ index;
                });
                if (index >= $('.img-item').length) return false;

                $curr = $cot.find('.img-item').eq(index - 1);
                $next = $cot.find('.img-item').eq(index);

                swapImageItem($curr, $next)
            });
            // 删除
            $container.on('click', '.fa-trash', function () {
                var $cot = $(this).closest('.upload-container');
                $(this).closest('.img-item').remove();
                updateImageIds($cot);
            });
            // 预览
            $container.on('click', '.fa-search-plus', function () {
                var obj = $(this).closest('.img-item').find('img');
                previewImg(obj);
            });

        };

        // 图片交换位置
        var swapImageItem = function($a, $b) {
            var id  = $a.attr('data-id');
            var src = $a.find('img').attr('src');

            $a.attr('data-id', $b.attr('data-id'));
            $a.find('img').attr('src', $b.find('img').attr('src'));

            $b.attr('data-id', id);
            $b.find('img').attr('src', src);

            updateImageIds($a.closest('.upload-container'));

        };
        //预览
        var previewImg = function (obj) {
            var imgHtml = "<img src='" + obj.attr('src') + "' style='width: 100%' />";
            //捕获页
            layer.open({
                type: 1,
                shade: 0.8,
                title: false, //不显示标题
                area: [600+'px', 480+'px'],
                content: imgHtml, //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                cancel: function () {
                    //layer.msg('捕获就是从页面已经存在的元素上，包裹layer的结构', { time: 5000, icon: 6 });
                }
            });
        };
        // 更新图片ids
        var updateImageIds = function($container) {
            var ids = [];
            $container.find('.img-item').each(function(i, item) {
                id = $(this).attr('data-id');
                ids.push(id);
            });
            $container.closest('.layui-upload').find('.img-id').val(ids.join(','));

        };
        // 图片是否存在
        var imageIsExist = function($container, id) {
            var ids = $container.closest('.layui-upload').find('.img-id').val();
            ids = ids ? ids.split(',') : [];
            if ($.inArray(''+id, ids) >= 0) {
                return true;
            }

            return false;
        };

        uploadImage('#uploadButton','{{ route("uploadImg") }}',false);
        uploadImage('#uploadButton1','{{ route("uploadImg") }}',true);

    });
</script>