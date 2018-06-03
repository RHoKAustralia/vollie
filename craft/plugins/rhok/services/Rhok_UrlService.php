<?php

namespace Craft;

class Rhok_UrlService extends BaseApplicationComponent
{

    public function generateStatusUpdateUrl($projectId, $status)
    {
        return UrlHelper::getActionUrl('rhok/projects/updateStatus', ['projectId' => $projectId, 'status' => $status]);
    }

}