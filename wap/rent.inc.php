<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
$table = $AJ_PRE.$module.'_'.$moduleid;
$table_data = $AJ_PRE.$module.'_data_'.$moduleid;
$OAUTH = cache_read('oauth.php');
$qqid=$OAUTH['qq']['id'];
$sinaid=$OAUTH['sina']['id'];
$enable=$OAUTH['qq']['enable'];
if($cityid) {
	$areaid = $cityid;
	$ARE = $AREA[$cityid];
	//$condition .= $ARE['child'] ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
	}
if($itemid) {
	$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid");
	($item && $item['status'] > 2) or wap_msg($L['msg_not_exist']);
	extract($item);
	$CAT = get_cat($catid);
	if(!check_group($_groupid, $MOD['group_show']) || !check_group($_groupid, $CAT['group_show'])) wap_msg($L['msg_no_right']);
	$member = array();
	$fee = get_fee($item['fee'], $MOD['fee_view']);
	require $action == 'pay' ? 'pay.inc.php' : 'contact.inc.php';
	$content_table = content_table($moduleid, $itemid, $MOD['split'], $table_data);
	$content = $db->get_one("SELECT content FROM {$content_table} WHERE itemid=$itemid");
	$content = $content['content'];
	if($TP == 'touch') {
		$head_link = 'index.php?moduleid='.$moduleid.'&amp;catid='.$catid;
		$head_name = $MOD['name'].'详情';
		$back_link = 'javascript:Dback(\''.$head_link.'\');';
		$pages = '';
	} else {
		$content = strip_tags($content);
		$content = preg_replace("/\&([^;]+);/i", '', $content);
		$contentlength = strlen($content);
		if($contentlength > $maxlength) {
			$start = ($page-1)*$maxlength;
			$content = dsubstr($content, $maxlength, '', $start);
			$pages = wap_pages($contentlength, $page, $maxlength);
		}
		$content = nl2br($content);
	}
	$editdate = timetodate($edittime, 5);
	$update = '';
	include AJ_ROOT.'/include/update.inc.php';
	$head_title = $title.$AJ['seo_delimiter'].$MOD['name'].$AJ['seo_delimiter'].$head_title;
} else {
	if($kw) {
		check_group($_groupid, $MOD['group_search']) or wap_msg($L['msg_no_search']);
	} else if($catid) {
		$CAT or wap_msg($L['msg_not_cate']);
		if(!check_group($_groupid, $MOD['group_list']) || !check_group($_groupid, $CAT['group_list'])) {
			wap_msg($L['msg_no_right']);
		}
	} else {
		check_group($_groupid, $MOD['group_index']) or wap_msg($L['msg_no_right']);
	}
	$head_title = $MOD['name'].$AJ['seo_delimiter'].$head_title;
	if($kw) $head_title = $kw.$AJ['seo_delimiter'].$head_title;
	$condition = "status=3";
	if($keyword) $condition .= " AND keyword LIKE '%$keyword%'";
	if($catid) $condition .= $CAT ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";
	if($areaid) $condition .= $ARE['child'] ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
	if($h) $condition.=" and `room`=$h";
	if($typeid) $condition.=" and `typeid`=$typeid";
	if(!empty($c))
	{
		$lst.= "-c".$area;
		if($c==1)
		{   $condition.=' AND houseearm<40';
			$area_name="40平米以下";
		}
		elseif($c==2)
		{   $condition.=" AND houseearm>40  AND houseearm<60";
			$area_name="40-60平米";
		}
		elseif($c==3)
		{   $condition.=' AND 60<=houseearm AND houseearm<80';
			$area_name="60-80平米";
		}
		elseif($c==4)
		{   $condition.=' AND 80<=houseearm AND houseearm<100';
			$area_name="80-100平米";
		}
		elseif($c==5)
		{	$condition.=' AND 100<=houseearm AND houseearm<120';
			$area_name="100-120平米";
		}
		elseif($c==6)
		{   $condition.=' AND 120<=houseearm AND houseearm<150';
			$area_name="120-150平米";
		}
		elseif($c==7)
		{   $condition.=' AND 150<=houseearm';
			$area_name="150平米以上";
		}
	
	}
	if(!empty($p))
	{
		$lst.= "-p".$range;
		$mix=mixprice($p,'range','rent_7');
		$max=maxprice($p,'range','rent_7');
		if($mix){$mix=$mix;}
		else
		{$mix=0;}
		if($max){$condition.=" and $mix<=price AND price<$max ";}
		else
		{$condition.=" and $mix <= price ";}
		$range_arr = getbox_name('range','rent_7');
		$range_name=$range_arr[$p];
		$lstaddr.= "<em>".$range_name."<a href=\"list".deal_str($lst,'p').".html\"></a></em>";
	}
	
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition", 'CACHE');
	$items = $r['num'];
	$pages = wap_pages($items, $page, $pagesize);
	$lists = array();
	if($items) {
		$order = $MOD['order'];
		$time = strpos($MOD['order'], 'add') !== false ? 'addtime' : 'edittime';
		$result = $db->query("SELECT ".$MOD['fields']." FROM {$table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['stitle'] = dsubstr($r['title'], $len);
			$r['date'] = timetodate($r[$time], 5);
			$lists[] = $r;
		}
		$db->free_result($result);
	}
	if($TP == 'touch') {
		if($catid) {
			$head_link = 'index.php?moduleid='.$moduleid;
			$head_name = $MOD['name'];
			$back_link = $CAT['parentid'] ? 'index.php?moduleid='.$moduleid.'&amp;catid='.$CAT['parentid'] : 'index.php?moduleid='.$moduleid;
		} else {
			$head_link = 'index.php?moduleid='.$moduleid;
			$head_name = $MOD['name'];
			$back_link = 'index.php';
		}
	}
}
include template($module, $TP);
?>