<?php

$file = file_get_contents('C:/xampp/htdocs/test.jpg');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1/upload1.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $file,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: image/jpeg'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>