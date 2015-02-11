<?php function top25_shortcode() {	?>
	<?php 
	$id=$_GET["id"]; 
	global $wpdb;
	$wpdb->show_errors();
	?>
	<h3>Generate Shortcode</h3>
	<?php
	$rank_table=$wpdb->prefix."top25_rank";
	
	$rank_db=$wpdb->get_row("SELECT data FROM $rank_table WHERE id='$id'");
	$data=unserialize($rank_db->data);
	//print_r($data);
	?>
	<div class="table-view">
		<div class="header">
			<div class="col name">Name</div>
			<div class="col pts">UCI Points</div>
			<div class="col races">Races</div>
			<div class="col win">Winning %</div>
			<div class="col sos">SOS % (Rank)</div>
			<div class="col vote">Vote (Points)</div>
			<div class="col total">Total</div>
		</div>
		<?php $rank=0; ?>
		<?php foreach ($data as $rider) { ?>
		
			<div class="row">
				<div class="col name"><?php echo $rider["name"]; ?></div>
				<div class="col pts"><?php echo $rider["points"]; ?></div>
				<div class="col races"><?php echo $rider["races_total_perc"]; ?></div>
				<div class="col win"><?php echo $rider["winning_perc"]; ?></div>
				<div class="col sos"><?php echo $rider["sos"]["sos_perc"]; ?> (<?php echo $rider["sos"]["sos_rank"]; ?>)</div>
				<div class="col vote"><?php echo $rider["vote"]["perc"]; ?> (<?php echo$rider["vote"]["pts"]; ?>)</div>
				<div class="col total"><?php echo $rider["total"]; ?></div>
			</div>
		<?php } ?>
	</div><!-- .table-view -->
	
	
  
<?php } ?>
<?php
function top25_week_shortcode($atts) {
	global $wpdb; 
	extract(shortcode_atts( array('id' => ''), $atts));
	$rank_table=$wpdb->prefix."top25_rank";
	$data=null;
	
	if ($id) {
		$rank_db=$wpdb->get_row("SELECT data,week,season FROM $rank_table WHERE id='$id'");
		$rdb=unserialize(gzinflate(base64_decode($rank_db->data)));
				
		$data.='<div class="table-view-site">';
			$data.='<div class="top-header">';
				$data.='<div class="col blank">&nbsp;</div>';
				$data.='<div class="col vote">Poll</div>';
				$data.='<div class="col comp">Computer</div>';
			$data.='</div>';
			$data.='<div class="header mod mod-row">';
				$data.='<div class="col rank">Rank</div>';
				$data.='<div class="col name">Name</div>';
				$data.='<div class="col vote">Poll</div>';
				$data.='<div class="col total">Computer</div>';
				$data.='<div class="col pts">UCI Pts</div>';
				$data.='<div class="col races">Races</div>';
				$data.='<div class="col win">Win %</div>';
				$data.='<div class="col sos">SOS</div>';
			$data.='</div>';

			$rank=0;
			foreach ($rdb as $rider) :
				$rank++;
					
				if (empty($rider["vote"]["rank"])) :
					$rider["vote"]["rank"]="NR";
				endif;
					
				if ($rank%2) {
					$class="alt";
				} else {
					$class="";
				}
				
				$data.='
					<div class="mod-row '.$class.'">
						<div class="col rank">'.$rank.'</div>
						<div class="col name">'.$rider["name"].'</div>						
						<div class="col vote">'.$rider["vote"]["rank"].'</div>
						<div class="col total">'.$rider["comp_rank"].'</div>
						<div class="col pts">'.$rider["uci_points_rank"].'</div>
						<div class="col races">'.$rider["race_total_rank"].'</div>
						<div class="col win">'.$rider["winning_perc_rank"].'</div>
						<div class="col sos">'.$rider["sos"]["sos_rank"].'</div>
					</div>
				';
					
				if ($rank==25) :
					break;
				endif;
			endforeach;
		$data.='</div><!-- .table-view -->';
	} // if id //

	return $data;  
}  
add_shortcode('top25-week','top25_week_shortcode');

function vote_sort($a,$b) {
	return strnatcmp($b['perc'], $a['perc']); // sort by sos num high to low //
}

function top25_vote_shortcode($atts) {
	global $wpdb; 
	extract(shortcode_atts(array(
		'start' =>'',
		'end' =>''
	),$atts));
	$vote_week_start=$start;
	$vote_week_end=$end;
	
	include("vote_math.php");
	usort($vote_final,'vote_sort');
	$rank=1;
	
	$others=array();
	$counter=0;
	foreach ($vote_final as $rider) :
		$counter++;
		if ($counter>25) {
			array_push($others,$rider["name"]);
		}
	endforeach;
	?>
	<?php $data=null; ?>
	<?php
	$data.='		
		<div class="table-view-vote">
			<h3>Top 25 Poll</h3>
			<div class="header">
				<div class="col rank">Rank</div>
				<div class="col name">Name</div>
				<div class="col pts ec-hide">Points</div>
				<div class="col perc ec-hide">Percent</div>
			</div>
	';
	foreach ($vote_final as $rider) :
		if ($rank%2) {
			$class="alt";
		} else {
			$class="";
		}
		$data.='
			<div class="row '.$class.'">
				<div class="col rank">'.$rank.'</div>
				<div class="col name">'.$rider["name"].'</div>
				<div class="col pts ec-hide">'.$rider["points"].'</div>
				<div class="col perc ec-hide">'.$rider["perc"].'</div>
			</div>
		';
		if ($rank==25) {
			break;	
		}
		$rank++;
	endforeach;
	$data.='<div class="others">';
		$data.='<b>Other riders receiving votes:</b> ';
		$data.=implode(", ",$others);
	$data.='</div>';
	$data.="</div><!-- .table-view-vote -->";
		
	return $data;
}  
add_shortcode('top25-vote','top25_vote_shortcode');

