<?php
$team_name=(!empty($_POST['first_name'])) ? trim($_POST['first_name']) : '';
$first_name=(!empty($_POST['first_name'])) ? trim($_POST['first_name']) : '';
$last_name=(!empty($_POST['first_name'])) ? trim($_POST['first_name']) : '';
?>

<p>
	<label for="team_name"><?php _e('Team Name', 'tru'); ?><br />
	<input type="text" name="team_name" id="team_name" class="input" value="<?php echo esc_attr(wp_unslash($team_name)); ?>" size="25" /></label>
</p>

<p>
	<label for="first_name"><?php _e('First Name', 'tru'); ?><br />
	<input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr(wp_unslash($first_name)); ?>" size="25" /></label>
</p>

<p>
	<label for="last_name"><?php _e('Last Name', 'tru'); ?><br />
	<input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr(wp_unslash($last_name)); ?>" size="25" /></label>
</p>

<p>
	<label for="password">Password<br/>
	<input id="password" class="input" type="password" size="25" value="" name="password" />
	</label>
</p>

<p>
	<label for="repeat_password">Repeat password<br/>
	<input id="repeat_password" class="input" type="password" size="25" value="" name="repeat_password" />
	</label>
</p>

<p>
	<label for="are_you_human"><?php _e('Are you human? What is 1 + 1?', 'tru'); ?>
	<input id="are_you_human" class="input" type="text" value="" name="are_you_human" />
	</label>
</p>