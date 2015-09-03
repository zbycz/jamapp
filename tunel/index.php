<?php

/*
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://app.cej2014.cz:8080");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2); 
curl_setopt($ch, CURLOPT_TIMEOUT, 2); //timeout in seconds

$response = curl_exec($ch);
curl_close($ch);
*/

	echo "<h1>JamAPP</h1>";
	echo "<p>It seems you are connecting from the internet. The jamapp runs best when you are connected to the camp wifi intranet named 'CEJ2014' and type app.cej2014.cz";
	echo "<p>If you really need to access jamapp, you may go to <a href='http://app.cej2014.cz:8080/'>http://app.cej2014.cz:8080/</a> - but it connects to the camp server through camp internet connection, which is very unstable. Sometimes it results in timeout. ";


file_put_contents('log.log', date('Ymd h:i:s') . ' -- ' . gethostbyaddr($_SERVER['REMOTE_ADDR']). "\n", FILE_APPEND);
