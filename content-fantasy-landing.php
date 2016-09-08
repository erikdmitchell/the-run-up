<?php global $fantasy_cycling_user_team, $fantasy_cycling_pages, $fantasy_cycling_schedule; ?>
<?php	$teams=fantasy_cycling_standings(array('per_page' => 15)); ?>
<?php $team_standings=$fantasy_cycling_user_team->standing; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('tru-fantasy-main'); ?>>

	<div class="col-md-8 main">

		<h2 class="team-name"><?php echo $fantasy_cycling_user_team->name; ?></h2>

		<div class="col-md-12 team">

			<a href="<?php echo get_permalink($fantasy_cycling_pages['my_team']); ?>" class="btn-tru">
				<?php tru_team_roster_button_text(); ?>
			</a>

			<div class="team-standings">
				Currently <?php echo $team_standings->rank; ?> overall with <?php echo $team_standings->overall_total; ?> points.
			</div>

		</div>

		<div class="standings">
			<div class="col-md-12">
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
								<div class="col-xs-2 team-points"><?php echo $team->overall_total; ?></div>
							</div>
						<?php endforeach; ?>

					<?php else : ?>
						<div class="not-found">No current standings.</div>
					<?php endif; ?>
				</div>

			</div>
		</div>

	</div>

	<div class="col-md-4 right">

		<div class="row news">
			<?php $news=tru_get_news(); ?>

			<h3>News</h3>

			<ul class="news-list">
				<?php foreach ($news as $post) : ?>
					<li id="post-<?php echo $post->ID; ?>">
						<div class="title"><?php echo $post->post_title; ?></div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="row schedule">
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
			</ul>
		</div>
	</div>

</article>