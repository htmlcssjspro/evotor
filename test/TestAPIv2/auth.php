<?php
error_reporting(E_ALL);

require 'functions.php';

define('APP_ID',       '54dc44b0-aa68-4e36-9b4a-569c6ea19603');
define('VERSION_ID',   '787234c1-d85e-42d7-b1d3-ccd0dfcb83c8');
define('REDIRECT_URL', 'https://evotor.online/test/TestAPIv2');


// Чтобы авторизовать приложение и получить ключ доступа (access_token):

// 1. Создайте клиент приложения с помощью соответствующего запроса.
$app_id     = APP_ID;
$version_id = VERSION_ID;
$api = "https://dev.evotor.ru/api/v1/publisher/app/oauth/public/apps/{$app_id}/versions/{$version_id}/oauth-apps?type=web";
$access_token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJYLUZpbmdlcnByaW50IjoiNzZiYjU5YWQzMjczZDg1MzA0MTFmYjRhMmMyMzhmOTMiLCJ1c2VyX25hbWUiOiJyZW1idG1hc3RlckBnbWFpbC5jb20iLCJ4X3VzZXJfaWQiOiJkOGYwN2U4MC00NmU2LTQ1YjQtOGRjNC1lZjJkMjBlNWY5MzgiLCJzY29wZSI6WyJyZWFkIiwid3JpdGUiLCJwdXJjaGFzZSJdLCJleHAiOjE1ODk3MTgwNzcsImlhdCI6MTU4OTcxNjI3NzE4NiwiYXV0aG9yaXRpZXMiOlsiUk9MRV9QVUJMSVNIRVIiXSwianRpIjoiOWVmMWNkOTEtMDFiMS00OTE2LTliODUtZDA0MzEyNzBkNzczIiwieF91aWQiOm51bGwsImNsaWVudF9pZCI6IkV2by1VSSIsInhfbG9uZ2xpdmVkIjpmYWxzZX0.daM3UaBq_ClkVluhApKvP95t4WrL9CFmnn2HfaGdzXw";
$user_agent = 'Mozilla/5.0 (Windows NT 6.1; ) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36';
$header = [
    "Authorization: {$access_token}",
    'Content-Type: application/json',
    'Origin: https://dev.evotor.ru',
    "User-Agent: {$user_agent}",
];
$redirect_url = REDIRECT_URL;
$body = json_encode([
    "registered_redirect_uri" => [$redirect_url],
    "scope" => [
        "store:read",
        "employee:read",
        "device:read",
        "device.imei:read",
        "device.location:read",
        "device.firmware:read",
        "product:read",
        "product:write",
        "product.quantity:read",
        "product.quantity:write",
        "document:read",
        "product-group:read",
        "product-group:write",
        "product-image:read",
        "product-image:write",
    ]
]);
pr(json_decode(postRequest($api, $header, $body)));
// В ответ на запрос вы получите идентификатор клиента (client_id) и секрет клиента (client_secret). Сохраните эти данные, они понадобятся для авторизации приложения и подтверждения прав доступа к ресурсам пользователя.
