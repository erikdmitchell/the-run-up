<?php function top25_admin() { ?>
	<div class="left-col">
		<div class="files">
			<h3>Files</h3>
			<?php
			global $wpdb;
			$wpdb->show_errors();
			
			$races_table=$wpdb->prefix."top25_races";
			$riders_table=$wpdb->prefix."top25_riders";
			$rank_table=$wpdb->prefix."top25_rank";
			$votes_table=$wpdb->prefix."top25_votes";
			
			// get ranks stored in db //
			$rank_data=array();
			$rank_db=$wpdb->get_results("SELECT id,week,season FROM $rank_table");
			foreach ($rank_db as $r) {
				$data=array(
					'id'=>$r->id,
					'week'=>$r->week,
					'season'=>$r->season
				);
				array_push($rank_data,$data);
			}
			
			// get races in db //
			$races_in_db=array();
			$races_db=$wpdb->get_results("SELECT filename FROM $races_table");
			foreach ($races_db as $r) {
				array_push($races_in_db,$r->filename);
			}
			
			$folder=TOP25_PATH.'uploads';
			?>
			
			<?php
			$dirs_arr=array();
			$files_arr=array();
			foreach (glob($folder.'/*') as $f) {
				if (is_dir($f)) {
					array_push($dirs_arr,$f);
					foreach (glob($f.'/*') as $sd) {
						array_push($files_arr,array('file'=>$sd,'dir'=>$f));
					}
				} else {
					array_push($files_arr,array('file'=>$f));
				}
			} 
			
			$files_arr=sort_files('date',$files_arr);
			$prev_month=0;
			$current_month=0;
			?>
		
			<ul class="files">
				<?php foreach ($dirs_arr as $dir) : ?>
					<li id="year-<?php echo end(explode("/",$dir)); ?>">
						<b><?php echo end(explode("/",$dir)); ?></b> <a href="#" class="open-close">Close</a>
					</li>
					<ul class="subdir" id="year-<?php echo end(explode("/",$dir)); ?>">
						<?php $alt=0; ?>
						<?php foreach ($files_arr as $file) : ?>
							<?php	if ($file["dir"]==$dir) : ?>
								<?php
								if ($alt%2 && $alt!=0) {
									$class="alt";
								} else {
									$class=null;
								}
								
								// get month and compare it to previous li month //
								$current_month=date('m',strtotime($file["date"]));
								if ($current_month!=$prev_month) :
									if ($prev_month!=0) :
										echo '</ul><!-- .month -->';
									endif;
									echo '<li id="month-'.$current_month.'" class="month-label">'.date("F",mktime(0,0,0,$current_month,10)).' <a href="#" class="open-close">Close</a></li>';
									echo '<ul id="month-'.$current_month.'" class="month">';									
								endif;
								?>
								<li class="filename <?php echo $class; ?>">
									<a href="admin.php?page=top25-upload&file=<?php echo urlencode($file["file"]); ?>"><?php echo $file["name"]; ?></a>
									<div class="date"><?php echo $file["date"]; ?></div>
									<?php if (in_array($file["file"],$races_in_db)) : ?>
										<div class="indb">in db</div>
									<?php endif; ?>
								</li>
								<?php $alt++; ?>
							<?php endif; ?>
							<?php $prev_month=$current_month; ?>
						<?php endforeach; ?>
					</ul><!-- .subdir -->
				<?php endforeach; ?>
			</ul>

		</div><!-- .files -->
		
		<?php $rider_data=$wpdb->get_results("SELECT * FROM $riders_table"); ?>
		<?php if (count($rider_data)==0) : ?>
			<div class="initial-data">
				<h3>Initial Data</h3>
				<a href="admin.php?page=db-install-rider-data">Default Rider Data</a>
			</div><!-- initial-data -->
		<?php endif; ?>
		
		<?php echo display_seasons(); ?>
		
	</div><!-- .left-col -->
	<div class="right-col">
		<div class="weeks">
			<h3>Weekly Rankings</h3>
			<?php if (isset($_GET["action"]) && $_GET["action"]=="week-sc") : ?>
				<div class="shortcode">
					<b>Shortcode:</b> [top25-week id=<?php echo $_GET["id"]; ?>]
				</div>
			<?php endif; ?>
			<?php foreach ($rank_data as $rd) { ?>
				<a href="admin.php?page=top25-week-view&id=<?php echo $rd["id"]; ?>"><?php echo $rd["season"]; ?>&nbsp-&nbsp;Week <?php echo $rd["week"]; ?></a> [<a href="admin.php?page=top25-admin&action=week-sc&id=<?php echo $rd["id"]; ?>">shortcode</a>]&nbsp;[<a href="admin.php?page=top25-delete&item=week&id=<?php echo $rd["id"]; ?>&week=<?php echo $rd["week"]; ?>&season=<?php echo $rd["season"]; ?>">delete</a>]<br />
			<?php } ?>
		</div><!-- .weeks -->
	</div><!-- .right-col -->
<?php } // end top25_admin function // ?>
<?php
function sort_files($field,$arr) {
	foreach ($arr as $k=>$f) {
		$dir_arr=explode("/",$f["file"]);

		$name=end($dir_arr);
		$name = substr($name,0,strrpos($name,'.'));

		$file_contents=get_file_contents($f["file"]);

		$arr[$k]["file-name"]=$name;
		foreach ($file_contents as $key=>$fc) {
			$arr[$k][$key]=$fc;
		}
	} // end foreach //
	usort($arr,'array_sort_date');
	return $arr;
}

