<?php
error_reporting(E_ALL);

function pr(string $exp, ?string $name = '')
{
    echo '<br><pre>';
    echo "$name: ";
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
        CURLOPT_RETURNTRANSFER => TRUE
    ]);
    if ($body) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    }

    $response = curl_exec($ch);
    // $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    curl_close($ch);
    // return (int) $status;
    return $response;
}
