<?php
$wpdb->show_errors();

$file=$_POST['file'];
$fq=$_POST['fq'];
$type=$_POST['type'];
$name=$_POST['name'];
$total=$_POST['total'];
//echo "$file | $fq | $type | $name<br />";
$races_table=$wpdb->prefix."top25_races";

// build results array //
$row=0;
$races_arr=array();
$handle = fopen($file, "r");
while (($data = fgetcsv($handle, 1024, ",")) !== FALSE) {
	$row++;
	if ($row==1) {
		$race_type=$data[7]; // race catergory (C1,C2, etc) //
		$date=$data[8]; // mm/dd/yy //
		$name=$data[9]; // race name //
		// convert date to mm/dd/yyyy //
		$date_arr=explode("/",$date);
		$date_arr[2]="20".$date_arr[2];
		$race_date=implode("/",$date_arr);
	} else {
		if (empty($data[5])) {
			$points=0;
		} else {
			$points=$data[5];
		}
		$data=array(
			'place'=>$data[0],
			'name'=>$data[1],
			'points'=>$points
		);
		array_push($races_arr,$data);
	} // end else //
} // end while loop //

$races_arr_s=serialize($races_arr);

$race_season=get_race_season($date);

$db_arr=array(
	'name' => $name,
	'type' => $type,
	'quality' => $fq,
	'total' => $total,
	'date' => $race_date,	
	'results' => $races_arr_s,
	'filename' => $file,
);
$sql = $wpdb->insert($races_table,$db_arr);

// upload to riders //
$riders_table=$wpdb->prefix."top25_riders";
$riders_arr=urldecode($_POST["riders_arr"]);
$riders_arr=unserialize($riders_arr);

// get all riders from db //
$riders_all=array();
$riders_db=$wpdb->get_results("SELECT * FROM $riders_table");
foreach ($riders_db as $rider) {
	array_push($riders_all,array('name'=>$rider->name,'id'=>$rider->id,'uci'=>$rider->uci,'wc'=>$rider->wc,'races'=>$rider->races,'year'=>$rider->year));
}

/*
echo "<pre>";
print_r($riders_all);
echo "</pre>";
*/

// add new riders to db //
$type=$db_arr["type"];
//print_r($riders_arr);
foreach ($riders_arr as $rider) {
	$flag=0;
	$id=0;
	$current_rider=$rider["name"];
	$arr=array();
	//echo $rider;
	
	foreach ($riders_all as $r) {
		if ($current_rider==$r["name"] && $race_season==$r["year"]) {
			$flag=1;
			$id=$r["id"];
			$uci=$r["uci"];
			$wc=$r["wc"];
			$races=$r["races"];
			if (isset($r["total"])) {
				$total=$r["total"];
			} else {
				$total=0;
			}
		}
	}
	if ($flag==1) {
		$uci=$uci+$rider["points"];
		if ($type=="CDM") {
			$wc=$wc+$rider["points"];
		}
		$races=$races+1;
		$total=$wc+$uci;

		$arr=array('uci'=>$uci,'wc'=>$wc,'races'=>$races,'total'=>$total);
		$rider_sql = $wpdb->update($riders_table,$arr,array('id'=>$id));
	} else {
		if ($type=="CDM") {
			$wc=$rider["points"];
		} else {
			$wc=0;
		}
		$arr=array('name'=>$current_rider,'uci'=>$rider["points"],'wc'=>$wc,'races'=>1,'total'=>$rider["points"]);
		$rider_sql2 = $wpdb->insert($riders_table,$arr);
	}
}

function get_race_season($date) {
	global $wpdb;
	$season_id=0;
	
	$seasons=$wpdb->get_results("SELECT id,start,end FROM ".TOP25_SEASONS_TABLE);
	
	foreach ($seasons as $season) :
		$start=strtotime($season->start);
		$end=strtotime($season->end);
		$race_date=strtotime($date);
		
		if ($race_date>=$start && $race_date<=$end) :
			$season_id=$season->id;
			return $season_id;
		endif;
	endforeach;
	
	return $season_id;
}
?>
<div class="upload-text">
	Upload was successful.<br/>
	<b><a href="admin.php?page=top25-week">Continue</a></b>
</div>