<?php

function request(string $method, string $api, array $header, ?string $body = '')
{
    $ch = curl_init($api);
    curl_setopt_array($ch, [
        CURLOPT_CUSTOMREQUEST  => $method,
        CURLOPT_HTTPHEADER     => $header,
        // CURLOPT_HEADER         => true, // FALSE
        // CURLOPT_REFERER        => '', // string
        // CURLOPT_USERAGENT      => '', // string
        CURLINFO_HEADER_OUT    => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_PRIVATE        => '', // mixed
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS      => 10,
    ]);
    if ($body) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    }
    $response = curl_exec($ch);
    $curlInfo = curl_getinfo($ch);
    $info = [
        'URL'            => $curlInfo['url'],
        'Строка запроса' => $curlInfo['request_header'],
        'Код ответа'     => $curlInfo['http_code'],
        'Content-Type:'  => $curlInfo['content_type'],
    ];
    $info = [
        'Request URL'            => curl_getinfo($ch, CURLINFO_EFFECTIVE_URL),
        'Request Header'         => curl_getinfo($ch, CURLINFO_HEADER_OUT),
        'Response Code'          => curl_getinfo($ch, CURLINFO_RESPONSE_CODE),
        'Response Content-Type:' => curl_getinfo($ch, CURLINFO_CONTENT_TYPE),
        'Private curl Data'      => curl_getinfo($ch, CURLINFO_PRIVATE),
    ];
    curl_close($ch);
    pr($info, '$info');
    return $response;
}


function pr($exp, ?string $name = '')
{
    echo '<br><pre>';
    if ($name) {
        echo "<strong>### $name: ###</strong><br>";
    }
    print_r($exp);
    echo '</pre><br>';
}
