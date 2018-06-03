<?php

namespace Craft;

class Rhok_ProjectsService extends BaseApplicationComponent
{
    public function getProjectsByStatuses($statuses)
    {
        return craft()->elements->getCriteria(ElementType::Entry, [
            'type' => 'projects',
            'projectStatus' => $statuses,
            'limit' => 0
        ]);
    }
}