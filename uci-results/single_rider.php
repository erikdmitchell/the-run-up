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

<div class="uci-results uci-results-rider container">

	<?php if ($rider) : ?>
		<div class="em-row rider-stats">
			<div class="em-col-md-4 general">
				<h1 class="page-title"><?php echo ucicurl_rider_slug_to_name(get_query_var('rider_slug')); ?></h1>

				<div class="country"><span class="label">Nationality:</span> <a href="<?php echo uci_results_country_url($rider->nat); ?>"><?php echo uci_results_get_country_flag($rider->nat); ?></a></div>
				<div class="rank"><span class="label">Ranking:</span> <?php echo $rider->rank->rank; ?></div>
			</div>
			<div class="em-col-md-4 top-results">
				<h4>Top Results</h4>
				top results coming soon
			</div>
			<div class="em-col-md-4 key-stats">
				<h4>Key Stats</h4>
				<div class="wins"><span class="label">Wins:</span> <?php echo count($rider->stats->wins); ?></div>
				<div class="podiums"><span class="label">Podiums:</span> <?php echo count($rider->stats->podiums); ?></div>
			</div>
		</div>

		<?php if (isset($rider->results) && count($rider->results)) : ?>
			<div class="single-rider-results">
				<h3>Results</h3>

				<div class="em-row header">
					<div class="em-col-md-2 race-date">Date</div>
					<div class="em-col-md-5 race-name">Event</div>
					<div class="em-col-md-1 rider-place">Place</div>
					<div class="em-col-md-1 rider-points">Points</div>
					<div class="em-col-md-1 race-class">Class</div>
					<div class="em-col-md-2 race-season">Season</div>
				</div>

				<?php foreach ($rider->results as $result) : ?>
					<div class="em-row">
						<div class="em-col-md-2 race-date"><?php echo date(get_option('date_format'), strtotime($result->date)); ?></div>
						<div class="em-col-md-5 race-name"><a href="<?php uci_results_race_url($result->race_id); ?>"><?php echo $result->event; ?></a></div>
						<div class="em-col-md-1 rider-place"><?php echo $result->place; ?></div>
						<div class="em-col-md-1 rider-points"><?php echo $result->par; ?></div>
						<div class="em-col-md-1 race-class"><?php echo $result->class; ?></div>
						<div class="em-col-md-2 race-season"><?php echo $result->season; ?></div>
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