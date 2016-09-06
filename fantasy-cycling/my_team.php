<?php
/**
 * template for my team page
 */

get_header();
?>

<div class="fantasy-cycling-my-team fc-template container team-id-<?php echo $fantasy_cycling_user_team->id; ?>">

	<h1 class="page-title"><?php echo $fantasy_cycling_user_team->name; ?></h1>

	<?php fc_my_team_message(); ?>

	<div class="row">
		<div class="col-xs-12 col-sm-4">
			<div class="budget">Budget: <span class="amount"><?php echo fantasy_cycling_format_cost($fantasy_cycling_user_team->budget); ?></span></div>

			<div id="my-team-ajax"></div>
		</div>
		<div class="col-xs-12 col-sm-8">
			<div class="next-race">
				<span class="title">Next Race:</span>
				<?php fantasy_cycling_next_race_display(); ?>
			</div>
		</div>
	</div>

	<div id="my-team-list" class="my-team-list"></div>

	<div class="time-notice">* All times EST - current time is <?php echo date(get_option('time_format'), strtotime(current_time('mysql'))); ?></div>

</div>

<?php get_footer(); ?>