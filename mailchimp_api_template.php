<?php

/*
 * This is a stack overflow special. I wrote none of this code ¯\_(ツ)_/¯
 *
 * I do know that the api url is correct, the user email needs to be hashed
 * to be accepted by the api, and that a put request is the best way of updating
 * subscriber status
 *
 * https://developer.mailchimp.com/documentation/mailchimp/reference/lists/
 *
 */

$data = [
    'email'     => 'johndoe@example.com',
    'status'    => 'subscribed',
    'firstname' => 'john',
    'lastname'  => 'doe'
];

syncMailchimp($data);

function syncMailchimp($data) {
    $apiKey = '27f133ba3016ec5067be3dcfdf164acf-us13';
    $listId = '7f7abf4afe';

    $memberId = md5(strtolower($data['email']));
    $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
    $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;

    $json = json_encode([
        'email_address' => $data['email'],
        'status'        => $data['status'], // "subscribed","unsubscribed","cleaned","pending"
        'merge_fields'  => [
            'FNAME'     => $data['firstname'],
            'LNAME'     => $data['lastname']
        ]
    ]);

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $httpCode;
}
