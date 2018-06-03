<?php

namespace Craft;

class Rhok_UrlService extends BaseApplicationComponent
{

    public function generateStatusUpdateUrl($eventId, $status)
    {
        // Sample
        return UrlHelper::getActionUrl('rhok/projects/updateStatus', ['param1' => 'value1', 'hash' => '123']);
    }

    public function validateStatusUrlParams($params)
    {
        return false;
    }
}