<?php
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	var_dump(function_exists('curl_version'));

	$url = 'https://api.sendgrid.com/';
	$user = 'azure_0632f0b7fa0883f933161d8e839dbfee@azure.com';
	$pass = 'testing123'; 

	$params = array(
	  'api_user' => $user,
	  'api_key' => $pass,
	  'to' => 'michaeloneill94@live.ie',
	  'subject' => 'testing from curl',
	  'html' => 'testing body',
	  'text' => 'testing body',
	  'from' => 'michaeloneill94@live.ie',
	);

	$request =  $url.'api/mail.send.json';

	// Generate curl request
	$session = curl_init($request);
	// Tell curl to use HTTP POST
	curl_setopt ($session, CURLOPT_POST, true);
	// Tell curl that this is the body of the POST
	curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
	// Tell curl not to return headers, but do return the response
	curl_setopt($session, CURLOPT_HEADER, false);
	// Tell PHP not to use SSLv3 (instead opting for TLS)
	curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

	// obtain response
	$response = curl_exec($session);
	curl_close($session);


	 echo $response;
	 // print everything out
	 print_r($response);

	 echo "here!!";

 ?>