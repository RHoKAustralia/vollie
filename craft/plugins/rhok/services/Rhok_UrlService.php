<?php

namespace Craft;

class Rhok_UrlService extends BaseApplicationComponent
{

    public function generateStatusUpdateUrl($projectId, $status)
    {
        $path = UrlHelper::getActionUrl('rhok/projects/updateStatus', ['projectId' => $projectId, 'status' => $status]);
        return str_replace('console?p=', 'index.php?p=', $path);
    }

}