function top25_vote_page_shortcode($atts) {
	global $wpdb;
	$wpdb->show_errors();
	
	$votes_table=$wpdb->prefix."top25_votes";
	$riders_table=$wpdb->prefix."top25_riders";
	?>
	<!-- <h1 class="title">Vote for Top 25 Riders</h1> -->
	<?php
	if (isset($_POST["submit"]) && $_POST["submit"]=="Vote") {
		$results_arr=array();
		$date=date('d-m-Y');
		$userID=0;
		$flag=0;
		if ($_POST["number"]!=7) {
			?>
			<div class="upload-text">
				Invalid Number!<br />
				<a href="javascript:history.go(-1);">Go Back</a>
			</div>
			<?php
		} else {
			if (is_user_logged_in()) {
				$current_user = wp_get_current_user();
				$userID=$current_user->ID;
			} else {
				//echo "You must be registered to subit this form.<br />";
				//echo '<a href="javascript:history.go(-1);">Go Back</a>';
				//exit;
				// use timestamp //
				//echo intval($_SERVER['REMOTE_ADDR']);
				$userID=time();
			}
			
			foreach ($_POST as $k=>$v) {
				if ($k!="submit" && $k!="number") {
					array_push($results_arr,array('riderID'=>$v,'place'=>$k));
				}
			}
		
			$results_arr_s=serialize($results_arr);
			// upload poll results into db (votes), check for already voted 1st //
			$votes_all=array();
			$votes_db=$wpdb->get_results("SELECT date,userID FROM $votes_table");
			foreach ($votes_db as $vdb) {
				array_push($votes_all,array('userID'=>$vdb->userID,'date'=>$vdb->date));
			}
	
			foreach ($votes_all as $vote) {
				if ($vote["date"]==$date && $vote["userID"]==$userID) {
					$flag=1;
				}
			}
			//print_r($_POST);
			if ($flag==1) {
				?>
				<div class="upload-text">
					You already voted!<br />
					<a href="javascript:history.go(-1);">Go Back</a>
				</div>
				<?php
			} elseif ($_POST[1]==0) {
				?>
				<div class="upload-text">
					You need to at least vote for one person!<br />
					<a href="javascript:history.go(-1);">Go Back</a>
				</div>
				<?php
			} else {
				$db_arr=array(
					'date' => $date,
					'results' => $results_arr_s,
					'userID' => $userID,
				);
				$sql = $wpdb->insert($votes_table,$db_arr);
				?>
				<div class="upload-text">
					Done!
				</div>
				<?php
				//break;
			}
		} // end primary if else (number=7) //
	} else {
		$max=10;
		$riders_all=array();
		$riders_db=$wpdb->get_results("SELECT id,name FROM $riders_table ORDER BY name ASC");
		foreach ($riders_db as $rider) {
			$riders_all[$rider->id]=$rider->name;
		}
		?>
		<?php wp_enqueue_script('vote-js',plugins_url('js/vote.js',__File__)); ?>
		<?php
		$html.='<div class="left-col">';
			$html.='<form name="top25" id="top25" action="http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"].'" method="post">';
				for ($i=0;$i<$max;$i++) {
					$rank=$i+1;
					$html.='<div class="row">';
						$html.='<div class="number">'.$rank.'</div>';
						$html.='<select name="'.$rank.'" id="'.$rank.'">';
							$html.='<option value="0">Select Name</option>';
							foreach ($riders_all as $k=>$r) { 
								$html.='<option value="'.$k.'">'.$r.'</option>';
							} // end foreach //
						$html.='</select>';
					$html.='</div>';
				} // end for //
				$html.='<div class="row input">';
					$html.='<div class="label">Human Test: What is 5 + 2?</div>';
					$html.='<div class="human"><input type="text" name="number" id="number" /></div>';
				$html.='</div>';
				$html.='<input type="submit" name="submit" value="Vote" />';
			$html.='</form>';
		$html.='</div><!-- .left-col -->';
		
		$html.='<div class="right-col">';
			$html.='<h3>Instructions</h3>';
			$html.='<div class="instructions">';
				$html.='<ul>';
					$html.='<li>Rank riders from 1 - 10 with number 1 being your top ranked rider this week.</li>';
					$html.='<li>If you can\'t come up with 10, not a problem go as deep as you can. </li>';
					$html.='<li>Once you\'re done, click vote and you should be all set. </li>';
					$html.='<li>Please note, you can only vote once a week. </li>';
					$html.='<li>Each week, riders will be added if they race a UCI race.</li>';
				$html.='</ul>';
			$html.='</div>';
		$html.='</div><!-- .right-col -->';
	 
		return $html;
	} // end else //
}  
add_shortcode('top25-votePage','top25_vote_page_shortcode');
?>