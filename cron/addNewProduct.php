<?php

    $params = array('item' => 'Cron file');
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://www.shop.testmagasin.uno/app/curl/addNewProduct.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($params)
    ));
    $respone = ($curl);
    curl_close($curl);

