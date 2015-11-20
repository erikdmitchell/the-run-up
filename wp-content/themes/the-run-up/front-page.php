<?php
/**
 * Template Name: Front Page
**/
?>
<?php get_header(); ?>

<?php //get_template_part('content','slider'); ?>


<div class="container home-featured-wrap">
	<?php echo get_home_featured(); ?>
</div>

<div class="container-fluid results-rankings">
	<div class="container">
		<div class="row">

			<?php
			global $RiderStats,$RaceStats;

			$season=get_query_var('season','2015/2016');
			$current_week=uci_get_current_week($season);
			$rider_results=$RiderStats->get_riders_from_weekly_rank(array(
				'per_page' => 10,
				'season' => $season,
				'week' => $current_week
			));
			$race_results=$RaceStats->get_races(array(
				'per_page' => 10,
			));
			?>

			<div class="col-md-12">
				<h2>UCI Cross Rankings</h2>
			</div>

			<div class="col-md-6">
				<div class="rider-rankings-list">
					<h3>Rider Rankings</h3>
					<div class="header row">
						<div class="rank col-md-1">Rank</div>
						<div class="rider col-md-5">Rider</div>
						<div class="nat col-md-1">Nat</div>
						<div class="total col-md-1">Total</div>
					</div>

					<?php foreach ($rider_results as $rider) : ?>
						<div class="row">
							<div class="rank col-md-1"><?php echo $rider->rank; ?></div>
							<div class="rider col-md-5"><a href="<?php echo single_rider_link($rider->rider,$season); ?>"><?php echo $rider->rider; ?></a></div>
							<div class="nat col-md-1"><a href="<?php echo single_country_link($rider->nat,$season); ?>"><?php echo get_country_flag($rider->nat); ?></a></div>
							<div class="total col-md-1"><?php echo number_format($rider->total,3); ?></div>
						</div>
					<?php endforeach; ?>
					<a class="view-all" href="/uci-cross-rankings/rider-rankings/">View All Riders &raquo;</a>
				</div><!-- .rider-rankings-list -->
			</div><!-- .col -->

			<div class="race-rankings-list col-md-6">
				<h3>Race Results</h3>
				<div id="season-race-rankings" class="season-race-rankings">
					<div class="header row">
						<div class="name col-md-7">Name</div>
						<div class="date col-md-3">Date</div>
						<div class="nat col-md-1">Nat</div>
						<div class="class col-md-1">Class</div>
					</div>

					<?php foreach ($race_results as $race) : ?>
						<div class="row">
							<div class="name col-md-7"><a href="<?php echo single_race_link($race->code); ?>"><?php echo $race->name; ?></a></div>
							<div class="date col-md-3"><?php echo $race->date; ?></div>
							<div class="nat col-md-1"><?php echo get_country_flag($race->nat); ?></div>
							<div class="class col-md-1"><?php echo $race->class; ?></div>
						</div>
					<?php endforeach; ?>
					<a class="view-all" href="/uci-cross-rankings/race-rankings/">View All Races &raquo;</a>
				</div><!-- .season-race-rankings -->
			</div><!-- .col -->

		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- .container-fluid -->
<!--
<div class="container rider-diaries-wrap">
	<div class="row">
		<div class="col-md-12">
			<h2 class="page-title">Rider Diaries</h2>
			<?php //echo get_home_rider_diaries(); ?>
		</div>
	</div>
</div>
-->

<div class="container-fluid partners">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-title"><?php echo get_the_title(16); ?></h2>
				<?php echo get_partners(); ?>
			</div>
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- .container-fluid -->

<?php get_footer(); ?>