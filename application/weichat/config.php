<?php
/*
$config['app_id'] = "wxfdd8a648a79187a9";
$config['secret'] = "59e0bfc45db4ee85be8555ddda674aff";
$config['token'] = "u5mwl5445o99M8Q";
//payment
$config['merchant_id'] = "";
$config['key'] = "";
$config['key_path']  = __DIR__."/cert/a/apiclient_key.pem";
$config['cert_path'] = __DIR__."/cert/a/apiclient_cert.pem";

$output['a'] = $config;
*/
unset($config);
$config['app_id'] = "wx66cffd919132e3f7";
$config['secret'] = "3d78ad4c9e22b5c4441a6afe51bd436f";
$config['token'] = "wstaichi";
$config['aes_key'] = "QTCrANM0VCXmekqz06QXamEFWhZcXMlnbIX9jNoVFzh";
//payment
$config['merchant_id'] = "";
$config['key'] = "";
//$config['key_path']  = __DIR__."/cert/a/apiclient_key.pem";
//$config['cert_path'] = __DIR__."/cert/a/apiclient_cert.pem";

$output['qihe'] = $config;

return $output;