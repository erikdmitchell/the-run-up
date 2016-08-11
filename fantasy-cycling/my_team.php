<?php
/**
 * template for my team page
 */

get_header();

$user_team=fantasy_cycling_get_user_team();
$next_race=fantasy_cycling_get_next_race();

if (get_option('fc_lock_teams')) :
	$add_remove_class='disabled';
	$my_team_message=__('You cannot edit your roster because there is a race in action', 'fantasy-cycling');
else :
	$add_remove_class='';
	$my_team_message='';
endif;
?>

<div class="fantasy-cycling-my-team fc-template container team-id-<?php echo $user_team->id; ?>">

	<h1 class="page-title"><?php echo $user_team->name; ?></h1>

	<div class="row">
		<div class="col-xs-12 col-sm-4">
			<div class="budget">Budget: <span class="amount"><?php echo fantasy_cycling_format_cost($user_team->budget); ?></span></div>

			<div class="my-team-message warning"><?php echo $my_team_message; ?></div>
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

		<?php foreach ($user_team->riders as $key => $rider) : ?>
			<?php $last_year_result=fantasy_cycling_get_race_result($rider->id, $next_race->last_year_code); ?>
			<?php $last_race=fantasy_cycling_last_result($rider->id); ?>

			<div id="rider-row-<?php echo $key; ?>" class="row rider">
				<?php if ($rider->id) : ?>

					<div class="col-xs-2 col-sm-1 add-remove">
						<?php fantasy_cycling_display_add_remove($rider, $add_remove_class); ?>
					</div>
					<div class="col-xs-8 col-sm-4 name">
						<a href="<?php fantasy_cycling_rider_link($rider->slug); ?>"><?php echo $rider->name; ?></a>
						<span class="country"><?php fantasy_cycling_flag($rider->nat); ?></span>
					</div>
					<div class="col-xs-2 col-sm-1 proj"><?php echo fantasy_cycling_get_rider_place_prediction($next_race->id, $rider->id); ?></div>
				<?php else :?>

					<div class="col-xs-12 add-remove">
						<?php fantasy_cycling_display_add_remove($rider, $add_remove_class); ?>
					</div>

				<?php endif; ?>

				<div class="hidden-xs col-sm-1 rank"><?php echo $rider->rank->rank; ?><?php echo $rider->rank->prev_icon; ?></div>
				<div class="hidden-xs col-sm-1 points"><?php echo $rider->rank->points; ?></div>
				<div class="hidden-xs col-sm-1 last-year"><?php echo $last_year_result->place; ?></div>
				<div class="hidden-xs col-sm-3 last-race">
					<?php if ($last_race->code) : ?>
						<?php echo $last_race->place; ?> (<a href="<?php echo fantasy_cycling_race_link($last_race->code); ?>"><?php echo fc_trim_string($last_race->event, 18); ?></a>)
					<?php endif; ?>
				</div>

				<input type="hidden" class="rider-id" value="<?php echo $rider->id; ?>" />
			</div>
		<?php endforeach; ?>
	</div>

</div>

<?php get_footer(); ?>