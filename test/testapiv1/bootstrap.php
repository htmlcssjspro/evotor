<?php
error_reporting(E_ALL);

session_start();

$_SESSION['count'] = isset($_SESSION['count']) ? (++$_SESSION['count']) : 0;

$_SESSION['uid'] = $_SESSION['uid'] ?? $_GET['uid'] ?? null;
$_SESSION['token'] = $_SESSION['token'] ?? $_GET['token'] ?? null;

$uid = $_SESSION['uid'] ?? $_GET['uid'] ?? null;
$token = $_SESSION['token'] ?? $_GET['token'] ?? null;



// <form action="" method="POST">
//     <label>Запрос
//         <input type="text" style="width:800px;">
//     </label>
//     <button>Отправить</button>
// </form>
