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
require 'oauth.php';

// pr(getRequest($api, $header));
// pr(postRequest($api, $body, $header));

// define('APP_ID',       '54dc44b0-aa68-4e36-9b4a-569c6ea19603');
// define('VERSION_ID',   '787234c1-d85e-42d7-b1d3-ccd0dfcb83c8');
// define('REDIRECT_URL', 'https://evotor.online/test/TestAPIv2');


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

// OAUTH
f1();
// f2();
// f3();
// getInfo();




(function ($token) {

    $header = [
        "Authorization: $token",
        'Accept: application/vnd.evotor.v2+json',
        'Content-Type: application/vnd.evotor.v2+json', // простые запросы
    ];

    // Получить список магазинов
    // GET /stores
    $api = 'https://api.evotor.ru/stores';
    pr(request('GET', $api, $header), 'GET /stores');
    // Возвращает массив с информацией о всех магазинах пользователя.

    // Получить список смарт-терминалов
    // GET /devices
    $api = 'https://api.evotor.ru/devices';
    pr(request('GET', $api, $header), 'GET /devices');
    // Возвращает массив с информацией о всех смарт-терминалах пользователя.

    // Получить список сотрудников
    // GET /employees
    $api = 'https://api.evotor.ru/employees';
    pr(request('GET', $api, $header), 'GET /employees');
    // Возвращает массив с информацией о всех сотрудниках пользователя.

}); //($token)
