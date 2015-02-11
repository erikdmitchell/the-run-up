<?php
function top25_vote() {
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
		//echo "<p>";
		// id, date (09/17/2011 ), results (s array), userID (n/a) //
		
		//print_r($results_arr);
		$results_arr_s=serialize($results_arr);
		// upload poll results into db (votes), check for already voted 1st //
		$votes_all=array();
		$votes_db=$wpdb->get_results("SELECT date,userID FROM $votes_table");
		foreach ($votes_db as $vdb) {
			array_push($votes_all,array('userID'=>$vdb->userID,'date'=>$vdb->date));
		}
		//print_r($votes_all);
		// add new riders to db //
		foreach ($votes_all as $vote) {
			if ($vote["date"]==$date && $vote["userID"]==$userID) {
				$flag=1;
			}
		}
		if ($flag==1) {
			?>
			<div class="upload-text">
				You already voted!<br />
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
			<?php if (is_admin()) : ?>
				<div class="admin-vote">
					<h3>Admin Controls</h3>
					<div class="controls">

						<?php if (isset($_POST["submit"]) && $_POST["submit"]=="Generate Shortcode") : ?>
								<?php
								if (!empty($_POST["start-week"]) && !empty($_POST["end-week"])) {
									$vote_week_start_disp=$_POST["start-week"];
									$vote_week_end_disp=$_POST["end-week"];
									$vote_week_start=strtotime($_POST["start-week"]);
									$vote_week_end=strtotime($_POST["end-week"]);
								}
								//include('vote_math.php'); // get votes //
								//echo "<pre>";
								//print_r($vote_final);
								//echo "</pre>";
								?>
							<div class="shortcode">Shortcode: [top25-vote start='<?php echo $vote_week_start; ?>' end='<?php echo $vote_week_end; ?>']</div>
						<?php endif; ?>

						<form name="vote-shortcode" id="vote-shortcode" action="http://<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>" method="post">
							<div class="text">Start of Vote Week:</div><input type="text" name="start-week" value="<?php echo $vote_week_start_disp; ?>" /> (dd-mm-yyyy)<br />
							<div class="text">End of Vote Week:</div><input type="text" name="end-week" value="<?php echo $vote_week_end_disp; ?>" /> (dd-mm-yyyy)<br />
							<input type="submit" name="submit" value="Generate Shortcode" />
						</form>

					</div>
				</div><!-- .admin-vote -->
			<?php endif; ?>
		</div><!-- .right-col -->
	<?php } // end else // ?>
<?php } // end top25_vote // ?>