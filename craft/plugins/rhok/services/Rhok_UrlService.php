<?php

namespace Craft;

class Rhok_UrlService extends BaseApplicationComponent
{

    public function generateStatusUpdateUrl($projectId, $status)
    {
        return UrlHelper::getActionUrl('rhok/projects/updateStatus', ['projectId' => $projectId, 'status' => $status]);
    }

    public function validateProjectById($projectId)
    {
        $project = craft()->entries->getEntryById($projectId);

        if (!($project instanceof EntryModel) || $project->getType()->handle !== 'projects') {
            return false;
        }

        $shouldProjectBeUpdated = craft()->rhok_projects->projectShouldBeUpdated($project);

        return $shouldProjectBeUpdated;
    }

    public function validateStatus($status) {
        return in_array($status, ['pending', 'active', 'submitted', 'completed', 'archived']);
    }
}