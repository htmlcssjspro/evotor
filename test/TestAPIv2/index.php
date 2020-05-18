<?php

error_reporting(E_ALL);

// require 'bootstrap.php';

session_start();

$_SESSION['count'] = isset($_SESSION['count']) ? (++$_SESSION['count']) : 0;

$_SESSION['uid'] = $_SESSION['uid'] ?? $_GET['uid'] ?? null;
$_SESSION['token'] = $_SESSION['token'] ?? $_GET['token'] ?? null;

$uid = $_SESSION['uid'] ?? $_GET['uid'] ?? null;
$token = $_SESSION['token'] ?? $_GET['token'] ?? null;

require 'functions.php';

// pr(getRequest($api, $header));
// pr(postRequest($api, $body, $header));

define('APP_ID',       '54dc44b0-aa68-4e36-9b4a-569c6ea19603');
define('VERSION_ID',   '787234c1-d85e-42d7-b1d3-ccd0dfcb83c8');
define('REDIRECT_URL', 'https://evotor.online/test/TestAPIv2');


pr($_SESSION['count'], '$_SESSION[\'count\']');
pr($uid, '$uid');
pr($token, '$token');
// pr($_GET);
// pr($_POST);


$apiUrl = 'https://api.evotor.ru';

$headers = [
    "Authorization: {$token}",
    "X-Authorization: {$token}",
    'Accept: application/vnd.evotor.v2+json',
    'Content-Type: application/vnd.evotor.v2+json', // простые запросы
    'Content-Type: application/vnd.evotor.v2+bulk+json', // массовые запросы
];

$header = [
    "Authorization: {$token}",
    'Accept: application/vnd.evotor.v2+json',
    'Content-Type: application/vnd.evotor.v2+json', // простые запросы
];


function getStores()
{
    // Получить список магазинов
    // GET /stores
    $storesRequest = 'https://api.evotor.ru/stores';
    // Возвращает массив с информацией о всех магазинах пользователя.

}













f1();
// f2();
// f3();
// getInfo();


// Чтобы авторизовать приложение и получить ключ доступа (access_token):

// 1. Создайте клиент приложения с помощью соответствующего запроса.
function  f1()
{
    $app_id     = APP_ID;
    $version_id = VERSION_ID;
    $api = "https://dev.evotor.ru/api/v1/publisher/app/oauth/public/apps/{$app_id}/versions/{$version_id}/oauth-apps?type=web";
    $access_token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJYLUZpbmdlcnByaW50IjoiZTQ4MjZhYjc4MzcxYjE4N2EyYTA0NjcwZTRiZTQ0ZmEiLCJ1c2VyX25hbWUiOiJyZW1idG1hc3RlckBnbWFpbC5jb20iLCJ4X3VzZXJfaWQiOiJkOGYwN2U4MC00NmU2LTQ1YjQtOGRjNC1lZjJkMjBlNWY5MzgiLCJzY29wZSI6WyJyZWFkIiwid3JpdGUiLCJwdXJjaGFzZSJdLCJleHAiOjE1ODk3NzAzMzQsImlhdCI6MTU4OTc2ODUzNDA3MSwiYXV0aG9yaXRpZXMiOlsiUk9MRV9QVUJMSVNIRVIiXSwianRpIjoiYjY4OGRhMWYtMTVlZi00ZTUwLTk0Y2YtMDUwMTc1YWFiMjY1IiwieF91aWQiOm51bGwsImNsaWVudF9pZCI6IkV2by1VSSIsInhfbG9uZ2xpdmVkIjpmYWxzZX0.KzJgwVZ3hUgakk4mmtjlzoQmCzG-gvYUSmM1VMmtgE0";
    $user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36';
    $header = [
        "Authorization: {$access_token}",
        'Content-Type: application/json',
        'Origin: https://dev.evotor.ru',
        "User-Agent: {$user_agent}",
        'Accept: Application/vnd.evotor.v2+json'
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
    pr(postRequest($api, $header, $body));
};
// В ответ на запрос вы получите идентификатор клиента (client_id) и секрет клиента (client_secret). Сохраните эти данные, они понадобятся для авторизации приложения и подтверждения прав доступа к ресурсам пользователя.



// 2. Получите разрешение пользователя на доступ к ресурсам. Для этого, после установки приложения в личном кабинете, требуется открыть страницу на сервере авторизации:
function f2()
{
    $client_id = '';
    $redirect_url = REDIRECT_URL;
    $url = "https://oauth.evotor.ru/oauth/authorize?client_id={$client_id}&response_type=code&redirect_uri={$redirect_url}";
    header("Location: $url");
}

// 3. Передайте код на сервер авторизации:
function f3()
{
    $api = 'https://oauth.evotor.ru/oauth/token';
    $header = [
        'Authorization: Basic <base64 clientId:clientSecret>',
        'Content-Type: application/x-www-form-urlencoded'
    ];
    $code = '';
    $redirect_url = REDIRECT_URL;
    $body = "code={$code}&grant_type=authorization_code&redirect_uri={$redirect_url}";
    pr(postRequest($api, $header, $body));
};
// В ответ на запрос, сервер авторизации вернёт токен доступа (access_token).

// 4. Используйте токен доступа для работы с ресурсами пользователя



// Получить информацию о конкретном клиенте приложения
function getInfo()
{
    $app_id     = APP_ID;
    $version_id = VERSION_ID;
    $api = "https://dev.evotor.ru/api/v1/publisher/app/oauth/public/apps/{$app_id}/versions/{$version_id}/oauth-apps";
    $token = $_GET['token'];
    $header = [
        "Authorization: {$token}",
        'Accept: Application/vnd.evotor.v2+json',
        'Origin: https://dev.evotor.ru'
    ];
    pr(getRequest($api, $header));
};
// Возвращает список с данными всех клиентов приложения. Параметр version-id содержит версию приложения, заданную на сайте разработчиков.
