<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testapi extends CI_Controller {

    public function index() {
        $url = "https://services.satu.untan.ac.id/api/v1/kedokteran/mahasiswa?page=1&limit=1";

$headers = [
    "x-app-key: DE2CD1332496931EBA9D53E0F28EC72D",
    "x-secret-key: 6D5E5FC7222C86F6DFE40346B6EE493927CE3052576172415B475B5700457C1D",
    "Accept: application/json"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($ch);
$error = curl_error($ch);
$info = curl_getinfo($ch);

curl_close($ch);

echo "<pre>";
echo "RESPONSE:\n";
var_dump($response);

echo "\n\nCURL ERROR:\n";
var_dump($error);

echo "\n\nCURL INFO:\n";
print_r($info);
echo "</pre>";

    }
}
