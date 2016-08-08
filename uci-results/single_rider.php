<?php
/**
 * The template for the single rider page
 *
 * It can be overriden
 *
 * @since 2.0.0
 */

get_header(); ?>

<?php
global $ucicurl_riders;

$rider=$ucicurl_riders->get_rider(array(
	'rider_id' => get_query_var('rider_slug'),
	'results' => true,
	'results_season' => '',
	'ranking' => true,
	'stats' => true
));
?>

<div class="container uci-results uci-results-rider">

	<?php if ($rider) : ?>
		<div id="rider-<?php echo $rider->id; ?>" class="em-row rider-stats">
			<div class="col-xs-12 col-sm-4 general">
				<h1 class="page-title"><?php echo ucicurl_rider_slug_to_name(get_query_var('rider_slug')); ?></h1>

				<div class="country"><span class="label">Nationality:</span> <a href="<?php echo uci_results_country_url($rider->nat); ?>"><?php echo uci_results_get_country_flag($rider->nat); ?></a></div>
				<div class="rank"><span class="label">Ranking:</span> <?php echo $rider->rank->rank; ?></div>
			</div>
			<div class="col-xs-12 col-sm-4 championships">
				<h4>Championships</h4>

				<div class="world-titles"><span class="label">World Titles:</span> <?php uci_results_display_total($rider->stats->world_champs); ?></div>
				<div class="world-cup-titles"><span class="label">World Cup Titles:</span> <?php uci_results_display_total($rider->stats->world_cup_titles); ?></div>
				<div class="superprestige-titles"><span class="label">Superprestige Titles:</span> <?php uci_results_display_total($rider->stats->superprestige_titles); ?></div>
				<div class="bpost-bank-titles"><span class="label">Gva/BPost Bank Titles:</span> <?php uci_results_display_total($rider->stats->gva_bpost_bank_titles); ?></div>
			</div>
			<div class="col-xs-12 col-sm-4 top-results">
				<h4>Top Results</h4>

				<div class="wins"><span class="label">Wins:</span> <?php uci_results_display_total($rider->stats->wins); ?></div>
				<div class="podiums"><span class="label">Podiums:</span> <?php uci_results_display_total($rider->stats->podiums); ?></div>
				<div class="world-cup-wins"><span class="label">World Cup Wins:</span> <?php uci_results_display_total($rider->stats->world_cup_wins); ?></div>
				<div class="superprestige-wins"><span class="label">Superprestige Wins:</span> <?php uci_results_display_total($rider->stats->superprestige_wins); ?></div>
				<div class="bpost-bank-wins"><span class="label">GvA/BPost Bank Wins:</span> <?php uci_results_display_total($rider->stats->gva_bpost_bank_wins); ?></div>
			</div>
		</div>

		<?php if (isset($rider->results) && count($rider->results)) : ?>
			<div class="single-rider-results">
				<h3>Results</h3>

				<div class="em-row header">
					<div class="col-xs-3 col-sm-2 race-date">Date</div>
					<div class="col-xs-5 col-sm-5 race-name">Event</div>
					<div class="col-xs-2 col-sm-1 rider-place">Place</div>
					<div class="col-xs-2 col-sm-1 rider-points">Pts.</div>
					<div class="hidden-xs col-sm-1 race-class">Class</div>
					<div class="hidden-xs col-sm-2 race-season">Season</div>
				</div>

				<?php foreach ($rider->results as $result) : ?>
					<div class="em-row">
						<div class="col-xs-3 col-sm-2 race-date"><?php echo date('M j, Y', strtotime($result->date)); ?></div>
						<div class="col-xs-5 col-sm-5 race-name">
							<a href="<?php uci_results_race_url($result->race_id); ?>"><?php echo $result->event; ?></a>
							<span class="nat">
								<a href="<?php echo uci_results_country_url($result->nat); ?>"><?php echo uci_results_get_country_flag($result->nat); ?></a>
							</span>
						</div>
						<div class="col-xs-2 col-sm-1 rider-place"><?php echo $result->place; ?></div>
						<div class="col-xs-2 col-sm-1 rider-points"><?php echo $result->par; ?></div>
						<div class="hidden-xs col-sm-1 race-class"><?php echo $result->class; ?></div>
						<div class="hidden-xs col-sm-2 race-season"><?php echo $result->season; ?></div>
					</div>
				<?php endforeach; ?>

			</div>
		<?php else :?>
			<div class="none-found">No results.</div>
		<?php endif; ?>

	<?php else : ?>
		<div class="none-found">Rider not found.</div>
	<?php endif; ?>
</div>

<?php get_footer(); ?>