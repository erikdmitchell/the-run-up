<?php
/**
 * template for my team page
 */

get_header();
?>

<div class="fantasy-cycling-my-team fc-template container team-id-<?php echo $fantasy_cycling_user_team->id; ?>">

	<h1 class="page-title"><?php echo $fantasy_cycling_user_team->name; ?></h1>

	<?php fc_my_team_message(); ?>

	<div class="row info">
		<div class="col-sm-4">
			<div class="budget">Budget: <span class="amount"><?php echo fantasy_cycling_format_cost($fantasy_cycling_user_team->budget); ?></span></div>

			<div id="my-team-ajax"></div>
		</div>
		<div class="col-sm-8">
			<div class="next-race">
				<span class="title">This Weeks Races:</span>
				<?php fc_races_this_week_display(); ?>
			</div>
		</div>
	</div>

	<div id="my-team-list" class="my-team-list"></div>

	<div class="row">
		<div class="col-xs-12 view-rider-modal">
			<a href="#" class="btn tru-add-riders-btn">View All Riders</a>
		</div>
	</div>

	<div class="row time-notice">
		<div class="col-xs-12">
			* All times EST. Current time is <?php echo date(get_option('time_format'), strtotime(current_time('mysql'))); ?>
		</div>
	</div>

	<div class="row help">
		<div class="col-xs-12 col-sm-2 strong">
			Helpful Links:
		</div>
		<div class="col-xs-12 col-sm-3 ">
			<a href="/how-to-create-my-team/">How to Create My Team</a>
		</div>
		<div class="col-xs-12 col-sm-3 ">
			<a href="/fantasy-cycling-strategy-guide/">Strategy Guide</a>
		</div>
	</div>

	<div class="tru-social-media-share row">
		<div class="col-xs-12">
			<div class="col-xs-6 share-title">Share Your Team:</div>
			<div class="col-xs-6 share-btns">
				<?php tru_social_media_share_button(array('url' => fc_get_team_link($fantasy_cycling_user_team->slug), 'text' => 'Check out my team: ')); ?>
				<?php tru_social_media_share_button(array(
					'type' => 'facebook',
					'url' => fc_get_team_link($fantasy_cycling_user_team->slug),
					'btn_text' => 'Share',
				)); ?>
			</div>
		</div>
	</div>

</div>

<?php do_action( 'addthis_widget', get_permalink(), get_the_title(), array(
    'type' => 'custom',
    'size' => '16', // size of the icons.  Either 16 or 32
    'services' => 'facebook,twitter,digg', // the services you want to always appear
    'preferred' => '7', // the number of auto personalized services
    'more' => true, // if you want to have a more button at the end
    'counter' => 'bubble_style' // if you want a counter and the style of it
    ));
?>

<?php get_footer(); ?>