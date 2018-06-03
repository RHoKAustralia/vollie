<?php

namespace Craft;

class RhokPlugin extends BasePlugin
{
    public function getVersion()
    {
        return '0.1';
    }

    public function getDeveloper()
    {
        return 'RHoK Melbourne';
    }

    public function getDeveloperUrl()
    {
        return 'http://www.rhokaustralia.org/melbourne/';
    }

    public function init()
    {
        parent::init();
        $this->loadMailchimpIntegration();
    }

    public function registerEmailMessages()
    {
        return array(
            'rhok_statusUpdate',
        );
    }

    private function loadMailchimpIntegration()
    {
        craft()->on('users.onActivateUser', function (Event $event) {
            /** @var UserModel $user */
            $user = $event->params['user'];
            //TODO: Do whatever you need to do with the user here
            craft()->rhok_mailchimp->subscribe([
                'email' => 'me@thoaionline.com',
                'firstname' => 'Thoai',
                'lastname' => 'Nguyen'
            ]);
        });
    }
}