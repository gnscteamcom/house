<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
require AJ_ROOT.'/module/'.$module.'/common.inc.php';
if($MOD['index_html']) {	
	$html_file = AJ_ROOT.'/'.$MOD['moduledir'].'/'.$AJ['index'].'.'.$AJ['file_ext'];
	if(!is_file($html_file)) tohtml('index', $module);
	if(is_file($html_file)) exit(include($html_file));
}
if(!check_group($_groupid, $MOD['group_index'])) include load('403.inc');
$maincat = $childcat = get_maincat(0, $moduleid, 1);
$seo_file = 'index';
include AJ_ROOT.'/include/seo.inc.php';
$aijiacms_task = "moduleid=$moduleid&html=index";
if($EXT['wap_enable']) $head_mobile = $EXT['wap_url'].'index.php?moduleid='.$moduleid.($page > 1 ? '&page='.$page : '');
include template($MOD['template_index'] ? $MOD['template_index'] : 'index', $module);
?>