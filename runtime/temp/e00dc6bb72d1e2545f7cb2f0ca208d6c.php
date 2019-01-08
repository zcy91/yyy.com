<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\user\ajaxnotice.html";i:1528689238;}*/ ?>

<!--内容主体-->
<div class="m-questions" id="comList" style="padding-top:0;padding-bottom: 0">
    <ul style="padding-top: 0;">
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
        <li ">
        <a href="<?php echo url('/index/user/notice_detail',array('id'=>$vo['id'])); ?>" style="white-space: nowrap;display: block;overflow: hidden;text-overflow: ellipsis;width: 100%;"><?php echo $k+($p-1)*$page_count; ?>、<?php echo $vo['content']; ?></a>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <?php if(($count > $current_count) AND (count($list) == $page_count)): ?>
    <div class="getmore" style="font-size:.32rem;text-align:center;color:#888;padding:.25rem .24rem .4rem; clear:both">
        <a href="javascript:void(0)" onClick="ajaxSourchSubmit();">点击加载更多</a>
    </div>
    <?php elseif(($count <= $current_count AND $count > 0)): ?>
    <div class="score enkecor" style="font-size:.32rem;text-align:center;color:#888;padding:.25rem .24rem .4rem; clear:both">已显示完所有内容</div>
    <?php else: endif; ?>
</div>
<!--内容主体结束-->
<script>
    if(<?php echo $p; ?>){
        var page = <?php echo $p; ?>;
    }else{
        var page = 1 ;
    }

    function ajaxSourchSubmit() {
        page += 1;
        $.ajax({
            type: "GET",
            url: "<?php echo url('index/user/ajaxnotice'); ?>"+"&p=" + page,
            success: function (data) {
                $('.getmore').hide();
                if ($.trim(data) != ''){
                    $("#comList").append(data);
                }
            }
        });
    }
    function  ajax_sourch_submit_hide(){
        $('.getmore').hide();
    }
</script>
</body>
</html>