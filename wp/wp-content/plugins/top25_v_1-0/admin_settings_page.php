<?php function top25_admin() { ?>
	<div class="left-col">
		<div class="files">
			<h3>Files</h3>
			<?php
			global $wpdb;
			$wpdb->show_errors();
			
			$races_table=$wpdb->prefix."top25_races";
			$riders_table=$wpdb->prefix."top25_riders";
			$rank_table=$wpdb->prefix."top25_rank";
			
			// get ranks stored in db //
			$rank_data=array();
			$rank_db=$wpdb->get_results("SELECT id,week,season FROM $rank_table");
			foreach ($rank_db as $r) {
				$data=array(
					'id'=>$r->id,
					'week'=>$r->week,
					'season'=>$r->season
				);
				array_push($rank_data,$data);
			}
			
			// get races in db //
			$races_in_db=array();
			$races_db=$wpdb->get_results("SELECT filename FROM $races_table");
			foreach ($races_db as $r) {
				array_push($races_in_db,$r->filename);
			}
			
			$folder=TOP25_PATH.'uploads';
			
			//echo $folder."<br />";
			//$files=array();
			///
			// Make ext match csv
			////
			?>
			<ul class="files">
				<?php foreach (glob($folder.'/*') as $f) { ?>
					<li>
						<?php if (is_dir($f)) {	?>							
							<li>
								<?php echo setup_file($f,$races_in_db); ?>
							</li>
							<ul class="subdir">
								<?php $alt=0; ?>
								<?php	foreach (glob($f.'/*') as $sd) { ?>
									<?php
									if ($alt%2 && $alt!=0) {
										echo '<li class="alt">';
									} else {
										echo '</li>';
									}
									?>
									
										<?php echo setup_file($sd,$races_in_db); ?>
									</li>
									<?php $alt++; ?>
								<?php } ?>
							</ul><!-- .subdir -->
						<?php } else { ?>
							<?php echo setup_file($f,$races_in_db); ?>
						<?php } ?>
					</li>
				<?php } ?>
			</ul><!-- main ul -->
		</div><!-- .files -->
		<div class="initial-data">
			<h3>Initial Data</h3>
			<?php
			$rider_data=$wpdb->get_results("SELECT * FROM $riders_table");
			if (count($rider_data)==0) {
			?>
				<a href="admin.php?page=db-install-rider-data">Default Rider Data</a>
			<?php } // if count==0 // ?>
		</div><!-- initial-data -->
	</div><!-- .left-col -->
	<div class="right-col">
		<div class="weeks">
			<h3>Weekly Rankings</h3>
			<?php if (isset($_GET["action"]) && $_GET["action"]=="week-sc") : ?>
				<div class="shortcode">
					<b>Shortcode:</b> [top25-week id=<?php echo $_GET["id"]; ?>]
				</div>
			<?php endif; ?>
			<?php foreach ($rank_data as $rd) { ?>
				<a href="admin.php?page=top25-week-view&id=<?php echo $rd["id"]; ?>"><?php echo $rd["season"]; ?>&nbsp-&nbsp;Week <?php echo $rd["week"]; ?></a> [<a href="admin.php?page=top25-admin&action=week-sc&id=<?php echo $rd["id"]; ?>">shortcode</a>]&nbsp;[<a href="admin.php?page=top25-delete&item=week&id=<?php echo $rd["id"]; ?>&week=<?php echo $rd["week"]; ?>&season=<?php echo $rd["season"]; ?>">delete</a>]<br />
			<?php } ?>
		</div><!-- .weeks -->
	</div><!-- .right-col -->
<?php } // end top25_admin function // ?>
<?php
function setup_file($dir,$db_files) {
	$dir_arr=explode("/",$dir);
	$name=end($dir_arr);
	if (is_dir($dir)) {
		$name='<b>'.$name.'</b';
	} else {
		$name = substr($name,0,strrpos($name,'.'));
		$name='<div class="filename"><a href="admin.php?page=top25-upload&file='.urlencode($dir).'">'.$name.'</a>';
		//echo $dir;
		if (in_array($dir,$db_files)) {
			$name.='<div class="indb">in db</div>';
		}
		$name.='</div>';
	}
	return $name;
	
}
?>