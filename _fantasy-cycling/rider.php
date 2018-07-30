<?php
/**
 * template for rider page
 */

get_header(); ?>

<div class="fc-template fantasy-cycling-rider container">

	<?php if ($rider) : ?>

		<h1 class="page-title"><?php echo $rider->name; ?> <span class="flag hidden-xs"><?php fantasy_cycling_flag($rider->nat); ?></h1>

		<div class="fc-rider">

			<?php if (!empty($rider->rank)) : ?>
				<div class="row">
					<div class="col-xs-12 fc-rider-stats">
						<h3>Stats</h3>

						<div class="row rank">
							<div class="col-xs-5 col-sm-3 col-md-2 header">Rank</div>
							<div class="col-xs-7"><?php echo $rider->rank->rank; ?> <span class="icon"><?php echo $rider->rank->prev_icon; ?></span></div>
						</div>
						<div class="row uci-rank">
							<div class="col-xs-5 col-sm-3 col-md-2 header">UCI Rank</div>
							<div class="col-xs-7"><?php echo $rider->uci_rank; ?></div>
						</div>
						<div class="row perc-owned">
							<div class="col-xs-5 col-sm-3 col-md-2 header">Percent Owned</div>
							<div class="col-xs-7"><?php echo $rider->fantasy->perc_owned; ?></div>
						</div>
						<div class="row wins">
							<div class="col-xs-5 col-sm-3 col-md-2 header">Wins</div>
							<div class="col-xs-7"><?php echo $rider->fantasy->wins; ?></div>
						</div>
						<div class="row podiums">
							<div class="col-xs-5 col-sm-3 col-md-2 header">Podiums</div>
							<div class="col-xs-7"><?php echo $rider->fantasy->podiums; ?></div>
						</div>
						<div class="row value">
							<div class="col-xs-5 col-sm-3 col-md-2 header">Value</div>
							<div class="col-xs-7"><?php echo $rider->fantasy->cost; ?></div>
						</div>
						<div class="row points">
							<div class="col-xs-5 col-sm-3 col-md-2 header">Points</div>
							<div class="col-xs-7"><?php echo $rider->fantasy->points; ?></div>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="rider-fantasy-results">

				<h3>Fantasy Results</h3>

				<?php if (!empty($rider->fantasy_results)) : ?>
					<div class="row header">
						<div class="col-xs-6 col-sm-5 race-name">Race</div>
						<div class="col-xs-4 col-sm-2 race-date">Date</div>
						<div class="hidden-xs col-sm-1 rider-start">Start</div>
						<div class="hidden-xs col-sm-1 rider-finish">Finish</div>
						<div class="hidden-xs col-sm-1 rider-place-diff">Diff.</div>
						<div class="hidden-xs col-sm-1 rider-points">Pts.</div>
						<div class="col-xs-2 col-sm-1 rider-total">Total</div>
					</div>

					<?php foreach ($rider->fantasy_results AS $result) : ?>
						<div id="result-<?php echo $result->race_id; ?>" class="row race">
							<div class="col-xs-6 col-sm-5 race-name"><a href="<?php fantasy_cycling_race_link($result->code); ?>"><?php echo $result->name; ?></a></div>
							<div class="col-xs-4 col-sm-2 race-date"><?php fc_race_date_formatted($result->date); ?></div>
							<div class="hidden-xs col-sm-1 rider-start"><?php echo $result->start_position; ?></div>
							<div class="hidden-xs col-sm-1 rider-finish"><?php echo $result->place; ?></div>
							<div class="hidden-xs col-sm-1 rider-place-diff"><?php echo $result->place_differential; ?></div>
							<div class="hidden-xs col-sm-1 rider-points"><?php echo $result->points; ?></div>
							<div class="col-xs-2 col-sm-1 rider-total"><?php echo $result->total_points; ?></div>
						</div>
					<?php endforeach; ?>
				<?php else : ?>
					<div class="no-fantasy-results">No fantasy race results for this rider.</div>
				<?php endif; ?>
			</div>

			<div class="rider-results">

				<h3>All Results</h3>

				<?php if (!empty($rider->results)) : ?>
					<div class="row header">
						<div class="col-xs-6 col-sm-4 col-md-5 race-name">Race</div>
						<div class="hidden-xs col-sm-2 col-md-1 race-class">Class</div>
						<div class="col-xs-4 col-sm-2 race-date">Date</div>
						<div class="col-xs-2 col-sm-2 rider-place">Place</div>
						<div class="hidden-xs col-sm-2 rider-uci-points">UCI Points</div>
					</div>

					<?php foreach ($rider->results AS $result) : ?>
						<div id="result-<?php echo $result->race_id; ?>" class="row race">
							<div class="col-xs-6 col-sm-4 col-md-5 race-name"><a href="<?php fantasy_cycling_race_link($result->code, $result->is_fantasy); ?>"><?php echo $result->event; ?></a></div>
							<div class="hidden-xs col-sm-2 col-md-1 race-class"><?php echo $result->class; ?></div>
							<div class="col-xs-4 col-sm-2 race-date"><?php fc_race_date_formatted($result->date); ?></div>
							<div class="col-xs-2 col-sm-2 rider-place"><?php echo $result->place; ?></div>
							<div class="hidden-xs col-sm-2 rider-uci-points"><?php echo $result->par; ?></div>
						</div>
					<?php endforeach; ?>
				<?php else : ?>
					<div class="row no-race-results">
						<div class="col-xs-12">
							No race results for this rider.
						</div>
					</div>
				<?php endif; ?>
			</div>




	<?php else : ?>
		<h1 class="page-title">Not Found</h1>

		<div class="not-found">Rider not found.</div>
	<?php endif; ?>

</div>

<?php get_footer(); ?>