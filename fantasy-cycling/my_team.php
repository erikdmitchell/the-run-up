<?php
/**
 * template for my team page
 */

get_header();
?>

<div class="fantasy-cycling-my-team fc-template container team-id-<?php echo $fantasy_cycling_user_team->id; ?>">

	<h1 class="page-title"><?php echo $fantasy_cycling_user_team->name; ?></h1>

	<div class="row">
		<div class="col-xs-12 col-sm-4">
			<div class="budget">Budget: <span class="amount"><?php echo fantasy_cycling_format_cost($fantasy_cycling_user_team->budget); ?></span></div>

			<?php fc_my_team_message(); ?>
			<div id="my-team-ajax"></div>
		</div>
		<div class="col-xs-12 col-sm-8">
			<div class="next-race">
				<span class="title">Next Race:</span>
				<?php fantasy_cycling_next_race_display(); ?>
			</div>
		</div>
	</div>

	<div class="my-team-list">
		<div class="row header">
			<div class="col-xs-2 col-sm-1">&nbsp;</div>
			<div class="col-xs-8 col-sm-4 name">Name</div>
			<div class="col-xs-2 col-sm-1 proj">Proj.</div>
			<div class="hidden-xs col-sm-1 rank">Rank</div>
			<div class="hidden-xs col-sm-1 points">Points</div>
			<div class="hidden-xs col-sm-1 last-year">Last Year</div>
			<div class="hidden-xs col-sm-3 last-race">Last Race</div>
		</div>

		<?php foreach ($fantasy_cycling_user_team->riders as $key => $rider) : ?>

			<div id="rider-row-<?php echo $key; ?>" class="row rider">
				<?php if ($rider->id) : ?>

					<div class="col-xs-2 col-sm-1 add-remove">
						<?php fantasy_cycling_display_add_remove($rider); ?>
					</div>
					<div class="col-xs-8 col-sm-4 name">
						<a href="<?php fantasy_cycling_rider_link($rider->slug); ?>"><?php echo $rider->name; ?></a>
						<span class="country"><?php fantasy_cycling_flag($rider->nat); ?></span>
					</div>
					<div class="col-xs-2 col-sm-1 proj"><?php echo fantasy_cycling_get_rider_place_prediction($fantasy_cycling_next_race->id, $rider->id); ?></div>
				<?php else :?>

					<div class="col-xs-12 add-remove">
						<?php fantasy_cycling_display_add_remove($rider); ?>
					</div>

				<?php endif; ?>

				<div class="hidden-xs col-sm-1 rank"><?php echo $rider->rank->rank; ?><?php echo $rider->rank->prev_icon; ?></div>
				<div class="hidden-xs col-sm-1 points"><?php echo $rider->rank->points; ?></div>
				<div class="hidden-xs col-sm-1 last-year"><?php echo $rider->last_year_result->place; ?></div>
				<div class="hidden-xs col-sm-3 last-race">
					<?php if ($rider->last_result->code) : ?>
						<?php echo $rider->last_result->place; ?> (<a href="<?php echo fantasy_cycling_race_link($rider->last_result->code); ?>"><?php echo fc_trim_string($rider->last_result->event, 18); ?></a>)
					<?php endif; ?>
				</div>

				<input type="hidden" class="rider-id" value="<?php echo $rider->id; ?>" />
			</div>
		<?php endforeach; ?>
	</div>

</div>

<?php get_footer(); ?>