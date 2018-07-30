<?php
/**
 * template for race page
 */

get_header();
?>

<div class="fc-template fantasy-cycling-race container">

	<?php if ($race) : ?>
		<h1 class="page-title"><?php echo stripslashes($race->name); ?> <span class="flag"><?php fantasy_cycling_flag($race->nat); ?></h1>

		<div class="race-upper row">
			<div class="col-md-6 race-details">
				<div class="row">
					<div class="col-xs-2 header">Class:</div>
					<div class="col-xs-4"><?php echo $race->class; ?></div>
				</div>
				<div class="row">
					<div class="col-xs-2 header">Date:</div>
					<div class="col-xs-4"><?php fc_race_date_formatted($race->date); ?></div>
				</div>
				<div class="row">
					<div class="col-xs-2 header">Time:</div>
					<div class="col-xs-4"><?php fc_race_time_formatted($race->time); ?></div>
				</div>
			</div>

			<div class="col-md-6 race-links">
				<?php if ($race->fc_results) : ?>
					<div class="row">
						<div class="col-xs-12"><a href="#fantasy-results">Fantasy Results</a></div>
					</div>
				<?php endif; ?>

				<?php if ($race->has_results && !empty($race->results)) : ?>
					<div class="row">
						<div class="col-xs-12"><a href="#race-results">Race Results</a></div>
					</div>
				<?php elseif ($race->has_predictions && !empty($race->predictions)) : ?>
					<div class="row">
						<div class="col-xs-12"><a href="#race-predictions">Race Predictions</a></div>
					</div>
				<?php endif; ?>

				<?php if (!empty($race->related)) : ?>
					<div class="row">
						<div class="col-xs-12"><a href="#race-history">Race History</a></div>
					</div>
				<?php endif; ?>
			</div>

		</div>

		<?php if ($race->scored) : ?>
			<div class="fantasy-results">
				<a name="fantasy-results"></a>
				<h3>Fantasy Results</h3>
	
				<?php if ($race->fc_results) : ?>
					<div class="row header team">
						<div class="col-xs-2 col-sm-1 rank">Rank</div>
						<div class="col-xs-5 col-sm-4 team-name">Name</div>
						<div class="col-xs-3 col-sm-3 col-md-2 team-points">Points</div>
					</div>
	
					<?php foreach ($race->fc_results AS $team) : ?>
						<div id="team-<?php echo $team->team_id; ?>" class="row team">
							<div class="col-xs-2 col-sm-1 rank"><?php echo $team->rank; ?></div>
							<div class="col-xs-5 col-sm-4 team-name"><a href="<?php echo fantasy_cycling_team_link($team->slug); ?>"><?php echo $team->name; ?></a></div>
							<div class="col-xs-3 col-sm-3 col-md-2 team-points"><?php echo $team->points; ?></div>
						</div>
					<?php endforeach; ?>
				<?php else : ?>
					<div class="no-race-results">No fantasy results.</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ($race->has_results) : ?>
			<div class="race-results">
				<a name="race-results"></a>
				<h3>Race Results</h3>
	
				<?php if (!empty($race->results)) : ?>
					<div class="row header rider">
						<div class="col-xs-2 col-sm-1 rider-place">Place</div>
						<div class="col-xs-5 col-sm-4 rider-name">Name</div>
						<div class="hidden-xs col-sm-1 rider-nat">Nat</div>
						<div class="hidden-xs col-sm-1 rider-time">Time</div>
						<div class="col-xs-2 col-sm-2 rider-uci-points">UCI Points</div>
						<div class="col-xs-3 col-sm-3 col-md-2 rider-fantasy-points">Fantasy Points</div>
					</div>
	
					<?php foreach ($race->results AS $key => $rider) : ?>
						<div id="result-<?php echo $key; ?>" class="row rider">
							<div class="col-xs-2 col-sm-1 rider-place"><?php echo $rider->place; ?></div>
							<div class="col-xs-5 col-sm-4 rider-name"><a href="<?php fantasy_cycling_rider_link($rider->slug); ?>"><?php echo $rider->name; ?></a></div>
							<div class="hidden-xs col-sm-1 rider-nat"><?php echo $rider->nat; ?></div>
							<div class="hidden-xs col-sm-1 rider-time"><?php echo $rider->time; ?></div>
							<div class="col-xs-2 col-sm-2 rider-uci-points"><?php echo $rider->points; ?></div>
							<div class="col-xs-3 col-sm-3 col-md-2 rider-fantasy-points"><?php echo $rider->total_points; ?></div>
						</div>
					<?php endforeach; ?>
				<?php else : ?>
					<div class="no-race-results">No race results.</div>
				<?php endif; ?>
			</div>
		<?php elseif ($race->has_predictions) : ?>
			<div class="race-predictions">
				<a name="race-predictions"></a>
				<h3>Race Predictions</h3>
	
				<?php if (!empty($race->predictions)) : ?>
					<div class="row header rider">
						<div class="col-xs-4 col-sm-2 col-md-1 proj-finish">Finish</div>
						<div class="col-xs-8 col-sm-4 name">Rider</div>
						<div class="hidden-xs col-sm-2 perc-of-winning">% of Winning</div>
						<div class="hidden-xs col-sm-2 start-position">Start Position</div>
						<div class="hidden-xs col-sm-2 uci-rank">UCI Rank</div>										
					</div>
	
					<?php foreach ($race->predictions as $rider) : ?>
						<div id="rider-<?php echo $rider->rider_id; ?>" class="row rider">
							<div class="col-xs-4 col-sm-2 col-md-1 proj-finish"><?php echo $rider->projected_finish; ?></div>
							<div class="col-xs-8 col-sm-4 name"><a href="<?php fantasy_cycling_rider_link($rider->slug); ?>"><?php echo $rider->name; ?></a></div>
							<div class="hidden-xs col-sm-2 perc-of-winning"><?php echo $rider->percent_of_winning; ?></div>
							<div class="hidden-xs col-sm-2 start-position"><?php echo $rider->start_position; ?></div>
							<div class="hidden-xs col-sm-2 uci-rank"><?php echo $rider->uci_rank; ?></div>
						</div>
					<?php endforeach; ?>
				<?php else : ?>
					No race history.
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="race-history">
			<a name="race-history"></a>
			<h3>Race History</h3>

			<?php if (!empty($race->related)) : ?>
				<div class="row header race">
					<div class="col-xs-8 col-sm-5 col-md-4">Race</div>
					<div class="col-xs-4 col-sm-2 col-md-2">Date</div>
					<div class="hidden-xs col-sm-3 col-md-3">Winner</div>
					<div class="hidden-xs col-sm-2 col-md-3">Series</div>
				</div>

				<?php foreach ($race->related as $r_race) : ?>
					<div id="race-<?php echo $r_race->id; ?>" class="row race">
						<div class="col-xs-8 col-sm-5 col-md-4"><a href="<?php echo fantasy_cycling_get_race_link($r_race->code, $r_race->is_fantasy); ?>"><?php echo $r_race->event; ?></a></div>
						<div class="col-xs-4 col-sm-2 col-md-2"><?php fc_race_date_formatted($r_race->date); ?></div>
						<div class="hidden-xs col-sm-3 col-md-3"><?php echo fc_uci_race_get_winner($r_race); ?></div>
						<div class="hidden-xs col-sm-2 col-md-3"><?php echo fantasy_cycling_get_series_name($r_race->series_id); ?></div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				No race history.
			<?php endif; ?>
		</div>
	<?php else : ?>
		<h1 class="page-title">Not Found</h1>

		<div class="not-found">Race not found.</div>
	<?php endif; ?>

</div>

<?php get_footer(); ?>