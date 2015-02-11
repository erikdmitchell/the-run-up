<?php
global $db_version;
$db_version = "1.0";

function db_install() {
	global $wpdb;
	global $db_version;
	
	$installed_ver=get_option("top25_db_version");
	
	$table_races=$wpdb->prefix."top25_races";
	$table_rank=$wpdb->prefix."top25_rank";
	$table_riders=$wpdb->prefix."top25_riders";
	$table_seasons=$wpdb->prefix."top25_seasons";
	$table_votes=$wpdb->prefix."top25_votes";
	
	if ($installed_ver!=$db_version) {
		$sql="CREATE TABLE $table_races (
			id int(11) NOT NULL AUTO_INCREMENT,
			name varchar(100) NOT NULL,
			type varchar(3) NOT NULL,
			quality float(10,3) NOT NULL,
			total float(10,3) NOT NULL,
			date varchar(11) NOT NULL,
			results text NOT NULL,
			filename text NOT NULL,
			PRIMARY KEY (id)
		);";
		$sql.="CREATE TABLE $table_rank (
			id int(11) NOT NULL AUTO_INCREMENT,
			data longtext NOT NULL,
			week tinyint(4) NOT NULL,
			season varchar(10) NOT NULL,
			PRIMARY KEY (id)
		);";
		$sql.="CREATE TABLE $table_riders (
			id int(11) NOT NULL AUTO_INCREMENT,
			name varchar(100) NOT NULL,
			uci mediumint(9) NOT NULL,
			wc mediumint(9) NOT NULL,
			races mediumint(9) NOT NULL,
			total mediumint(9) NOT NULL,
			PRIMARY KEY (id)
		);";
		$sql.="CREATE TABLE $table_seasons (
			id int(11) NOT NULL AUTO_INCREMENT,
			season varchar(10) NOT NULL,
			start varchar(12) NOT NULL,
			end varchar(12) NOT NULL,
			PRIMARY KEY (id)
		);";
		$sql.="CREATE TABLE $table_votes (
			id int(11) NOT NULL AUTO_INCREMENT,
			date varchar(11) NOT NULL,
			results text NOT NULL,
			userID int(11) NOT NULL,
			PRIMARY KEY (id)
		);";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		
		add_option("top25_db_version",$db_version);
	}
}

register_activation_hook(__FILE__,'db_install');

function update_db_check() {
    global $db_version;
    
    if (get_site_option('db_version')!=$db_version) {
        db_install();
    }
}
add_action('plugins_loaded','update_db_check');
?>