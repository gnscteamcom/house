<?php defined('IN_AIJIACMS') or exit('Access Denied');?><!--大话插件加载-->
<script type="text/javascript" src="<?php echo AJ_STATIC;?>file/script/jquery.js"></script>
<script type="text/javascript" src="static/dahua/jquery.SuperSlide.2.1.1.js"></script>
<!--大话插件加载end-->
<?php if($css) { ?><style type="text/css"><?php echo $css;?></style><?php } ?>
<link rel="stylesheet" rev="stylesheet" href="template/default/homepage/static/css/slick.css" type="text/css" />
<link rel="stylesheet" rev="stylesheet" href="template/default/homepage/static/css/ershou_web_broker_broker.css" type="text/css" />
<style media="screen">
.comrow{
    padding: 20px;
    border: 1px solid #ebebeb;
    overflow: hidden;
width: 1200px;
height: 260px;
margin: 0 auto;
border: none;
}
.left{
float: left;
width: 500px;
height: 100%;
padding: 20px;
}
.right{
float: right;
    width: 600px;
margin-top:20px;
}
.right p{
width: 100%;
font-size: 14px;
height: 30px;
line-height: 30px;
overflow: hidden;
margin:0px;
}
strong{
color: #666;
font-weight: bold;
}
.comrow-bot{
height: auto;
position: relative;
}
</style>
<div class="comrow">
<div class="left">
<img src="<?php echo $COM['thumb']?>" alt="" style="width:100%;height:100%">
</div>
<div class="right">
<h1><b style="font-size:20px"><?php echo $COM['company']?></b></h1>
<p><strong>电话：</strong><?php echo $COM['telephone']?></p>
<p><strong>地址：</strong><?php echo $COM['comaddress']?></p>
<p><strong>法人：</strong><?php echo $COM['owner']?></p>
<p><strong>邮箱：</strong><?php echo $COM['comemail']?></p>
<p><strong>注册时间：</strong><?php echo $COM['rigister_time']?></p>
<p><strong>注册资金：</strong><?php echo $COM['register_mon']?></p>
<p style="width:100%;height:auto"><strong>介绍：</strong><?php echo $COM['introduce']?></p>
</div>
</div>
<style media="screen">
.comrow-bot{
width: 1200px;
margin: 0 auto;
border: none;
padding: 20px;
}
.botli{
position: relative;
  width: 100%;
  height: 134px;
  cursor: pointer;
  padding: 23px 0 24px 7px;
  border-bottom: 1px dashed #999;
  background-color: #fff;
}
</style>
<div class="w1180">
    <div class="maincontent">
        <div class="list-content" id="list-content" style="width:100%">
        <div class="sortby clearfix"></div>
      <!-- 经纪人列表 start -->
<?php foreach($members as $member){?>
<div class="jjr-itemmod" link="<?php echo $MODULE['1']['linkurl'];?>index.php?homepage=<?php echo $COM['company'];?>&member=<?php echo $member['userid'];?>" _soj="esf_list_skfyfdgl" style="width:100%">
<a class="img" data-sign="true" target="_blank" href="<?php echo $MODULE['1']['linkurl'];?>index.php?homepage=<?php echo $COM['company'];?>&member=<?php echo $member['userid'];?>" _soj="esf_list_skfyfdgl" title="<?php echo $member['truename']?>" alt="<?php echo $member['truename']?>" hidefocus="true">
<img class="thumbnail" src="<?php echo $MODULE['1']['linkurl'];?>api/avatar/show.php?username=<?php echo $member['username']?>&size=large" alt="<?php echo $member['truename']?>" width="100" height="133"/>
</a>
<div class="jjr-info">
<div class="jjr-title">
<h3>
<a target="_blank" title="<?php echo $member['truename']?>" href="<?php echo $MODULE['1']['linkurl'];?>index.php?homepage=<?php echo $COM['company'];?>&member=<?php echo $member['userid'];?>" _soj="esf_list_skfyfdgl"><?php echo $member['truename']?></a>
</h3>
<div class="broker-level clearfix">
<span class="stars-title"></span>
<div class="stars-wrap-bk" style="width:90px">
<p class="stars-bg" style="width:90px"><i class="iconfont">&#xE108;</i><i class="iconfont">&#xE108;</i><i class="iconfont">&#xE108;</i><i class="iconfont">&#xE108;</i><i class="iconfont">&#xE108;</i></p>
<p class="stars-solid" style="width:90px"><i class="iconfont">&#xE108;</i><i class="iconfont">&#xE108;</i><i class="iconfont">&#xE108;</i><i class="iconfont">&#xE108;</i><i class="iconfont">&#xE108;</i></p>
</div>
<!-- 如果持平显示与同城平均水平持平 -->
</div>
<div class="brokercard-scorewrap clearfix">
<span class="brokercard-scoretitle"></span>
<div class="brokercard-scoredetail">
<div class="brokercard-sd-cont clearfix">
<!-- <span class="score-up clearfix no-pd-left" style="border-width:0;padding-left:0;">
<em>房源：</em><em class="score-num">100</em>
</span> -->
</div>
<div class="brokercard-sd-tip" style="bottom: 35px;">
<i class="arr-down"><i></i></i>
<div class="score-up"><span class="mg-r">房源真实：<em class="score-num">100</em><i class="score-tag"></i></span><span>打败了64.6%的同城经纪人</span>            </div>
<div class="score-up"><span class="mg-r">服务效率：<em class="score-num">100</em><i class="score-tag"></i></span><span>打败了59.7%的同城经纪人</span>            </div>
<div class="score-up"><span class="mg-r">用户评价：<em class="score-num">100</em><i class="score-tag"></i></span><span>打败了96.4%的同城经纪人</span>            </div>
</div>
</div>
</div>
 </div>
<p class="jjr-desc">
<span>电话：</span>
<!-- <div style="clear:both;display:inline-block;min-width:120px;"> -->
<?php echo $member['mobile'];?>
<!-- </div> -->
</p>
<p class="jjr-desc xq_tag"><span>地址：</span><?php echo $member['address'];?></p>
<div>
<div class="broker-tags clearfix">
<span><?php echo area_pos($member['areaid'], '');?></span>
<span class="pink-c">优质中介</span>
</div>
</div>
 </div>
</div>
<?}?>
    </div>
   </div>
  </div>
</body>
</html>
