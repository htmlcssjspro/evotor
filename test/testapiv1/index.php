<?php

error_reporting(E_ALL);
session_start();

// require 'bootstrap.php';

$_SESSION['count'] = isset($_SESSION['count']) ? (++$_SESSION['count']) : 0;
$_SESSION['uid'] =   $_SESSION['uid']   ?? $_GET['uid']   ?? null;
$_SESSION['token'] = $_SESSION['token'] ?? $_GET['token'] ?? null;

require 'functions.php';
require 'Api.php';
require 'User.php';


$api = new Api();
$user = new User();









// $headers = [
//     "Authorization: {$token}",
//     "X-Authorization: {$token}",
//     'Accept: application/vnd.evotor.v2+json',
//     'Content-Type: application/vnd.evotor.v2+json', // простые запросы
//     'Content-Type: application/vnd.evotor.v2+bulk+json', // массовые запросы
// ];


// function getInfo($api)
// {
//     $header = [
//         "X-Authorization: {$_SESSION['token']}",
//         'Accept: application/vnd.evotor.v2+json',
//     ];
//     $response = request('GET', $api, $header);
//     return json_decode($response, true);
// }

// function getStores()
// {
//     $api = 'https://api.evotor.ru/api/v1/inventories/stores/search';
//     return getInfo($api);
// }
// function getDevices()
// {
//     $api = 'https://api.evotor.ru/api/v1/inventories/devices/search';
//     return getInfo($api);
// }
// function getEmployees()
// {
//     $api = 'https://api.evotor.ru/api/v1/inventories/employees/search';
//     return getInfo($api);
// }
// $_SESSION['storeList'] = $_SESSION['storeList'] ?? getStores();
// $_SESSION['deviceList'] = $_SESSION['deviceList'] ?? getDevices();
// $_SESSION['employeeList'] = $_SESSION['employeeList'] ?? getEmployees();

// $_SESSION['currentStore'] = $_SESSION['storeList'][0];


// pr($currentStore, 'Текущий магазин');

// $currentDevice = $_SESSION['currentDevice'] ?? getDevices();
// pr($currentDevice, 'Текущее устройство');

// $currentEmployee = $_SESSION['currentEmployee'] ?? getEmployees();
// pr($currentEmployee, 'Текущий сотрудник');

// function getDocument()
// {
//     $api = "https://api.evotor.ru/api/v1/inventories/stores/{$_SESSION['currentStore']['uuid']}/documents";
//     return $_SESSION['documentList'] = getInfo($api);
// }
// function getProducts()
// {
//     $api = "https://api.evotor.ru/api/v1/inventories/stores/{$_SESSION['currentStore']['uuid']}/products";
//     return $_SESSION['productsList'] = getInfo($api);
// }

// $documentList = $_SESSION['documentList'] ?? getDocument($currentStore['uuid']);
// pr($documentList, 'Список документов');

// $productsList = $_SESSION['productsList'] ?? getProducts($currentStore['uuid']);
// pr($productsList, 'Список товаров в текущем магазине');

// // // Адреса API Эвотора:
// // // GET
// // $storesApi =         'https://api.evotor.ru/api/v1/inventories/stores/search';
// // $employeesApi =      'https://api.evotor.ru/api/v1/inventories/employees/search';
// // $devicesApi =        'https://api.evotor.ru/api/v1/inventories/devices/search';

// // $documentsApi =      "https://api.evotor.ru/api/v1/inventories/stores/$storeUuid/documents"; //Получить список документов
// // $productsApi =       "https://api.evotor.ru/api/v1/inventories/stores/$storeUuid/products"; //Список товаров в магазине {storeUuid}
// // // POST-запросы
// // $productsUploadApi = "https://api.evotor.ru/api/v1/inventories/stores/$storeUuid/products"; //Передать список товаров
// // $productsDeleteApi = "https://api.evotor.ru/api/v1/inventories/stores/$storeUuid/products/delete"; // Удалить товар / все товары. HTTP-запрос с пустым массивом удалит все товары в магазине. Чтобы удалить определённый товар, в теле HTTP-запроса требуется указать его UUID
