<?php
// various functions used in form //
function generate_weeks() {
	$week=1;
	while ($week<=15) {
		echo '<option value="'.$week.'">'.$week.'</option>';
		$week++;
	}
}
function generate_seasons() {
	global $wpdb;

	$table_name=$wpdb->prefix."top25_seasons";
	$seasons_db=$wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC");
	foreach ($seasons_db as $s) {
		echo '<option value="'.$s->season.'">'.$s->season.'</option>';
	}
}

// begin primary function //
function top25_week() {
	global $wpdb;
	$wpdb->show_errors();
	
	$races_table=$wpdb->prefix."top25_races";
	$riders_table=$wpdb->prefix."top25_riders";
	$rank_table=$wpdb->prefix."top25_rank";
	
	$data_arr=urldecode($_POST["data"]);
	//$data_arr=unserialize($data_arr);
	
	if (isset($_POST["add-rank"]) && $_POST["add-rank"]=="y") {
		$arr=array(
			//'data'=>stripslashes($_POST["data"]),
			'data'=>$data_arr,
			//'data'=>$_POST["data"],
			'week'=>$_POST["week"],
			'season'=>$_POST["season"],
		);
		$sql = $wpdb->insert($rank_table,$arr);
		?>
		<div class="upload-text">
			<?php if ($sql) { ?>
				Data was entered into database.
			<?php } else { ?>
			There was an error.<br />
			<a href="javascript:history.go(-1);">Go Back</a>	
			<?php } ?>
		</div>
		<?php
		exit;
	}
	
	$season_start="08-09-2012";
	$season_end="25-02-2013";
	$week_start=strtotime($season_start);
	$week_end=strtotime($season_end);

	$vote_week_start=null;
	$vote_week_end=null;
	$vote_week_start_disp=null;
	$vote_week_end_disp=null;
	if (isset($_POST["submit-weeks"]) && $_POST["submit-weeks"]=="Set Weeks") {
		if (!empty($_POST["start-week"]) && !empty($_POST["end-week"])) {
			$vote_week_start_disp=$_POST["start-week"];
			$vote_week_end_disp=$_POST["end-week"];
			$vote_week_start=strtotime($_POST["start-week"]);
			$vote_week_end=strtotime($_POST["end-week"]);
		}
	}
	include('vote_math.php'); // get votes //

	// get all previous results for points //
	$races_in_week=array();
	$races_db=$wpdb->get_results("SELECT id,name,total,results,date FROM $races_table");
	foreach ($races_db as $r) {
		$date_arr=explode("/",$r->date);
		$date_mod=$date_arr[2]."-".$date_arr[0]."-".$date_arr[1];
		$date_time=strtotime($date_mod);
		if ($date_time<=$week_end && $date_time>=$week_start) {
			//echo $row["id"]."<br />";
			//echo $row["results"]."<br />";
			$results=unserialize($r->results);
			$data=array(
				'id'=>$r->id,
				'name'=>$r->name,
				'total'=>$r->total,
				'results'=>$results
			);
			array_push($races_in_week,$data);
		}
	} // end foreach //
	//print_r($races_in_week);
	// get uci points for riders //
	$week_races_data=array();
	for ($i=0;$i<count($races_in_week);$i++) {
		for ($x=0;$x<count($races_in_week[$i]["results"]);$x++) {
			$data=array(
				'name'=>$races_in_week[$i]["results"][$x]["name"],
				'points'=>$races_in_week[$i]["results"][$x]["points"]
			); // end array //
			array_push($week_races_data,$data);
		} // end for loop
	} // end for loop
	//print_r($week_races_data);
	
	// get list of names //
	$rider_names=array();
	for ($i=0;$i<count($week_races_data);$i++) {
		array_push($rider_names,$week_races_data[$i]["name"]);
	}
	$rider_names=array_unique($rider_names);
	$rider_names=array_values($rider_names);
	//print_r($rider_names);
	
	// using list of names, get points //
	$rider_uci_points_week=array();
	for ($i=0;$i<count($rider_names);$i++) {
		$points=0;
		$rider=$rider_names[$i];
		for ($x=0;$x<count($week_races_data);$x++) {
			$c_rider=$week_races_data[$x]["name"];
			if ($rider==$c_rider) {
				$points=$week_races_data[$x]["points"]+$points;
			}
		} // end for //
		$data=array(
			'name'=>$rider_names[$i],
			'points'=>$points
		);
		array_push($rider_uci_points_week,$data);
	} // end for //
	//print_r($rider_uci_points_week);
	
	$all_races=array();
	$races_db=$wpdb->get_results("SELECT id,name,total,results,date,type FROM $races_table");
	foreach ($races_db as $r) {
		$date_arr=explode("/",$r->date);
		$date_mod=$date_arr[2]."-".$date_arr[0]."-".$date_arr[1];
		$date_time=strtotime($date_mod);
		if ($date_time<=$week_end) {
			//echo $row["id"]."<br />";
			$results=unserialize($r->results);
			$data=array(
				'id'=>$r->id,
				'name'=>$r->name,
				'total'=>$r->total,
				'type'=>$r->type,
				'results'=>$results
			);
			array_push($all_races,$data);
		}
	} // end foreach //
	//print_r($all_races);
	
	// build array of races and riders in race //
	for ($i=0;$i<count($all_races);$i++) {
		$data=array();
		for ($x=0;$x<count($all_races[$i]["results"]);$x++) {
			array_push($data,$all_races[$i]["results"][$x]["name"]);
		} // end for loop
		$all_races[$i]["riders"]=$data;
	} // end for loop
	//print_r($all_races);
	
	// get uci points for riders //
	$races_data=array();
	for ($i=0;$i<count($all_races);$i++) {
		for ($x=0;$x<count($all_races[$i]["results"]);$x++) {
			$data=array(
				'name'=>$all_races[$i]["results"][$x]["name"],
				'points'=>$all_races[$i]["results"][$x]["points"]
			); // end array //
			array_push($races_data,$data);
		} // end for loop
	} // end for loop
	//print_r($races_data);
	
	// get list of names //
	$rider_names=array();
	for ($i=0;$i<count($races_data);$i++) {
		array_push($rider_names,$races_data[$i]["name"]);
	}
	$rider_names=array_unique($rider_names);
	$rider_names=array_values($rider_names);
	//print_r($rider_names);
	
	// using list of names, get points //
	$rider_uci_points=array();
	for ($i=0;$i<count($rider_names);$i++) {
		$points=0;
		$rider=$rider_names[$i];
		for ($x=0;$x<count($races_data);$x++) {
			$c_rider=$races_data[$x]["name"];
			if ($rider==$c_rider) {
				$points=$races_data[$x]["points"]+$points;
			}
		} // end for //	
		// get all races rider was in //
		$rider_races=array();
		$rider_races_total=0;
		//print_r($all_races);
		for ($r=0;$r<count($all_races);$r++) {
			//print_r($all_races[$r]);
			if (in_array($rider,$all_races[$r]["riders"])) {
				//echo "<br />".$r." - ";
				$race_info=array(
					'name'=>$all_races[$r]["name"],
					'total'=>$all_races[$r]["total"],
					'type'=>$all_races[$r]["type"],
				);
				//echo $rider." : ";
				for ($p=0;$p<count($all_races[$r]["results"]);$p++) {
					//print_r($all_races[$r]);
					if ($all_races[$r]["results"][$p]["name"]==$rider) {
						//echo $rider." - ".$all_races[$r]["results"][$p]["name"];
						$race_info["place"]=$all_races[$r]["results"][$p]["place"];
					}
				}
				//print_r($rider_races);
				
				array_push($rider_races,$race_info);
				
				$rider_races_total=$rider_races_total+$all_races[$r]["total"];
			}
		}
		$rider_races_perc=round(($rider_races_total/count($rider_races)),3);
		$rider_races_perc=number_format($rider_races_perc,3);
		//print_r($rider_races);
		$data=array(
			'name'=>$rider,
			'points'=>$points,
			'races'=>$rider_races,
			'total_races'=>count($rider_races),
			'races_total'=>$rider_races_total,
			'races_total_perc'=>$rider_races_perc
		);
		array_push($rider_uci_points,$data);
	} // end for //
	//print_r($rider_uci_points);

	////////////////////////////// Begin Stength of Schedule (SOS) //////////////////////////////
	foreach ($rider_uci_points as $k => $rider) {
		$sos_total=0;
		foreach ($rider["races"] as $races) {
			$pts=0;
			if ($races["type"]=="CDM") {
				$pts=4;
			} elseif ($races["type"]=="CN") {
				$pts=3;
			} elseif ($races["type"]=="C1") {
				$pts=2;
			} elseif ($races["type"]=="C2") {
				$pts=1;
			}
			$sos_total=$sos_total+$pts;
		}
		$sos_final=($rider["races_total"]/$rider["total_races"])+$sos_total;
		$rider_uci_points[$k]["sos"]["sos_num"]=$sos_total;
	} // end foreach //
	
	usort($rider_uci_points, function ($a,$b) { 
		return strnatcmp($b['sos']['sos_num'], $a['sos']['sos_num']); // sort by sos num high to low //
	});
	//echo "<pre>";
	//print_r($rider_uci_points);
	//echo "</pre>";
	
	$sos_rank=0;
	$prev_num=0;
	$max=0;
	foreach ($rider_uci_points as $k => $rider) {
		//echo $sos_rank." - ";
		if ($sos_rank==0) {
			$sos_rank=1; // first run through //
			$max=$rider["sos"]["sos_num"];
		} else {
			if ($rider["sos"]["sos_num"]==$prev_num) {
				// do nothing //
			} else {
				$sos_rank++;
			}
		}
		$prev_num=$rider["sos"]["sos_num"];
		$rider_uci_points[$k]["sos"]["sos_rank"]=$sos_rank;
		//$sos_perc=(101-$sos_rank)*0.01;
		$sos_perc=round(($rider["sos"]["sos_num"]/$max),3);
		if ($sos_perc<0) {
			$sos_perc=0;
		}
		$sos_perc=number_format($sos_perc,3);
		$rider_uci_points[$k]["sos"]["sos_perc"]=$sos_perc;
	} // end foreach //
	////////////////////////////// End Stength of Schedule (SOS) //////////////////////////////
	//echo "<pre>";
	//print_r($rider_uci_points);
	//echo "</pre>";
	$total_races_season=count($all_races);
	
	// get winning % //
	$total_rider_races=0;
	for ($i=0;$i<count($rider_uci_points);$i++) {
		$wins=0;
		$total_rider_races=count($rider_uci_points[$i]["races"]);
		for ($p=0;$p<$total_rider_races;$p++) {
			if ($rider_uci_points[$i]["races"][$p]["place"]==1) {
				$wins=$wins+1;
			}
		}
		$winning_perc=$wins/$total_rider_races;
		$rider_uci_points[$i]["winning_perc"]=$winning_perc;
	}
	
	// votes //
	foreach($rider_uci_points as $key=>$rider) {
		$rider_uci_points[$key]["vote"]=array('pts'=>0,'perc'=>0);
		foreach ($vote_final as $k=>$v) {
			if ($rider["name"]==$v["name"]) {
				$rider_uci_points[$key]["vote"]=array('pts'=>$v["points"],'perc'=>$v["perc"]);
				unset($vote_final[$k]); // remove from array so we know who may have no races, but votes //
			}
		} // end foreach //
	} // end main foreach //
	
	foreach ($vote_final as $vf) {
		$arr=array(
			'name' => $vf["name"],
			'points' => 0,
			'races' => null,
			'total_races' => 0,
			'races_total' => 0,
			'races_total_perc' => 0,
			'sos' => array(
				'sos_num' => 0,
				'sos_rank' => 0,
				'sos_perc' => 0,
			),
			'winning_perc' => 0,
			'vote' => array(
				'pts' => $vf["points"],
				'perc' => $vf["perc"],
			),
		);
		array_push($rider_uci_points,$arr);
	}
	
	// UCI POINTS //
	// get total uci points for rider, divide by maximum uci points available //
	
	$max_points=0;
	$races_db=$wpdb->get_results("SELECT date,type FROM $races_table");
	foreach ($races_db as $races) {
		$race_pts=0;
		if ($races->type=="CDM") {
			$race_pts=200;
		} elseif ($races->type=="CN") {
			$race_pts=100;
		} elseif ($races->type=="C1") {
			$race_pts=80;
		} elseif ($races->type=="C2") {
			$race_pts=40;
		}
		$max_points=$max_points+$race_pts;
	}
	foreach ($rider_uci_points as $k => $rider) {
		$uci_perc=0;
		$uci_perc=round($rider["points"]/$max_points,3);
		$rider_uci_points[$k]["points_perc"]=$uci_perc;
	}
	//print_r($rider_uci_points);
	
	/////// set up final array ////////
	$final_rider_info=array();
	foreach ($rider_uci_points as $rider) {
		$final_arr=array();
		$final_arr=$rider; // copy array //

		$winning_perc=number_format($rider["winning_perc"],3);
		
		// cacl total //
		//echo $rider["points_perc"];
		$perc_total=($rider["points_perc"]+$rider["races_total_perc"]+$winning_perc+$rider["sos"]["sos_perc"]+$rider["vote"]["perc"])/5;
		$total=round($perc_total,3);

		$total=number_format($total,3);
		//$final_arr["races_mult"]=$races_mult;
		$final_arr["winning_perc"]=$winning_perc;
		//$final_arr["uci_pts_perc"]=$uci_pts_perc;
		$final_arr["total"]=$total;
		array_push($final_rider_info,$final_arr);
	}
	//print_r($final_rider_info);
	
	$sort=array();
	foreach ($final_rider_info as $k => $v) {
		$sort['total'][$k] = $v['total'];
		$sort['points'][$k] = $v['points'];
		$sort['sos']['sos_perc'][$k] = $v['sos']['sos_perc'];
		$sort['vote']['perc'][$k] = $v['vote']['perc'];	
	}
	
	if (!empty($sort)) {
		array_multisort($sort['total'], SORT_DESC, $sort['points'], SORT_DESC, $sort['sos']['sos_perc'], SORT_DESC,  $sort['vote']['perc'], SORT_DESC, $final_rider_info); // sort by total, then uci points, then SOS
	}
	
	//echo "<pre>";
	//print_r($final_rider_info);
	//echo "</pre>";
	
	$final_rider_info_s=serialize($final_rider_info);
	$final_rider_info_enc=urlencode($final_rider_info_s);
	?>
	<div class="season">
		<div class="strong">Date is set for 2012/13 Season</div>
		<div class="start-end">
			Season Start: <?php echo $season_start; ?><br />
			Season End: <?php echo $season_end; ?>
		</div>
	</div>
	<form name="set_dates" id="set_dates" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $_GET["page"]; ?>" method="post">
		<div class="text">Start of Vote Week:</div><input type="text" name="start-week" value="<?php echo $vote_week_start_disp; ?>" /> (dd-mm-yyyy)<br />
		<div class="text">End of Vote Week:</div><input type="text" name="end-week" value="<?php echo $vote_week_end_disp; ?>" /> (dd-mm-yyyy)<br />
		<input type="submit" name="submit-weeks" value="Set Weeks" />
	</form>
	
	<form name="add_rank" id="add_rank" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $_GET["page"]; ?>" method="post">
		<div class="text">Week:</div><select name="week"><?php generate_weeks(); ?></select><br />
		<div class="text">Season:</div><select name="season"><?php generate_seasons(); ?></select><br />
		<input type="submit" name="submit" value="Add to DB" />
		<input type="hidden" name="data" value='<?php echo $final_rider_info_enc; ?>' />
		<input type="hidden" name="add-rank" value="y" />
	</form>
	<div class="math-table">
		<div class="header">
			<div class="col rank">Rank</div>
			<div class="col name">Name</div>
			<div class="col uci-pts">UCI Points</div>
			<div class="col races">Races</div>
			<div class="col win-perc">Winning %</div>
			<div class="col sos">SOS % (Rank)</div>
			<div class="col vote">Vote (Points)</div>
			<div class="col total">Total</div>
		</div><!-- .header -->
		<?php $rank=1; ?>
		<?php foreach ($final_rider_info as $rider) { ?>
			<?php //if ($final_rider_info[$i]["points"]!=0) { ?>
				<div class="data">
					<div class="col rank"><?php echo $rank; ?></div>
					<div class="col name"><?php echo $rider["name"]; ?></div>
					<div class="col uci-pts"><?php echo $rider["points"]; ?> (<?php echo $rider["points_perc"]; ?>)</div>
					<div class="col races">
						<!--
						<?php foreach ($rider["races"] as $race) { ?>
							<?php echo $race["name"]; ?> -
							<?php echo $race["total"]; ?><br />
						<?php } ?>
						-->
						Total: <?php echo $rider["races_total_perc"]; ?> 
					</div>
					<div class="col win-perc"><?php echo $rider["winning_perc"]; ?></div>
					<div class="col sos"><?php echo $rider["sos"]["sos_perc"]; ?> (<?php echo $rider["sos"]["sos_rank"]; ?>)</div>
					<div class="col vote"><?php echo $rider["vote"]["perc"]; ?> (<?php echo $rider["vote"]["pts"]; ?>)</div>
					<div class="col total"><?php echo $rider["total"]; ?></div>
				</div><!-- .data -->
				<?php $rank++; ?>
			<?php //} // end 0 points if // ?>
			<?php //if ($rank==26) { break; } ?>
		<?php } // end foreach // ?>
	</div><!-- .math-table -->
<?php } // end top25_week function // ?>