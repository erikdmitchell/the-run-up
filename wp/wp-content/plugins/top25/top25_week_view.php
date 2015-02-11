<?php
function top25_week_view() { 
	$id=$_GET["id"];
	
	global $wpdb;
	$wpdb->show_errors();

	$rank_table=$wpdb->prefix."top25_rank";
	
	$rank_db=$wpdb->get_row("SELECT data,week,season FROM $rank_table WHERE id='$id'");
	//$data=unserialize($rank_db->data);

	if ($rank_db->week<6) {
		$rdb=unserialize($rank_db->data);
	} elseif ($rank_db->week<10) {
		$rdb=unserialize(base64_decode($rank_db->data));
	} else {
		$rdb=unserialize(gzinflate(base64_decode($rank_db->data)));
	}
	
	$data="";
	
	$data.='
		<div class="table-view-site">
	';
			if ($rank_db->week<6) {
				$data.='
					<div class="title">
						<h2>'.$rank_db->season.' - Week '.$rank_db->week.'</h2>
					</div>
				';
			}
			if ($rank_db->week>=6) {
				$data.='
					<div class="top-header">
						<div class="col blank">&nbsp;</div>
						<div class="col vote">Poll</div>
						<div class="col comp">Computer</div>
					</div>
					<div class="header mod mod-row">
						<div class="col rank">Rank</div>
						<div class="col name">Name</div>
						<div class="col vote">Poll</div>
						<div class="col total">Computer</div>
						<div class="col pts">UCI Pts</div>
						<div class="col races">Races</div>
						<div class="col win">Win %</div>
						<div class="col sos">SOS</div>
					</div>
				';
			} else {
				$data.='
					<div class="header">
						<div class="col rank">Rank</div>
						<div class="col name">Name</div>
						<div class="col pts">UCI Points</div>
						<div class="col races">Races</div>
						<div class="col win">Winning %</div>
						<div class="col sos">SOS</div>
						<div class="col vote">Vote</div>
						<div class="col total">Total</div>
					</div>
				';
			} // end if week>=6 //
			$rank=0;
			foreach ($rdb as $rider) {
				$rank++;
				
				if (empty($rider["vote"]["rank"])) {
					$rider["vote"]["rank"]="n/a";
				}
				
				if ($rank_db->week<6) {
					$data.='
						<div class="row">
							<div class="col rank">'.$rank.'.</div>
							<div class="col name">'.$rider["name"].'</div>
							<div class="col pts">'.$rider["points_perc"].' ('.$rider["points"].')</div>
							<div class="col races">'.$rider["races_total_perc"].'</div>
							<div class="col win">'.$rider["winning_perc"].'</div>
							<div class="col sos">'.$rider["sos"]["sos_perc"].' ('.$rider["sos"]["sos_rank"].')</div>
							<div class="col vote">'.$rider["vote"]["perc"].' ('.$rider["vote"]["pts"].')</div>
							<div class="col total">'.$rider["total"].'</div>
						</div>
					';
				} else {
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
				} // end if week>=6 //
				
				if ($rank==25) {
					//break;
				}
			} // end foreach
		$data.='
			</div><!-- .table-view -->		
		';
	?>
	
	<?php echo $data; ?>

	<!--
	<table class="table-view">
		<tr class="header">
			<td class="col rank">Rank</td>
			<td class="col name">Name</td>
			<td class="col pts">UCI Points</td>
			<td class="col races">Races</td>
			<td class="col win">Winning %</td>
			<td class="col sos">SOS % (Rank)</td>
			<td class="col vote">Vote (Points)</td>
			<td class="col total">Total</td>
		</tr>
		<?php $rank=0; ?>
		<?php foreach ($data as $rider) { ?>
			<?php $rank++; ?>
			<tr class="row">
				<td class="col rank"><?php echo $rank; ?>.</td>
				<td class="col name"><?php echo $rider["name"]; ?></td>
				<td class="col pts"><?php echo $rider["points"]; ?> (<?php echo $rider["points_perc"]; ?>)</td>
				<td class="col races"><?php echo $rider["races_total_perc"]; ?></td>
				<td class="col win"><?php echo $rider["winning_perc"]; ?></td>
				<td class="col sos"><?php echo $rider["sos"]["sos_perc"]; ?> (<?php echo $rider["sos"]["sos_rank"]; ?>)</td>
				<td class="col vote"><?php echo $rider["vote"]["perc"]; ?> (<?php echo$rider["vote"]["pts"]; ?>)</td>
				<td class="col total"><?php echo $rider["total"]; ?></td>
			</tr>
		<?php } ?>
	</table>
	-->
	<!--
	<div class="table-view">
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
		<?php foreach ($data as $rider) { ?>
			<?php $rank++; ?>
			<div class="row">
				<div class="col rank"><?php echo $rank; ?>.</div>
				<div class="col name"><?php echo $rider["name"]; ?></div>
				<div class="col pts"><?php echo $rider["points"]; ?> (<?php echo $rider["points_perc"]; ?>)</div>
				<div class="col races"><?php echo $rider["races_total_perc"]; ?></div>
				<div class="col win"><?php echo $rider["winning_perc"]; ?></div>
				<div class="col sos"><?php echo $rider["sos"]["sos_perc"]; ?> (<?php echo $rider["sos"]["sos_rank"]; ?>)</div>
				<div class="col vote"><?php echo $rider["vote"]["perc"]; ?> (<?php echo$rider["vote"]["pts"]; ?>)</div>
				<div class="col total"><?php echo $rider["total"]; ?></div>
			</div>
		<?php } ?>
	</div>
	-->
<?php } // end function // ?>
