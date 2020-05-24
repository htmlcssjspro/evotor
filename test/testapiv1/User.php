<?php

// namespace ;

class User
{
    public $uid;
    public $token;

    public $stores;
    public $devices;
    public $employees;

    public $currentStore;
    public $currentDevice;

    public $products;

    public const API = [
        'stores'    => 'https://api.evotor.ru/api/v1/inventories/stores/search',
        'devices'   => 'https://api.evotor.ru/api/v1/inventories/devices/search',
        'employees' => 'https://api.evotor.ru/api/v1/inventories/employees/search',
    ];
    protected $api = [];
    public $header;
    public $getHeader;
    public $postHeader;
    public $body;


    public function __construct()
    {
        $this->uid   = $_SESSION['uid']   = $_SESSION['uid']   ?? $_GET['uid']   ?? null;
        $this->token = $_SESSION['token'] = $_SESSION['token'] ?? $_GET['token'] ?? null;

        $this->setHeader();

        // $this->stores    = $_SESSION['stores']    = $_SESSION['stores']    ?? $this->get(self::API['stores']);
        $this->stores    = $this->get(self::API['stores']);
        // $this->devices   = $_SESSION['devices']   = $_SESSION['devices']   ?? $this->get(self::API['devices']);
        $this->devices   = $this->get(self::API['devices']);
        // $this->employees = $_SESSION['employees'] = $_SESSION['employees'] ?? $this->get(self::API['employees']);
        $this->employees = $this->get(self::API['employees']);
        $this->setCurrentStore();

        // $this->products = $_SESSION['products'] = $_SESSION['products'] ?? $this->get($this->api['products']);
        $this->products = $this->get($this->api['products']);
    }

    public function getCurrentStore()
    {
        // return $this->currentStore = $_SESSION['currentStore'] = $_SESSION['currentStore'] ?? $this->stores[0];
        return $_SESSION['currentStore'] = $_SESSION['currentStore'] ?? 0;
    }
    public function setCurrentStore()
    {
        $this->currentStore = $_SESSION['currentStore'] = $_SESSION['currentStore'] ?? 0;
        $currentStoreUuid = $this->stores[$this->currentStore]['uuid'];
        $api = 'https://api.evotor.ru/api/v1/inventories/stores';
        $this->api = [
            'products'  => "{$api}/{$currentStoreUuid}/products",
            'documents' => "{$api}/{$currentStoreUuid}/documents",
        ];

        // $this->currentStore = $_SESSION['currentStore'] = $this->stores[$store];
        // $this->currentStore = $_SESSION['currentStore'] = $store;
    }

    public function getCurrentDevice()
    {
        return $this->currentDevice = $_SESSION['currentDevice'] = $_SESSION['currentDevice'] ?? $this->devices[0];
    }
    public function setCurrentDevice($device)
    {
        $this->currentDevice = $_SESSION['currentDevice'] = $this->devices[$device];
    }


    public function setHeader()
    {
        $this->header = [
            "X-Authorization: {$this->token}",
            'Accept: application/vnd.evotor.v2+json',
        ];
    }

    public function get($api)
    {
        $response = $this->request('GET', $api, $this->header);
        return json_decode($response, true);
    }

    public function post($api)
    {
        $response = $this->request('POST', $api, $this->getHeader, $this->body);
        return json_decode($response, true);
    }

    public function setBody($body)
    {
        $this->body = $body;
    }


    public function request(string $method, string $api, array $header, ?string $body = '')
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
        $info = [
            'Request URL'            => curl_getinfo($ch, CURLINFO_EFFECTIVE_URL),
            'Request Header'         => curl_getinfo($ch, CURLINFO_HEADER_OUT),
            'Response Code'          => curl_getinfo($ch, CURLINFO_RESPONSE_CODE),
            'Response Content-Type:' => curl_getinfo($ch, CURLINFO_CONTENT_TYPE),
            'Private curl Data'      => curl_getinfo($ch, CURLINFO_PRIVATE),
        ];
        curl_close($ch);
        // pr($info, '$info');
        return $response;
    }
}