function get_file_contents($file) {
	$arr=array();
	$row=0;
	$handle = fopen($file, "r");
	while (($data = fgetcsv($handle, 1024, ",")) !== FALSE) {
		$row++;
		if ($row==1) {
			$arr["name"]=$data[9];
			$arr["date"]=$data[8];
			break;
		}
	} // end while loop //
	return $arr;	
}

function array_sort_date($a,$b) {
	return strnatcmp($b['date'],$a['date']);
}
/*************************************
	season information
*************************************/
function display_seasons() {
	global $wpdb;
	$html=null;
	
	if (isset($_POST["add-season"]) && $_POST["add-season"]=="Add Season") :
		echo add_season();
	elseif (isset($_POST["submit-season"]) && $_POST["submit-season"]=="Add Season") :
		echo process_season($_POST);
	endif;
	
	$seasons=$wpdb->get_results("SELECT * FROM ".TOP25_SEASONS_TABLE);
		
	$html.='<div class="seasons">';
		$html.='<h3>Seasons</h3>';
		$html.='<ul class="seasons">';
			foreach ($seasons as $season) :
				$html.='<li><strong>'.$season->season.'</strong>: '.$season->start.' - '.$season->end.'</li>';
			endforeach;
		$html.='</ul>';
		$html.='<form name="seasons" method="POST" action="">';
			$html.='<input type="submit" name="add-season" id="add-season" class="button action" value="Add Season">';
		$html.='</form>';
	$html.='</div>';
	
	return $html;
}

function process_season($data) {
	global $wpdb;
	$html=null;
	
	unset($data["submit-season"]);

	$success=$wpdb->insert(TOP25_SEASONS_TABLE,$data);
	
	if ($success) :
		$html.='Season Added.';
	else :
		$html.='There was an error adding the season.';
	endif;
	
	return $html;
}

function add_season() {
	$html=null;
	
	$html.='<form name="add-seasons" method="POST" action="">';
		$html.='<table class="form-table">';
			$html.='<tr valign="top">';
				$html.='<th scope="row">';
					$html.='<label for="season">Season</label>';
				$html.='</th>';
				$html.='<td>';	
					$html.='<input type="text" name="season" id="season" class="regular-text" />';
				$html.='</td>';
			$html.='</tr>';
			$html.='<tr valign="top">';
				$html.='<th scope="row">';
					$html.='<label for="start">Start</label>';
				$html.='</th>';
				$html.='<td>';
					$html.='<input type="text" name="start" id="start" class="seasondatepicker" />';
				$html.='</td>';
			$html.='</tr>';					
			$html.='<tr valign="top">';
				$html.='<th scope="row">';
					$html.='<label for="end">End</label>';
				$html.='</th>';
				$html.='<td>';					
					$html.='<input type="text" name="end" id="end" class="seasondatepicker" />';
				$html.='</td>';
			$html.='</tr>';								
		$html.='</table>';
		$html.='<input type="submit" name="submit-season" id="submit-season" class="button action" value="Add Season">';
	$html.='</form>';
		
	return $html;
}
?>