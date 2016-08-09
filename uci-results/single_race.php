<?php
/**
 * The template for the single race page
 *
 * It can be overriden
 *
 * @since 2.0.0
 */

get_header(); ?>

<?php
global $ucicurl_races;

$race=$ucicurl_races->get_race(get_query_var('race_code'));
?>

<div class="container uci-results uci-results-race">

	<?php if (!$race) : ?>
		<div class="race-results-not-found">Race results not found.</div>
	<?php else : ?>
		<h1 class="page-title"><?php echo $race->event; ?><span class="flag"><?php echo uci_results_get_country_flag($race->nat); ?></span></h1>

		<div class="row race-details">
			<div class="col-xs-5 col-sm-2 race-date"><?php echo date('M j, Y', strtotime($race->date)); ?></div>
			<div class="col-xs-2 col-sm-1 race-class">(<?php echo $race->class; ?>)</div>
		</div>

		<div class="single-race">
			<div class="row header">
					<div class="col-xs-2 rider-place">Place</div>
					<div class="col-xs-5 rider-name">Rider</div>
					<div class="col-xs-2 col-sm-1 rider-points">Points</div>
					<div class="hidden-xs col-sm-2 rider-age">Age</div>
					<div class="col-xs-3 col-sm-2 rider-time">Time</div>
			</div>

			<?php foreach ($race->results as $result) : ?>
				<div class="row rider-results">
					<div class="col-xs-2 rider-place"><?php echo $result->place; ?></div>
					<div class="col-xs-5 rider-name">
						<a href="<?php echo uci_results_rider_url($result->slug); ?>"><?php echo $result->name; ?></a>
						<span class="hidden-xs nat">
							<a href="<?php echo uci_results_country_url($result->nat); ?>"><?php echo uci_results_get_country_flag($result->nat); ?></a>
						</span>
					</div>
					<div class="col-xs-2 col-sm-1 rider-points"><?php echo $result->points; ?></div>
					<div class="hidden-xs col-sm-2 rider-age"><?php echo $result->age; ?></div>
					<div class="col-xs-3 col-sm-2 rider-time"><?php echo $result->time; ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>

<?php get_footer(); ?>