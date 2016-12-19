<?php
define('ROOT_PATH', realpath(dirname(__FILE__)));


$pass 			= $_POST["pass"];
$url 			= $_POST["url"];

$form_data = array();
if (isset($_POST["form_data"])) {
	parse_str($_POST["form_data"], $form_data);
}


if($pass!=="001100"){
	die;
}

$curl = curl_init();
$options = array(
	CURLOPT_URL => $url,
	CURLOPT_HEADER => false,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_AUTOREFERER => true,
	CURLOPT_BINARYTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_COOKIESESSION => true,
	CURLOPT_TIMEOUT => 300,
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_SSL_VERIFYPEER=>false
);
if(isset($form_data) && count($form_data)>0){
	$options[CURLOPT_POSTFIELDS]=$postdata;
	$options[CURLOPT_POST]=true;
}
curl_setopt_array($curl, $options);
$content = curl_exec($curl);
curl_close($curl);
unset($curl, $options);
echo $content;
die;
