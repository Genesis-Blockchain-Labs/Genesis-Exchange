<?php 
// Recommend to use coingate-php library: https://github.com/coingate/coingate-php

    define('APP_ID', '9590');
    define('API_KEY', 'Z1PnoCau9QfiFLIY20H7mh');
    define('API_SECRET', '0v9acRQ8X6osdr25MLb3kStI1TjqpyJB');

    function api_request($url, $method = 'GET', $params = array())
    {
        $nonce      = time();
        $message    = $nonce . APP_ID . API_KEY;
        $signature  = hash_hmac('sha256', $message, API_SECRET);

        $headers = array();
        $headers[] = 'Access-Key: ' . API_KEY;
        $headers[] = 'Access-Nonce: ' . $nonce;
        $headers[] = 'Access-Signature: ' . $signature;

        $curl = curl_init();
        
        $curl_options = array(
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_URL             => $url
        );

        if ($method == 'POST') {
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';

            array_merge($curl_options, array(CURLOPT_POST => 1));
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        }

        curl_setopt_array($curl, $curl_options);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response       = curl_exec($curl);
        $http_status    = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return array('status_code' => $http_status, 'response_body' => $response);
    }

    // GET Example
    // $response = api_request('https://api-sandbox.coingate.com/v1/orders/1');

    // echo $response['status_code'];
    // echo $response['response_body'];

    // POST Example
    $post_params = array(
        'order_id'          => 'ORDER-1412759368',
        'price'             => 0.002,
        'currency'          => 'ETH',
        'receive_currency'  => 'ETH',
        'callback_url'      => 'https://example.com/payments/callback?token=6tCENGUYI62ojkuzDPX7Jg',
        'cancel_url'        => 'https://example.com/cart',
        'success_url'       => 'https://example.com/account/orders',
        'description'       => 'Apple Iphone 6'
    );

    $response = api_request('https://api-sandbox.coingate.com/v1/orders', 'POST', $post_params);

    echo $response['status_code'];
    echo $response['response_body'];
die;
?>