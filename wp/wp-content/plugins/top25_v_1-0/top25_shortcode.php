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
		$rdb=unserialize($rank_db->data);
		?>
		<div class="table-view-site">
			<div class="title">
				<h2><?php echo $rank_db->season; ?> - Week <?php echo $rank_db->week; ?></h2>
			</div>
			<div class="header">
				<div class="col rank">Rank</div>
				<div class="col name">Name</div>
				<div class="col pts">UCI Points</div>
				<div class="col races">Races</div>
				<div class="col win">Winning %</div>
				<div class="col sos">SOS % (Rank)</div>
				<div class="col vote">Vote (Points)</div>
				<div class="col total">Total</div>
			</div>
			<?php $rank=0; ?>
			<?php foreach ($rdb as $rider) { ?>
				<?php $rank++; ?>
				<div class="row">
					<div class="col rank"><?php echo $rank; ?>.</div>
					<div class="col name"><?php echo $rider["name"]; ?></div>
					<div class="col pts"><?php echo $rider["points_perc"]; ?> (<?php echo $rider["points"]; ?>)</div>
					<div class="col races"><?php echo $rider["races_total_perc"]; ?></div>
					<div class="col win"><?php echo $rider["winning_perc"]; ?></div>
					<div class="col sos"><?php echo $rider["sos"]["sos_perc"]; ?> (<?php echo $rider["sos"]["sos_rank"]; ?>)</div>
					<div class="col vote"><?php echo $rider["vote"]["perc"]; ?> (<?php echo$rider["vote"]["pts"]; ?>)</div>
					<div class="col total"><?php echo $rider["total"]; ?></div>
				</div>
				<?php
				if ($rank==25) {
					break;
				}
				?>
			<?php } ?>
		</div><!-- .table-view -->		
		<?php
	}

	//return $data;  
}  
add_shortcode('top25-week','top25_week_shortcode');

function top25_vote_shortcode($atts) {
	global $wpdb; 
	extract(shortcode_atts(array(
		'start' =>'',
		'end' =>''
	),$atts));
	$vote_week_start=$start;
	$vote_week_end=$end;
	
	include("vote_math.php");
	usort($vote_final, function ($a,$b) { 
		return strnatcmp($b['points'], $a['points']); // sort by sos num high to low //
	});
	$rank=1;
	?>
	<h3>Top 25 Votes</h3>		
	<div class="table-view-vote">
		<div class="header">
			<div class="col rank">Rank</div>
			<div class="col name">Name</div>
			<div class="col pts">Points</div>
			<div class="col perc">Percent</div>
		</div>
	<?php foreach ($vote_final as $rider) : ?>
		<div class="row">
			<div class="col rank"><?php echo $rank; ?></div>
			<div class="col name"><?php echo $rider["name"]; ?></div>
			<div class="col pts"><?php echo $rider["points"]; ?></div>
			<div class="col perc"><?php echo $rider["perc"]; ?></div>
		</div>
		<?php
		if ($rank==25) {
			break;	
		}
		$rank++;
	endforeach; 
	echo "</div><!-- .table-view-vote -->";
}  
add_shortcode('top25-vote','top25_vote_shortcode');

function top25_vote_page_shortcode($atts) {
	global $wpdb;
	$wpdb->show_errors();
	
	$votes_table=$wpdb->prefix."top25_votes";
	$riders_table=$wpdb->prefix."top25_riders";
	?>
	<h1 class="title">Vote for Top 25 Riders</h1>
	<?php
	if (isset($_POST["submit"]) && $_POST["submit"]=="Vote") {
		$results_arr=array();
		$date=date('d-m-Y');
		$userID=0;
		$flag=0;
		if (is_user_logged_in()) {
			$current_user = wp_get_current_user();
			$userID=$current_user->ID;
		} else {
			echo "You must be registered to subit this form.<br />";
			echo '<a href="javascript:history.go(-1);">Go Back</a>';
			exit;
		}
		foreach ($_POST as $k=>$v) {
			if ($k!="submit") {
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
		}
	} else {
		$max=25;
		$riders_all=array();
		$riders_db=$wpdb->get_results("SELECT id,name FROM $riders_table ORDER BY name ASC");
		foreach ($riders_db as $rider) {
			$riders_all[$rider->id]=$rider->name;
		}
		?>
		<?php wp_enqueue_script('vote-js',plugins_url('js/vote.js',__File__)); ?>
		<div class="left-col">
			<form name="top25" id="top25" action="http://<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" method="post">
				<?php for ($i=0;$i<$max;$i++) { ?>
					<div class="row">
						<div class="number"><?php echo $i+1; ?></div>
						<select name="<?php echo $i+1; ?>" id="<?php echo $i+1; ?>">
							<option value="0">Select Name</option>
							<?php foreach ($riders_all as $k=>$r) { ?>
								<option value="<?php echo $k; ?>"><?php echo $r; ?></option>
							<?php } // end foreach // ?>
						</select>
					</div>
				<?php } // end for // ?>
				<input type="submit" name="submit" value="Vote" />
			</form>
		</div><!-- .left-col -->
		<div class="right-col">
			<h3>Instructions</h3>
			<div class="instructions">
				Rank riders from 1 - 25 with number 1 being your top ranked rider this week. if you can't come up with 25, not a problem go as deep as you can. Once you're done, click vote and you should be all set. Please note, you can only vote once a week. Finally, if you really want to vote for some one who is not on the list, let me know and I'll manually add them. Each week, riders will be added if they race a UCI race.
			</div>
		</div><!-- .right-col -->
		
	<?php } // end else //
}  
add_shortcode('top25-votePage','top25_vote_page_shortcode');
?>