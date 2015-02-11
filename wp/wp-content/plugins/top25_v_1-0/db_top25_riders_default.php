<?php
function db_install_rider_data() {
	global $wpdb;
	$table_name=$wpdb->prefix."top25_riders";
	$wpdb->show_errors();

	$arr=array();
		
	$arr[]=array('name'=>'Kevin PAUWELS');
	$arr[]=array('name'=>'Sven NYS');
	$arr[]=array('name'=>'Zdenek STYBAR');
	$arr[]=array('name'=>'Niels ALBERT');
	$arr[]=array('name'=>'Tom MEEUSEN');
	$arr[]=array('name'=>'Klaas VANTORNOUT');
	$arr[]=array('name'=>'Lars VAN DER HAAR');
	$arr[]=array('name'=>'Francis MOUREY');
	$arr[]=array('name'=>'Bart AERNOUTS');
	$arr[]=array('name'=>'Rob PEETERS');
	$arr[]=array('name'=>'Radomir SIMUNEK');
	$arr[]=array('name'=>'Jeremy POWERS');
	$arr[]=array('name'=>'Bart WELLENS');
	$arr[]=array('name'=>'Steve CHAINEL');
	$arr[]=array('name'=>'Ryan TREBON');
	$arr[]=array('name'=>'Enrico FRANZOI');
	$arr[]=array('name'=>'Simon ZAHNER');
	$arr[]=array('name'=>'Thijs VAN AMERONGEN');
	$arr[]=array('name'=>'Mariusz GIL');
	$arr[]=array('name'=>'Timothy JOHNSON');
	$arr[]=array('name'=>'Christian HEULE');
	$arr[]=array('name'=>'Dieter VANTHOURENHOUT');
	$arr[]=array('name'=>'Gerben DE KNEGT');
	$arr[]=array('name'=>'Aurelien DUVAL');
	$arr[]=array('name'=>'Wietse BOSMANS');
	$arr[]=array('name'=>'Christoph PFINGSTEN');
	$arr[]=array('name'=>'Marcel WILDHABER');
	$arr[]=array('name'=>'Sven VANTHOURENHOUT');
	$arr[]=array('name'=>'Ian FIELD');
	$arr[]=array('name'=>'Matthieu BOULO');
	$arr[]=array('name'=>'Marcel MEISEN');
	$arr[]=array('name'=>'James DRISCOLL');
	$arr[]=array('name'=>'Cristian COMINELLI');
	$arr[]=array('name'=>'Nicolas BAZIN');
	$arr[]=array('name'=>'Egoitz MURGOITIO REKALDE');
	$arr[]=array('name'=>'Philipp WALSLEBEN');
	$arr[]=array('name'=>'Julien TARAMARCAZ');
	$arr[]=array('name'=>'Jonathan PAGE');
	$arr[]=array('name'=>'Ben BERDEN');
	$arr[]=array('name'=>'Twan VAN DEN BRAND');
	$arr[]=array('name'=>'Elia SILVESTRI');
	$arr[]=array('name'=>'Mike TEUNISSEN');
	$arr[]=array('name'=>'Vladimir KYZIVAT');
	$arr[]=array('name'=>'Thijs AL');
	$arr[]=array('name'=>'Petr DLASK');
	$arr[]=array('name'=>'Niels WUBBEN');
	$arr[]=array('name'=>'Martin ZLAMALIK');
	$arr[]=array('name'=>'Julian ALAPHILIPPE');
	$arr[]=array('name'=>'Stan GODRIE');
	$arr[]=array('name'=>'Zach MCDONALD');

	//echo "<pre>";
	//print_r($arr);
	//echo "<pre>";
	
	foreach ($arr as $rider) {
		//print_r($rider);
		$data=$wpdb->insert($table_name,$rider);
	}
	?>
	<div class="upload-text">
		<?php
		if ($data) {
			echo "Success";
		} else {
			echo "Error";
		}
		?>
	</div>
	<?php
}
?>