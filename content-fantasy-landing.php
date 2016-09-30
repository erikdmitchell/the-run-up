<?php
global $fantasy_cycling_user_team, $fantasy_cycling_pages, $fantasy_cycling_schedule, $fantasy_cycling_next_race;

$teams=fantasy_cycling_standings(array(
	'per_page' => 15,
	'team_args' => array(
		'race_ids' => $fantasy_cycling_next_race->id,
		'show_empty' => false
	)
));
$team_standings=$fantasy_cycling_user_team->standing;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('tru-fantasy-main'); ?>>

	<div class="col-xs-12 col-md-8 main">

		<h2 class="team-name"><?php echo $fantasy_cycling_user_team->name; ?></h2>

		<div class="row team">
			<div class="col-xs-12">

				<a href="<?php echo get_permalink($fantasy_cycling_pages['my_team']); ?>" class="btn-tru">
					<?php tru_team_roster_button_text(); ?>
				</a>

				<div class="team-standings">
					Currently <?php echo $team_standings->rank; ?> overall with <?php echo $team_standings->overall_total; ?> points.
				</div>

			</div>
		</div>

		<div class="row standings">
			<div class="col-xs-12">
				<h3>Standings</h3>

				<div class="standings">

					<?php if ($teams) : ?>
						<div class="header row">
							<div class="col-xs-2 rank">Rank</div>
							<div class="col-xs-8 team-name">Name</div>
							<div class="col-xs-2 team-points">Points</div>
						</div>

						<?php foreach ($teams as $team) : ?>
							<div id="team-<?php echo $team->slug; ?>" class="row">
								<div class="col-xs-2 rank"><?php echo $team->rank; ?></div>
								<div class="col-xs-8 team-name"><a href="<?php fantasy_cycling_team_link($team->slug); ?>"><?php echo $team->name; ?></a></div>
								<div class="col-xs-2 team-points"><?php echo $team->race_total; ?></div>
							</div>
						<?php endforeach; ?>

					<?php else : ?>
						<div class="not-found">No current standings.</div>
					<?php endif; ?>
				</div>

			</div>
		</div>

	</div>

	<div class="col-xs-12 col-md-4 right">

		<div class="row action">
			<div class="col-xs-12">
				<a href="/how-to-create-my-team/" class="btn-tru">How to Create My Team</a>
			</div>
			<div class="col-xs-12">
				<a href="/fantasy-cycling-strategy-guide/" class="btn-tru">Strategy Guide</a>
			</div>
		</div>

		<div class="row news">
			<div class="col-xs-12">
				<?php $news=tru_get_news(); ?>

				<h3>News</h3>

				<ul class="news-list">
					<?php foreach ($news as $post) : ?>
						<li id="post-<?php echo $post->ID; ?>">
							<div class="title"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<div class="row schedule">
			<div class="col-xs-12">
				<?php $counter=0; ?>

				<h3>Upcoming Races</h3>

				<ul class="upcoming-races">
					<?php foreach ($fantasy_cycling_schedule as $race) : ?>
						<li id="race-<?php echo $race->id; ?>">
							<?php echo $race->name; ?> (<?php echo date('M. j, Y', strtotime($race->date)); ?>)
						</li>

						<?php $counter++; ?>
						<?php if ($counter>=10) { break; } ?>
					<?php endforeach; ?>

					<a href="<?php fc_schedule_link(); ?>">View Full Schedule</a>
				</ul>
			</div>
		</div>
	</div>

</article>