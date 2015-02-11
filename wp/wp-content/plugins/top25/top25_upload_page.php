<?php
function top25_upload() {
	global $wpdb;
	$wpdb->show_errors();
	
	$races_table=$wpdb->prefix."top25_races";
	
	$uci_mod=0;
	$wcp_mod=0;
	$fr="n";
	$nowcp="n";
	if (isset($_POST["submit"])) {
		// determine if it's a resubmit or file upload //
		if ($_POST["submit"]=="Resubmit") {
			$file=$_POST['file'];
			if (isset($_POST["first-race"])) {
				$fr=$_POST["first-race"];
			}
			if (isset($_POST["no-wcp"])) {
				$nowcp=$_POST["no-wcp"];
			}
			if (isset($_POST["first-race"]) && $_POST["first-race"]=="y") {
				$uci_mod=7;
				$wcp_mod=7;
			} elseif (isset($_POST["no-wcp"]) && $_POST["no-wcp"]=="y") {
				$wcp_mod=7;
			}
		} elseif ($_POST["submit"]=="Upload") {
			// upload //
			include("upload_race.php");
			exit;
		}
	} else {
		$file=urldecode($_GET['file']);
	}
	?>
	<?php
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
	
	//echo "<pre>";
	//print_r($races_arr);
	//echo "</pre>";
	
	//foreach ($races_arr as $k=>$rider) {
	//	$races_arr[$k]["name"]=preg_replace('/[^(\x20-\x7F)]*/','', $rider["name"]);
	//}
	
	$races_arr_s=serialize($races_arr);
	$races_arr_s_enc=urlencode($races_arr_s);
	//print_r($races_arr_s_enc);
	// get racers in field //
	$racers_in_field=array();
	for ($i=0;$i<count($races_arr);$i++) {
		array_push($racers_in_field,$races_arr[$i]["name"]);
	}
	//print_r($racers_in_field);
	// modify dates for compare //
	$race_date_arr=explode("/",$race_date);
	//print_r($race_date);
	$race_date_mod=$race_date_arr[2]."-".$race_date_arr[0]."-".$race_date_arr[1];
	//print_r($race_date_mod);
	$race_date_time=strtotime($race_date_mod);
	// get all previous results for points //
	$wcp_races_before_data=array();
	$races_before_data=array();
	$races_db=$wpdb->get_results("SELECT name,date,results,type FROM $races_table");
	foreach ($races_db as $race) {
		$date_arr=explode("/",$race->date);
		$date_mod=$date_arr[2]."-".$date_arr[0]."-".$date_arr[1];
		//echo $date_mod."<br>";
		$date_time=strtotime($date_mod);
		if ($date_time<$race_date_time) {
			//echo $race->name." - ".$race->date." - ".$race->type."<br />";
			$results=unserialize($race->results);
			array_push($races_before_data,$results);
			if ($race->type=="CDM") {
				array_push($wcp_races_before_data,$results);
			}
		}
	}
	//echo serialize($races_arr);
	
	// get uci points for riders //
	$all_races_data=array();
	for ($i=0;$i<count($races_before_data);$i++) {
		//$races_before_data[$i]
		for ($x=0;$x<count($races_before_data[$i]);$x++) {
			$data=array(
				'name'=>$races_before_data[$i][$x]["name"],
				'points'=>$races_before_data[$i][$x]["points"]
			); // end array //
			array_push($all_races_data,$data);
		} // end for loop
	} // end for loop
	
	//print_r($all_races_data);
	// compare names and add points //
	// get list of names //
	$rider_names=array();
	for ($i=0;$i<count($all_races_data);$i++) {
		array_push($rider_names,$all_races_data[$i]["name"]);
	}
	$rider_names=array_unique($rider_names);
	$rider_names=array_values($rider_names);
	
	//print_r($rider_names);
	// using list of names, get points //
	$rider_uci_points=array();
	for ($i=0;$i<count($rider_names);$i++) {
		$points=0;
		$rider=$rider_names[$i];
		for ($x=0;$x<count($all_races_data);$x++) {
			$c_rider=$all_races_data[$x]["name"];
			if ($rider==$c_rider) {
				$points=$all_races_data[$x]["points"]+$points;
			}
		} // end for //
		$data=array(
			'name'=>$rider_names[$i],
			'points'=>$points
		);
		array_push($rider_uci_points,$data);
	} // end for //
	//print_r($rider_uci_points);
	/////////////////////////////////////////////////////////////////
	// get wcp points for riders //
	$wcp_all_races_data=array();
	for ($i=0;$i<count($wcp_races_before_data);$i++) {
		for ($x=0;$x<count($wcp_races_before_data[$i]);$x++) {
			$data=array(
				'name'=>$wcp_races_before_data[$i][$x]["name"],
				'points'=>$wcp_races_before_data[$i][$x]["points"]
			); // end array //
			array_push($wcp_all_races_data,$data);
		} // end for loop
	} // end for loop
	
	// compare names and add points //
	
	// using list of names, get points //
	$rider_wcp_points=array();
	for ($i=0;$i<count($rider_names);$i++) {
		$points=0;
		$rider=$rider_names[$i];
		for ($x=0;$x<count($wcp_all_races_data);$x++) {
			$c_rider=$wcp_all_races_data[$x]["name"];
			if ($rider==$c_rider) {
				$points=$wcp_all_races_data[$x]["points"]+$points;
			}
		} // end for //
		$data=array(
			'name'=>$rider_names[$i],
			'points'=>$points
		);
		array_push($rider_wcp_points,$data);
	} // end for //
	//print_r($rider_wcp_points);
	
	// create one array with uci and wcp points //
	$rider_points=array();
	for ($i=0;$i<count($rider_names);$i++) {
		$uci_points=0;
		$wcp_points=0;
		$rider=$rider_names[$i];
		// uci points //
		for ($x=0;$x<count($rider_uci_points);$x++) {
			$c_rider=$rider_uci_points[$x]["name"];
			if ($rider==$c_rider) {
				$uci_points=$rider_uci_points[$x]["points"]+$uci_points;
			}
		} // end for //
		// wcp points //
		for ($x=0;$x<count($rider_wcp_points);$x++) {
			$c_rider=$rider_wcp_points[$x]["name"];
			if ($rider==$c_rider) {
				$wcp_points=$rider_wcp_points[$x]["points"]+$wcp_points;
			}
		} // end for //
		$data=array(
			'name'=>$rider_names[$i],
			'uci_points'=>$uci_points,
			'wcp_points'=>$wcp_points
		);
		array_push($rider_points,$data);
	} // end for //
	?>
	
	<?php
	$wcp_total=0;// total number of wc points
	$uci_total=0; // total number of uci points
	for ($i=0;$i<count($rider_points);$i++) {
		$wcp_total=$wcp_total+$rider_points[$i]["wcp_points"];
		$uci_total=$uci_total+$rider_points[$i]["uci_points"];
	}
		
	$no_finish=count($races_arr); //number of finishers
	
	$wcp_field=0;
	for ($i=0;$i<count($racers_in_field);$i++) {
		$rider=$racers_in_field[$i];
		for ($x=0;$x<count($rider_points);$x++) {
			if ($rider==$rider_points[$x]["name"]) {
				$wcp_field=$wcp_field+$rider_points[$x]["wcp_points"];
			}
		}
	}
	// wcp multiplyer //
	if($wcp_total != 0) {
		$wcp_mult=$wcp_field/$wcp_total; //world cup multiplyer
	} else {
		$wcp_mult=0;
	}
	// mod/override for first race of season //
	if ($wcp_mod==0) {
		$wcp_mult=round($wcp_mult,3);
		$wcp_mult=number_format($wcp_mult,3);
	} else {
		$wcp_mult=$wcp_mod;
	}
	
	// uci points in field //
	$uci_field=0;
	for ($i=0;$i<count($racers_in_field);$i++) {
		$rider=$racers_in_field[$i];
		for ($x=0;$x<count($rider_points);$x++) {
			if ($rider==$rider_points[$x]["name"]) {
				$uci_field=$uci_field+$rider_points[$x]["uci_points"];
			}
		}
	}
	// uci multiplier //
	if($uci_total != 0) {
		$uci_mult=$uci_field/$uci_total; //uci multiplyer
	} else {
		$uci_mult=0;
	}
	//echo "UCI MUTL: ".$uci_mult."<br>";
	// mod/override for first race of season //
	if ($uci_mod==0) {
		$uci_mult=round($uci_mult,3);
		$uci_mult=number_format($uci_mult,3);
	} else {
		$uci_mult=$uci_mod;
	}
	
	// race type conversion //
	$type_num=0;
	if ($race_type=='C1') {
		$type_num=2;
	} elseif ($race_type=='C2') {
		$type_num=3;
	} elseif ($race_type=='CDM') {
		$type_num=1;
	} elseif ($race_type=='CN') {
		$type_num=2;
	}
	
	// finisher multiplier //
	/*
	$nof_mult=$no_finish/$type_num; //no of finisher multiplyer
	$nof_mult=$nof_mult/$no_finish; //divide multiplyer by field to get percentage
	$nof_mult=round($nof_mult,3);
	*/
	// finisher multiplier new //
	$nof_race_mult=0;
	if ($race_type=='C1') {
		$nof_race_mult=42;
	} elseif ($race_type=='C2') {
		$nof_race_mult=39;
	} elseif ($race_type=='CDM') {
		$nof_race_mult=56;
	} elseif ($race_type=='CN') {
		$nof_race_mult=29;
	}
	//echo $nof_race_mult."<br>";
	//echo $no_finish."<br />";
	$nof_mult=$no_finish/$nof_race_mult;
	if ($nof_mult>=1) {
		$nof_mult=1;
	}
	$nof_mult=round($nof_mult,3);
	$nof_mult=number_format($nof_mult,3);
	//echo $nof_mult."<br>";
	
	$divider=3;

	// we need a mod if WC and/or UCI are 7, which mean's it's invalid - we remove invalid values and change the divider //
	if ($wcp_mult==7) {
		$wcp_mult=0;
		$divider--;
	}
	if ($uci_mult==7) {
		$uci_mult=0;
		$divider--;
	}

	// field quality = (wc mult + uci mult + nof mult) / 3 //
	$field_quality=($wcp_mult+$uci_mult+$nof_mult)/$divider;
	$field_quality=round($field_quality,3);
	$field_quality=number_format($field_quality,3);
	
	// final math //
	$total=$field_quality+$wcp_mult+$uci_mult;
	$race_total=round(($total/$divider),3);
	$race_total=number_format($race_total,3);
	?>
	
	<div class="left-col">
		Total World Cup Points: <?php echo $wcp_total; ?><br/>
		Total World Cup Points in Field: <?php echo $wcp_field; ?><br/>
		World Cup Points Multiplier: <b><?php echo $wcp_mult; ?></b><br/>
		<p/>
		Total UCI Points: <?php echo $uci_total; ?><br/>
		Total UCI Points in Field: <?php echo $uci_field; ?><br/>
		UCI Points Multiplier: <b><?php echo $uci_mult; ?></b><br/>
		<p/>
		Number of finishers: <?php echo $no_finish; ?><br/>
		Type: <?php echo $race_type; ?><br/>
		Type Num: <?php echo $type_num; ?><br/>
		No Finishers Multiplier: <b><?php echo $nof_mult; ?></b><br/>
		<p/>
		Field Quality: <b><?php echo $field_quality; ?></b><br/>
		
		<form name="resubmit" id="resubmit" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $_GET["page"]; ?>" method="POST">
			<input type="hidden" name="file" value="<?php echo $file; ?>" />
			<input type="checkbox" name="first-race" value="y" <?php if ($fr=="y") { echo "checked"; } ?> />First Race*<br />
			<input type="checkbox" name="no-wcp" value="y" <?php if ($nowcp=="y") { echo "checked"; } ?> />No World Cups**<br />
			<input type="submit" name="submit" value="Resubmit" />
			<div class="notes">
				*The first race of the European/US season gets a modified race quality due to lack of UCI points<br />
				**If no World Cup races have occurred, we need override<br />
				Divider: <?php echo $divider; ?> (3 as base)
			</div>
		</form>
		<div class="table ur">
			<div class="header">
				<div class="col">Field Quality</div>
				<div class="col">WC Multi</div>
				<div class="col">UCI Multi</div>
				<div class="col">Total</div>
			</div>
			<div class="row">
				<div class="col"><?php echo $field_quality; ?></div>
				<div class="col"><?php echo $wcp_mult; ?></div>
				<div class="col"><?php echo $uci_mult; ?></div>
				<div class="col"><?php echo $total; ?></div>
			</div>	
		</div><!-- .table .ur -->
		Race Total: <?php echo $race_total; ?>
		<form name="upload-race" id="upload-race" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $_GET["page"]; ?>" method="POST">
			<?php
			//echo $file."<br>";
			//echo TOP25_PATH."<br>";
			//$file=str_replace('\\\\',"\\",$file);
			//$file=urlencode($file);
			?>
			<input type="hidden" name="file" value="<?php echo $file; ?>" />
			<input type="hidden" name="fq" value="<?php echo $field_quality; ?>" />
			<input type="hidden" name="type" value="<?php echo $race_type; ?>" />
			<input type="hidden" name="name" value="<?php echo $name; ?>" />
			<input type="hidden" name="total" value="<?php echo $race_total; ?>" />
			<input type="hidden" name="riders_arr" value="<?php echo $races_arr_s_enc; ?>" />
			<input type="submit" name="submit" value="Upload" />
		</form>
	</div><!-- .left-col -->
<?php } // end function ?>