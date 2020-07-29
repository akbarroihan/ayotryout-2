<?php
    $merchantCode = 'YOUR_MERCHANT_CODE_HERE'; // from duitku
    $merchantKey = 'YOUR_MERCHANT_KEY_HERE'; // from duitku
    $paymentAmount = '40000';
    $paymentMethod = 'VC'; // WW = duitku wallet, VC = Credit Card, MY = Mandiri Clickpay, BK = BCA KlikPay
    $merchantOrderId = time(); // from merchant, unique
    $productDetails = 'Test Pay with duitku';
    $email = 'test@test.com'; // your customer email
    $phoneNumber = '08123456789'; // your customer phone number (optional)
    $additionalParam = ''; // optional
    $merchantUserInfo = ''; // optional
    $customerVaName = 'John Doe'; // display name on bank confirmation display
    $callbackUrl = 'http://example.com/callback'; // url for callback
    $returnUrl = 'http://example.com/return'; // url for redirect
    $expiryPeriod = '10'; // set the expired time in minutes

    $signature = md5($merchantCode . $merchantOrderId . $paymentAmount . $merchantKey);

    $item1 = array(
        'name' => 'Test Item 1',
        'price' => 10000,
        'quantity' => 1);

    $item2 = array(
        'name' => 'Test Item 2',
        'price' => 30000,
        'quantity' => 3);

    $itemDetails = array(
        $item1, $item2
    );

    $params = array(
        'merchantCode' => $merchantCode,
        'paymentAmount' => $paymentAmount,
        'paymentMethod' => $paymentMethod,
        'merchantOrderId' => $merchantOrderId,
        'productDetails' => $productDetails,
        'additionalParam' => $additionalParam,
        'merchantUserInfo' => $merchantUserInfo,
	'customerVaName' => $customerVaName,
        'email' => $email,
        'phoneNumber' => $phoneNumber,
        'itemDetails' => $itemDetails,
        'callbackUrl' => $callbackUrl,
        'returnUrl' => $returnUrl,
        'signature' => $signature,
	'expiryPeriod' => $expiryPeriod
    );

    $params_string = json_encode($params);
    $url = 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry'; // Sandbox
    // $url = 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry'; // Production
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($params_string))                                                                       
    );   
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    //execute post
    $request = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($httpCode == 200)
    {
        $result = json_decode($request, true);
        header('location: '. $result['paymentUrl']);
        echo "paymentUrl :". $result['paymentUrl'] . "<br />";
        echo "merchantCode :". $result['merchantCode'] . "<br />";
        echo "reference :". $result['reference'] . "<br />";
	echo "vaNumber :". $result['vaNumber'] . "<br />";
	echo "amount :". $result['amount'] . "<br />";
	echo "statusCode :". $result['statusCode'] . "<br />";
	echo "statusMessage :". $result['statusMessage'] . "<br />";
    }
    else
        echo $httpCode;