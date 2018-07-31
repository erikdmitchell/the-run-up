<?php
global $fantasy_cycling_schedule, $fantasy_cycling_next_race;

$teams=fantasy_cycling_standings(array(
	'per_page' => 15,
	'team_args' => array(
		'race_ids' => $fantasy_cycling_next_race->id,
		'show_empty' => false
	)
));
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('tru-fantasy-main'); ?>>

	<div class="col-xs-12 col-md-8 main">
		<?php get_template_part('template-parts/fantasy-home/user', 'team'); ?>
		<?php get_template_part('fantasy-home/overall', 'standings'); ?>
		<?php get_template_part('fantasy-home/recent', 'results'); ?>
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
							<div class="race-date"><?php echo date('M. j, Y', strtotime($race->date)); ?></div>
							<div class="race-name"><a href="<?php echo fantasy_cycling_get_race_link($race->code); ?>"><?php echo stripslashes($race->name); ?></a></div>
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