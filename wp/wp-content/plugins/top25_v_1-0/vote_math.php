<?php
global $wpdb;

$votes_table=$wpdb->prefix."top25_votes";
$riders_table=$wpdb->prefix."top25_riders";

$votes_all=array();
$votes_db=$wpdb->get_results("SELECT * FROM $votes_table");
foreach ($votes_db as $v) {
	$date=strtotime($v->date);
	if ($date<=$vote_week_end && $date>=$vote_week_start) {
		$results=unserialize($v->results);
		array_push($votes_all,$results);
	}
}

$total_voters=count($votes_all);
$total_places=25;
$total_points=$total_voters*$total_places;
//echo $total_points."<br>";
//print_r($votes_all);
// remove any empty votes //
$votes_all_mod=array();
foreach ($votes_all as $va) {
	foreach ($va as $k=>$v) {
		if ($v["riderID"]==0) {
			unset($va[$k]);
		} else {
			// add points (26 - place) 25max 1min //
			$va[$k]["points"]=26-$v["place"];
		}
	}
	array_push($votes_all_mod,$va);
}
$votes_all_merge=array();
foreach ($votes_all_mod as $vam) {
	foreach ($vam as $i) {
		array_push($votes_all_merge,$i);
	}
}
$votes_points_arr=array();
foreach($votes_all_merge as $item) {
	$id=$item["riderID"];
	$points=$item["points"];
    if(!isset($votes_points_arr[$id])) {
        $votes_points_arr[$id] = array();
    }
    $votes_points_arr[$id][] = $points;
}
$vote_final=array();
foreach ($votes_points_arr as $k=>$vpr) {
	$points=0;
	foreach ($vpr as $pts) {
		$points=$points+$pts;
	}
	$perc=round($points/$total_points,3);
	$riders_db=$wpdb->get_results("SELECT name FROM $riders_table WHERE id='$k'");
	foreach ($riders_db as $rider) {
		$name=$rider->name;
	}
	$vote_final[$k]=array('name'=>$name,'points'=>$points,'perc'=>$perc);
}
?>