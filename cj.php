<?php
define('ROOT_PATH', realpath(dirname(__FILE__)));
include_once ROOT_PATH . '/goutte.phar';




use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

if (!isset($_POST["access_type"])) {
	die ;
}
$access_type 	= $_POST["access_type"];
$pass 			= $_POST["pass"];
$url 			= $_POST["url"];

$form_data = array();
if (isset($_POST["form_data"])) {
	parse_str($_POST["form_data"], $form_data);
}


if($pass!=="001100"){
	die;
}

$client = new Client();
$client -> getClient() -> setDefaultOption('config/curl/' . CURLOPT_SSL_VERIFYPEER, false);

//////////Cookie 安装///////////////////////////
$header_array = array('Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.52 Safari/537.36', "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36", "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0", );
$header_str = $header_array[mt_rand(0, (count($header_array) - 1))];
$client -> setHeader('User-Agent', $header_str);
/////////////////////////////////////////////////



if ("get" === $access_type) {
	$crawler = $client -> request('GET', $url);
} elseif ("post" === $access_type) {
	$crawler = $client->request('POST', $url, $form_data);
}

$html = $crawler -> html();
echo $html;
die;