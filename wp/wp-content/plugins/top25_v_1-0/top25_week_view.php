<?php
function top25_week_view() { 
	$id=$_GET["id"];
	
	global $wpdb;
	$wpdb->show_errors();

	$rank_table=$wpdb->prefix."top25_rank";
	
	$rank_db=$wpdb->get_row("SELECT data FROM $rank_table WHERE id='$id'");
	$data=unserialize($rank_db->data);
	?>

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
