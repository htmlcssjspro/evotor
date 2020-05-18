<?php

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

echo '<pre>';
echo $body;
