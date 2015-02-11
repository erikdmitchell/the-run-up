<?php function top25_delete() {	
	global $wpdb;
	
	$rank_table=$wpdb->prefix."top25_rank";
	
	if (isset($_GET["delete"]) && $_GET["delete"]=="Y") {
		$id=$_GET["id"];
		$wpdb->query("DELETE FROM $rank_table WHERE id='$id'");
		echo '<div class="upload-text">Week deleted.</div>';
	}
	?>
	<div class="top25-delete">
		<?php if (isset($_GET["item"]) && $_GET["item"]=="week") { ?>
			<div class="week">
				Are you sure you'd like to delete week <?php echo $_GET["week"]; ?> from the <?php $_GET["season"]; ?> season?<br />
				<input type="button" name="delete" id="delete" value="Yes" />
				<input type="button" name="delete" id="delete" value="No" />
			</div>
		<?php } else if ($_GET["item"]=="vote") :	?>
			<div class="vote">
				Are you sure you'd like to delete vote <?php echo $_GET["id"]; ?>?<br />
				<input type="button" name="delete" id="delete" value="Yes" />
				<input type="button" name="delete" id="delete" value="No" />
			</div>
		<?php endif; ?>
	</div>

	<script>
		jQuery(document).ready(function($) {
			$('.week #delete').click(function () {
				if ($(this).val()=="Yes") {
					var id=<?php echo $_GET["id"]; ?>;
					var url='<?php echo $_GET["page"]; ?>';
					window.location.href = 'admin.php?page='+url+'&delete=Y&id='+id;
				} else {
					parent.history.back();
					return false;
				}
			});
			
			$('.vote #delete').click(function () {
				if ($(this).val()=="Yes") {
					var id=<?php echo $_GET["id"]; ?>;
					//var url='<?php echo $_GET["page"]; ?>';
					window.location.href = 'admin.php?page=top25-vote&delete=Y&id='+id;
				} else {
					parent.history.back();
					return false;
				}
			});
			
		});
	</script>

<?php } ?>