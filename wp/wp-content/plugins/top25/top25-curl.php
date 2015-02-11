<?php
function top25_curl() {
	$cURL=new Top25_cURL();
}

class Top25_cURL {
	
	function __construct() {
		echo $this->main_page();
	}
	
	function main_page() {
		include_once('simple_html_dom.php');
		
		$html=null;
		
		$html.='<h3>cURL</h3>';
		
		
		$url='http://www.uci.ch/templates/BUILTIN-NOFRAMES/Template3/layout.asp?MenuId=MTUyMTU&LangId=1';
		
		$curl=curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl,CURLOPT_HEADER,false);
			
		$result=curl_exec($curl);
			
		curl_close($curl);
		
		$var=explode("\n",$result);
		$arr=array();
		$iframe=null;
/*
echo "<pre>";
print_r($var);
echo "</pre>";
*/			
			
		foreach ($var as $row) :
			if (strpos(strtolower($row),"iframe")!==false) :
				$iframe=$row;
				break;
			endif;
		endforeach;
		
		$html=file_get_html($iframe);
		
		foreach ($html->find('tr') as $element) :
			echo $element."<br>";
		endforeach;
		
		
		
		
		return $html;
	}
	
}
?>