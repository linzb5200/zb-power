/**

 @Name: 个人信息

 */
 
layui.define('fly', function(exports){

  var $ = layui.jquery;
  var layer = layui.layer;
  var form = layui.form;
  var fly = layui.fly;
  
  var dom = {
    repass: $('#F_repass')
    ,mine: $('#F_mine')
  };

    var prof = {
    //修改密码
    repass: function(div){
        fly.json('/api/jie-delete/', {
            id: div.data('id')
        }, function(res){
            if(res.status === 0){
                location.href = '/jie/';
            } else {
                layer.msg(res.msg);
            }
        });
    }
    
    //设置置顶、状态
    ,set: function(div){
      var othis = $(this);
      fly.json('/api/jie-set/', {
        id: div.data('id')
        ,rank: othis.attr('rank')
        ,field: othis.attr('field')
      }, function(res){
        if(res.status === 0){
          location.reload();
        }
      });
    }

    //收藏
    ,collect: function(div){
      var othis = $(this), type = othis.data('type');
      fly.json('/collection/'+ type +'/', {
        cid: div.data('id')
      }, function(res){
        if(type === 'add'){
          othis.data('type', 'remove').html('取消收藏').addClass('layui-btn-danger');
        } else if(type === 'remove'){
          othis.data('type', 'add').html('收藏').removeClass('layui-btn-danger');
        }
      });
    }
  };

  $('body').on('click', '.jie-admin', function(){
    var othis = $(this), type = othis.attr('type');
    gather.jieAdmin[type] && gather.jieAdmin[type].call(this, othis.parent());
  });



  exports('profile', null);
});