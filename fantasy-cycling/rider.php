<?php
/**
 * template for rider page
 */

get_header(); ?>

<div class="fc-template fantasy-cycling-rider container">

	<?php if ($rider) : ?>

		<h1 class="page-title"><?php echo $rider->name; ?> <span class="flag"><?php fantasy_cycling_flag($rider->nat); ?></h1>

		<div class="fc-rider">

			<?php if (!empty($rider->rank)) : ?>
				<div class="row">
					<div class="col-xs-12 col-sm-4 fc-rider-stats">
						<h3>Stats</h3>

						<div class="row season">
							<div class="col-xs-2 col-sm-3 header">Season:</div>
							<div class="col-xs-10 col-sm-7"><?php echo $rider->rank->season; ?></div>
						</div>
						<div class="row rank">
							<div class="col-xs-2 col-sm-3 header">Rank:</div>
							<div class="col-xs-10 col-sm-7"><?php echo $rider->rank->rank; ?> <span class="icon"><?php echo $rider->rank->prev_icon; ?></span></div>
						</div>
						<div class="row points">
							<div class="col-xs-2 col-sm-3 header">Points:</div>
							<div class="col-xs-10 col-sm-7"><?php echo $rider->rank->points; ?></div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-4 championships">
						<h3>Championships</h3>

						<div class="row world-titles">
							<div class="col-xs-6 col-sm-9 header">World Titles:</div>
							<div class="col-xs-6 col-sm-3"><?php uci_results_display_total($rider->stats->world_champs); ?></div>
						</div>
						<div class="row world-cup-titles">
							<div class="col-xs-6 col-sm-9 header">World Cup Titles:</div>
							<div class="col-xs-6 col-sm-3"><?php uci_results_display_total($rider->stats->world_cup_titles); ?></div>
						</div>
						<div class="row superprestige-titles">
							<div class="col-xs-6 col-sm-9 header">Superprestige Titles:</div>
							<div class="col-xs-6 col-sm-3"><?php uci_results_display_total($rider->stats->superprestige_titles); ?></div>
						</div>
						<div class="row bpost-bank-titles">
							<div class="col-xs-6 col-sm-9 header">Gva/BPost Bank Titles:</div>
							<div class="col-xs-6 col-sm-3"><?php uci_results_display_total($rider->stats->gva_bpost_bank_titles); ?></div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-4 top-results">
						<h3>Top Results</h3>

						<div class="row wins">
							<div class="col-xs-6 col-sm-9 header">Wins:</div>
							<div class="col-xs-6 col-sm-3"><?php uci_results_display_total($rider->stats->wins); ?></div>
						</div>
						<div class="row podiums">
							<div class="col-xs-6 col-sm-9 header">Podiums:</div>
							<div class="col-xs-6 col-sm-3"><?php uci_results_display_total($rider->stats->podiums); ?></div>
						</div>
						<div class="row world-cup-wins">
							<div class="col-xs-6 col-sm-9 header">World Cup Wins:</div>
							<div class="col-xs-6 col-sm-3"><?php uci_results_display_total($rider->stats->world_cup_wins); ?></div>
						</div>
						<div class="row superprestige-wins">
							<div class="col-xs-6 col-sm-9 header">Superprestige Wins:</div>
							<div class="col-xs-6 col-sm-3"><?php uci_results_display_total($rider->stats->superprestige_wins); ?></div>
						</div>
						<div class="row bpost-bank-wins">
							<div class="col-xs-6 col-sm-9 header">GvA/BPost Bank Wins:</div>
							<div class="col-xs-6 col-sm-3"><?php uci_results_display_total($rider->stats->gva_bpost_bank_wins); ?></div>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="rider-results">

				<h3>Rider Results</h3>

				<?php if (!empty($rider->results)) : ?>
					<?php $rider_results=tru_group_results_by_season($rider->results); ?>

					<?php foreach ($rider_results as $season => $results) : ?>
						<div class="row">
							<div class="col-md-12"><h4><?php echo $season; ?></h4></div>
						</div>

						<div class="row header">
							<div class="col-xs-6 col-sm-6 race-name">Race</div>
							<div class="col-xs-2 col-sm-1 race-class">Class</div>
							<div class="hidden-xs col-sm-2 race-date">Date</div>
							<div class="col-xs-2 col-sm-1 rider-place">Place</div>
							<div class="col-xs-2 col-sm-2 rider-points">UCI Pts</div>
						</div>

						<?php foreach ($results AS $result) : ?>
							<?php
							if ($result->is_fantasy) :
								$class=' fantasy';
							else :
								$class='';
							endif;
							?>

							<div id="result-<?php echo $result->race_id; ?>" class="row<?php echo $class; ?> race">
								<div class="col-xs-6 col-sm-6 race-name">
									<span class="hidden-sm hidden-md hidden-lg"><?php //fantasy_cycling_flag($result->nat); ?></span>
									<a href="<?php echo fantasy_cycling_race_link($result->code); ?>"><?php echo $result->event; ?></a>
									<span class="hidden-xs"><?php //fantasy_cycling_flag($result->nat); ?></span>
								</div>
								<div class="col-xs-2 col-sm-1 race-class"><?php echo $result->class; ?></div>
								<div class="hidden-xs col-sm-2 race-date"><?php echo date('M. j, Y', strtotime($result->date)); ?></div>
								<div class="col-xs-2 col-sm-1 rider-place"><?php echo $result->place; ?></div>
								<div class="col-xs-2 col-sm-2 rider-points"><?php echo $result->par; ?></div>
							</div>
						<?php endforeach; ?>

						<div class="note">* fantasy races in <b>bold</b></div>
					<?php endforeach; ?>
				<?php else : ?>
					<div class="row no-race-results">
						<div class="col-xs-12">
							No race results for this rider.
						</div>
					</div>
				<?php endif; ?>
			</div>

		</div>

	<?php else : ?>
		<h1 class="page-title">Not Found</h1>

		<div class="not-found">Rider not found.</div>
	<?php endif; ?>

</div>

<?php get_footer(); ?>