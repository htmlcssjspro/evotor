<?php
error_reporting(E_ALL);

function pr($exp, ?string $name = '')
{
    echo '<br><pre>';
    if ($name) {
        echo "<strong>### $name: ###</strong><br>";
    }
    print_r($exp);
    echo '</pre><br>';
}

function getRequest(string $api, array $header)
{
    $ch = curl_init($api);
    curl_setopt_array($ch, [
        // CURLOPT_HTTPGET        => TRUE,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => $header,
        // CURLOPT_HEADER         => FALSE,
        CURLOPT_HEADER         => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function postRequest($api, $header, $body)
{
    $ch = curl_init($api);
    curl_setopt_array($ch, [
        // CURLOPT_POST           => TRUE,
        CURLOPT_CUSTOMREQUEST  => 'POST',
        CURLOPT_HTTPHEADER     => $header,
        CURLOPT_POSTFIELDS     => "$body;type=application/json",
        CURLOPT_HEADER         => TRUE,
        // CURLOPT_HEADER         => FALSE,
        CURLOPT_RETURNTRANSFER => TRUE
    ]);
    $response = curl_exec($ch);
    // $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    curl_close($ch);
    // return (int) $status;
    return $response;
}

function request(string $method, string $api, array $header, ?string $body = '')
{
    $ch = curl_init($api);
    curl_setopt_array($ch, [
        CURLOPT_CUSTOMREQUEST  => $method,
        CURLOPT_HTTPHEADER     => $header,
        CURLOPT_HEADER         => TRUE,
        // CURLOPT_HEADER         => FALSE,
        CURLINFO_HEADER_OUT    => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE
    ]);
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  $method);
    // curl_setopt($ch, CURLOPT_HTTPHEADER,     $header);
    // curl_setopt($ch, CURLOPT_HEADER,         TRUE);
    // curl_setopt($ch, CURLINFO_HEADER_OUT,    TRUE);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    if ($body) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        // curl_setopt_array($ch, [
        //     CURLOPT_POSTFIELDS => $body
        // ]);
    }

    $response = curl_exec($ch);
    $curlInfo = curl_getinfo($ch);
    $info = [
        'URL'            => $curlInfo['url'],
        'Код ответа'     => $curlInfo['http_code'],
        'Content-Type:'  => $curlInfo['content_type'],
        'Строка запроса' => $curlInfo['request_header'],
    ];
    // $info = curl_getinfo($ch);

    // $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    curl_close($ch);
    pr($info, '$info');
    // return (int) $status;
    return $response;
}
