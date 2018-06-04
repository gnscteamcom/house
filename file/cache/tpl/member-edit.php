<?php defined('IN_AIJIACMS') or exit('Access Denied');?><?php include template('header',$module);?>
<?php echo load('profile.js');?>
<div class="tinfo">
<?php if($is_company && !$_edittime) { ?>
<div class="warn">贵公司尚未完善详细资料！完善的商业信息有助于获得别人的信任，结交潜在的商业伙伴，获取商业机会，请尽快完善</div>
<?php } ?>
<?php if(isset($success)) { ?>
<div class="ok">资料保存成功，您可以：<a href="edit.php" class="t">继续完善</a> &nbsp;|&nbsp; <a href="<?php echo $AJ['file_my'];?>" class="t">发布信息</a> &nbsp;|&nbsp; <a href="./" class="t">返回会员中心首页</a></div>
<?php } ?>
<div class="menu">
<table cellpadding="0" cellspacing="0">
<tr>
<td class="tab" id="Tab0"><a href="javascript:Tab(0);"><span>个人资料</span></a></td>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="Tab1"><a href="javascript:Tab(1);"><span>密码管理</span></a></td>
<?php if($is_company) { ?>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="Tab2"><a href="javascript:Tab(2);"><span>公司资料</span></a></td>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="Tab3"><a href="javascript:Tab(3);"><span>公司联系方式</span></a></td>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="Tab4"><a href="javascript:Tab(4);"><span>公司介绍</span></a></td>
<?php } ?>
</tr>
</table>
</div>
<form method="post" action="edit.php" onsubmit="return Dcheck();" id="dform">
<input type="hidden" name="tab" id="tab" value="<?php echo $tab;?>"/>
<table cellpadding="6" cellspacing="1" class="tb">
<tbody id="Tabs0" style="display:;">
<tr>
<td class="tl">会员名</td>
<td class="tr f_b"><?php echo $_username;?></td>
</tr>
<tr>
<td class="tl">Email</td>
<td class="tr"><?php echo $_email;?><?php if($vemail) { ?>&nbsp;&nbsp;<img src="<?php echo AJ_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/v_email.gif" title="已认证" align="absmiddle"/><?php } ?>
<?php if($AJ['mail_type'] != 'close') { ?>&nbsp;&nbsp;<a href="send.php?action=email" class="t">[修改]</a><?php } ?>
</td>
</tr>
<?php if($vtruename) { ?>
<tr>
<td class="tl"><span class="f_red">*</span>真实姓名</td>
<td class="tr"><input type="hidden" name="post[truename]" id="truename" value="<?php echo $truename;?>"/><?php echo $truename;?>&nbsp;&nbsp;<img src="<?php echo AJ_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/v_truename.gif" title="已认证" align="absmiddle"/></td>
</tr>
<?php } else { ?>
<tr>
<td class="tl"><span class="f_red">*</span>真实姓名</td>
<td class="tr"><input type="text" size="10" name="post[truename]" id="truename" value="<?php echo $truename;?>"/>&nbsp;<span id="dtruename" class="f_red"></span></td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_red">*</span>性别</td>
<td class="tr">
<input type="radio" name="post[gender]" value="1" <?php if($gender==1) { ?>checked="checked"<?php } ?>
/> 先生
<input type="radio" name="post[gender]" value="2" <?php if($gender==2) { ?>checked="checked"<?php } ?>
/> 女士
</td>
</tr>
<?php if(!$is_company) { ?>
<tr>
<td class="tl"><span class="f_red">*</span>所在地区</td>
<td class="tr"><?php echo ajax_area_select('post[areaid]', '请选择', $areaid);?>&nbsp;<span id="dareaid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">联系地址</td>
<td class="tr"><input type="text" size="40" name="post[address]" id="daddress" value="<?php echo $address;?>"/>&nbsp;<span id="ddaddress" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">邮政编码</td>
<td class="tr"><input type="text" size="8" name="post[postcode]" id="postalcode" value="<?php echo $postcode;?>"/></td>
</tr>
<tr>
<td class="tl">联系电话</td>
<td class="tr"><input type="text" size="20" name="post[telephone]" id="telephone" value="<?php echo $telephone;?>"/>&nbsp;<span id="dtelephone" class="f_red"></span></td>
</tr>
<?php } ?>
<?php if($vmobile) { ?>
<tr>
<td class="tl">手机号码</td>
<td class="tr"><input type="hidden" name="post[mobile]" id="mobile" value="<?php echo $mobile;?>"/><?php echo $mobile;?>&nbsp;&nbsp;<img src="<?php echo AJ_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/v_mobile.gif" title="已认证" align="absmiddle"/><?php if($AJ['sms']) { ?>&nbsp;&nbsp;<a href="send.php?action=mobile" class="t">[修改]</a><?php } ?>
</td>
</tr>
<?php } else { ?>
<tr>
<td class="tl">手机号码</td>
<td class="tr"><input type="text" size="20" name="post[mobile]" id="mobile" value="<?php echo $mobile;?>"/></td>
</tr>
<?php } ?>
<tr>
<td class="tl">部门</td>
<td class="tr"><input type="text" size="20" name="post[department]" id="department" value="<?php echo $department;?>"/></td>
</tr>
<tr>
<td class="tl">职位</td>
<td class="tr"><input type="text" size="20" name="post[career]" id="career" value="<?php echo $career;?>"/></td>
</tr>
<?php if($AJ['im_qq']) { ?>
<tr>
<td class="tl">QQ</td>
<td class="tr"><input type="text" size="20" name="post[qq]" id="qq" value="<?php echo $qq;?>"/></td>
</tr>
<?php } ?>
<?php if($AJ['im_ali']) { ?>
<tr>
<td class="tl">阿里旺旺</td>
<td class="tr"><input type="text" size="20" name="post[ali]" id="ali" value="<?php echo $ali;?>"/></td>
</tr>
<?php } ?>
<tr>
<td class="tl">站内信提示音</td>
<td class="tr">
<div id="audition"></div>
<input type="radio" name="post[sound]" value="0" <?php if($sound==0) { ?>checked="checked"<?php } ?>
 id="sound_0"/><label for="sound_0"> 无</label>&nbsp;&nbsp;
<input type="radio" name="post[sound]" value="1" <?php if($sound==1) { ?>checked="checked"<?php } ?>
 id="sound_1"/> <a href="javascript:Inner('audition', sound('message_1'));Dd('sound_1').checked=true;void(0);" title="点击试听">提示音1</a>&nbsp;&nbsp;
<input type="radio" name="post[sound]" value="2" <?php if($sound==2) { ?>checked="checked"<?php } ?>
 id="sound_2"/> <a href="javascript:Inner('audition', sound('message_2'));Dd('sound_2').checked=true;void(0);" title="点击试听">提示音2</a>&nbsp;&nbsp;
<input type="radio" name="post[sound]" value="3" <?php if($sound==3) { ?>checked="checked"<?php } ?>
 id="sound_3"/> <a href="javascript:Inner('audition', sound('message_3'));Dd('sound_3').checked=true;void(0);" title="点击试听">提示音3</a>&nbsp;&nbsp;
</td>
</tr>
<?php if($MFD) { ?><?php echo fields_html('<td class="tl">', '<td class="tr">', $user, $MFD);?><?php } ?>
</tbody>
<tbody id="Tabs1" style="display:none;">
<tr>
<td class="tl">新登录密码</td>
<td class="tr"><input type="password" size="20" name="post[password]" id="password" onblur="validator('password');" autocomplete="off"/>&nbsp;<span class="f_gray">如不更改密码,请留空</span> <span id="dpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">重复新密码</td>
<td class="tr"><input type="password" size="20" name="post[cpassword]" id="cpassword" autocomplete="off"/>&nbsp;<span id="dcpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">现有密码</td>
<td class="tr f_red"><input type="password" size="20" name="post[oldpassword]" id="oldpassword" autocomplete="off"/>&nbsp; 如要更改密码，需输入现有密码 <span id="doldpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">新支付密码</td>
<td class="tr"><input type="password" size="20" name="post[payword]" id="payword" onblur="validator('payword');" autocomplete="off"/>&nbsp;<span class="f_gray">如不更改支付密码，请留空</span> <span id="dpayword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">重复新支付密码</td>
<td class="tr"><input type="password" size="20" name="post[cpayword]" id="cpayword" autocomplete="off"/>&nbsp;<span id="dcpayword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">现有支付密码</td>
<td class="tr f_red"><input type="password" size="20" name="post[oldpayword]" id="oldpayword" autocomplete="off"/>&nbsp; 支付密码默认和注册设置密码相同&nbsp;&nbsp;<a href="send.php?action=payword"  class="t">找回支付密码</a><span id="doldpayword" class="f_red"></span></td>
</tr>
</tbody>
<?php if($is_company) { ?>
<tbody id="Tabs2" style="display:none;">
<tr onmouseover="Ds('tcompany');" onmouseout="Dh('tcompany');">
<td class="tl">公司名称 <span class="f_red">*</span></td>
<td width="300">
<input type="hidden" id="userid" name="post[companyid]" value="<?php echo $userid;?>" >
<input type="text" class="reg_inp" style="width:280px;" name="post[company]" value="<?php echo $_company;?>" id="company" onblur="validator('company');"/></td>

</tr>
<tr>
<td class="tl">形象图片</td>
<td class="tr"><input name="post[thumb]" type="text" size="60" id="thumb" value="<?php echo $thumb;?>" readonly/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value, true);" class="jt">[上传]</span>&nbsp;&nbsp;<span onclick="_preview(Dd('thumb').value);" class="jt">[预览]</span>&nbsp;&nbsp;<span onclick="Dd('thumb').value='';" class="jt">[删除]</span><br/>
<span class="f_gray">建议使用LOGO、办公环境等标志性图片，最佳大小为<?php echo $MOD['thumb_width'];?>px*<?php echo $MOD['thumb_height'];?>px</span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span>所在地区</td>
<td class="tr"><?php echo ajax_area_select('post[areaid]', '请选择', $areaid);?>&nbsp;<span id="dareaid" class="f_red"></span></td>
</tr>
<?php if($CFD) { ?><?php echo fields_html('<td class="tl">', '<td class="tr">', $user, $CFD);?><?php } ?>
</tbody>
<tbody id="Tabs3" style="display:none;">
<tr>
<td class="tl"><span class="f_red">*</span>公司地址</td>
<td class="tr"><input type="text" size="60" name="post[address]" id="daddress" value="<?php echo $address;?>" maxlength="200"/>&nbsp;<span id="ddaddress" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">邮政编码</td>
<td class="tr"><input type="text" size="8" name="post[postcode]" id="postalcode" value="<?php echo $postcode;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span>公司电话</td>
<td class="tr"><input type="text" size="20" name="post[telephone]" id="telephone" value="<?php echo $telephone;?>"/>&nbsp;<span id="dtelephone" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">公司传真</td>
<td class="tr"><input type="text" size="20" name="post[fax]" id="fax" value="<?php echo $fax;?>"/></td>
</tr>
<tr>
<td class="tl">公司Email</td>
<td class="tr"><input type="text" size="30" name="post[mail]" id="mail" value="<?php echo $mail;?>"/> <span class="f_gray">[公开]</span></td>
</tr>
<tr>
<td class="tl">公司网址</td>
<td class="tr"><input type="text" size="30" name="post[homepage]" id="homepage" value="<?php echo $homepage;?>"/></td>
</tr>
</tbody>
<tbody id="Tabs4" style="display:none;">
<tr>
<td class="tl"><span class="f_red">*</span>公司介绍</td>
<td class="tr"><textarea name="post[introduce]" id="introduce" class="dsn"><?php echo $introduce;?></textarea>
<?php echo deditor($moduleid, 'introduce', $group_editor, '95%', 300);?><br/><span id="dintroduce" class="f_red"></span></td>
</tr>
</tbody>
<?php } ?>
<tr>
<td class="tl">&nbsp;</td>
<td class="tr" height="30"><input type="submit" name="submit" value=" 保 存 " class="sBtn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value=" 返 回 " class="sBtn" onclick="history.back(-1);"/></td>
</tr>
</table>
</form>
<?php echo load('clear.js');?>
<script type="text/javascript">
var vid = '';
function validator(id) {
if(!Dd(id).value) return false;
vid = id;
makeRequest('moduleid=<?php echo $moduleid;?>&action=member&job='+id+'&value='+Dd(id).value+'&userid=<?php echo $userid;?>', AJPath, '_validator');
}
function _validator() {
if(xmlHttp.readyState==4 && xmlHttp.status==200) {
Dd('d'+vid).innerHTML = xmlHttp.responseText ? xmlHttp.responseText : '';
}
}
function Dcheck() {
if(Dd('truename').value == '') {
Tab(0);
Dmsg('请填写真实姓名', 'truename');
return false;
}
if(Dd('password').value != '') {
if(Dd('cpassword').value == '') {
Tab(1);
Dmsg('请重复输入密码', 'cpassword');
return false;
}
if(Dd('password').value != Dd('cpassword').value) {
Tab(1);
Dmsg('两次输入的密码不一致', 'password');
return false;
}
if(Dd('oldpassword').value == '') {
Tab(1);
Dmsg('请输入密码', 'oldpassword');
return false;
}
}
if(Dd('payword').value != '') {
if(Dd('cpayword').value == '') {
Tab(1);
Dmsg('请重复输入支付密码', 'cpayword');
return false;
}
if(Dd('payword').value != Dd('cpayword').value) {
Tab(1);
Dmsg('两次输入的支付密码不一致', 'payword');
return false;
}
if(Dd('oldpayword').value == '') {
Tab(1);
Dmsg('请输入支付密码', 'oldpayword');
return false;
}
}
<?php if(!$is_company) { ?>
if(Dd('areaid_1').value == 0) {
Tab(0);
Dmsg('请选择所在地', 'areaid');
return false;
}
<?php } ?>
<?php if($MFD) { ?><?php echo fields_js($MFD);?><?php } ?>
<?php if($is_company) { ?>
<?php if($CFD) { ?><?php echo fields_js($CFD);?><?php } ?>

if(Dd('areaid_1').value == 0) {
Tab(2);
Dmsg('请选择公司所在地', 'areaid');
return false;
}
if(Dd('daddress').value.length < 5) {
Tab(3);
Dmsg('请填写公司地址', 'daddress');
return false;
}
if(Dd('telephone').value.length < 6) {
Tab(3);
Dmsg('请填写公司电话', 'telephone');
return false;
}
if(FCKLen('introduce') < 10) {
Tab(4);
Dmsg('公司介绍不能少于10字，当前已经输入'+FCKLen('introduce')+'字', 'introduce');
return false;
}
<?php } ?>
return true;
}
</script>
<script type="text/javascript">
s('edit');
<?php if($tab) { ?>
Tab(<?php echo $tab;?>);
<?php } else { ?>
m('Tab0');
<?php } ?>
</script>
</div></div></div>