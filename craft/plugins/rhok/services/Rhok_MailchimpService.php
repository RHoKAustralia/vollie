<?php

namespace Craft;

class Rhok_MailchimpService extends BaseApplicationComponent
{
    public function subscribe($user)
    {
        $rhokConfig = craft()->config->get('rhok');
        $apiKey = $rhokConfig['mailchimpApiKey'];
        $listId = $rhokConfig['mailchimpListId'];

        $memberId = md5(strtolower($user['email']));
        $dataCenter = substr($apiKey, strpos($apiKey, '-') + 1);
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;

        $json = json_encode([
            'email_address' => $user['email'],
            'status' => 'subscribed',
            'merge_fields' => [
                'FNAME' => $user['firstname'],
                'LNAME' => $user['lastname']
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
}