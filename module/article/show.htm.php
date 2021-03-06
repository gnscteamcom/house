<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
if(!$MOD['show_html'] || !$itemid) return false;
$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid");
if(!$item || $item['status'] < 3 || $item['islink'] > 0) return false;
extract($item);
$CAT = get_cat($catid);
$content_table = content_table($moduleid, $itemid, $MOD['split'], $table_data);
$t = $db->get_one("SELECT content FROM {$content_table} WHERE itemid=$itemid");
$content = $t['content'];
if($lazy) $content = img_lazy($content);

$CP = $MOD['cat_property'] && $CAT['property'];
if($CP) {
	require_once AJ_ROOT.'/include/property.func.php';
	$options = property_option($catid);
	$values = property_value($moduleid, $itemid);
}

$adddate = timetodate($addtime, 3);
$editdate = timetodate($edittime, 3);
if($voteid) $voteid = explode(' ', $voteid);
if($fromurl) $fromurl = fix_link($fromurl);
$fileurl = $linkurl;
$linkurl = $MOD['linkurl'].$linkurl;
$titles = array();
if($subtitle) {
	$titles = explode("\n", $subtitle);
	$titles = array_map('trim', $titles);
}
$keytags = $tag ? explode(' ', $tag) : array();
$fee = get_fee($item['fee'], $MOD['fee_view']);
if($fee) {
	$description = get_description($content, $MOD['pre_view']);
	$user_status = 4;
} else {
	$user_status = 3;
}
$pages = '';
$total = 1;
$subtitles = count($titles);
if(strpos($content, '[pagebreak]') !== false) {
	$contents = explode('[pagebreak]', $content);
	$total = count($contents);
	if($total < $subtitles) $subtitles = $total;
}
$seo_file = 'show';
include AJ_ROOT.'/include/seo.inc.php';
$template = 'show';
if($MOD['template_show']) $template = $MOD['template_show'];
if($CAT['show_template']) $template = $CAT['show_template'];
if($item['template']) $template = $item['template'];
for(; $page <= $total; $page++) {
	$subtitle = isset($titles[$page-1]) ? $titles[$page-1] : '';
	if($subtitle) $seo_title = $subtitle.$seo_delimiter.$seo_title;
	$aijiacms_task = "moduleid=$moduleid&html=show&itemid=$itemid&page=$page";
	if($EXT['wap_enable']) $head_mobile = $EXT['wap_url'].'index.php?moduleid='.$moduleid.'&itemid='.$itemid.($page > 1 ? '&page='.$page : '');
	$filename = $total == 1 ? AJ_ROOT.'/'.$MOD['moduledir'].'/'.$fileurl : AJ_ROOT.'/'.$MOD['moduledir'].'/'.itemurl($item, $page);
	if($total > 1) {
		$pages = showpages($item, $total, $page);
		$content = $contents[$page-1];
	}
	if($MOD['keylink']) $content = keylink($content, $moduleid);
	ob_start();
	include template($template, $module);
	$data = ob_get_contents();
	ob_clean();
	if($AJ['pcharset']) $filename = convert($filename, AJ_CHARSET, $AJ['pcharset']);
	file_put($filename, $data);
	if($page == 1 && $total > 1) {
		$indexname = AJ_ROOT.'/'.$MOD['moduledir'].'/'.itemurl($item, 0);
		if($AJ['pcharset']) $indexname = convert($indexname, AJ_CHARSET, $AJ['pcharset']);
		file_copy($filename, $indexname);
	}
}
return true;
?>