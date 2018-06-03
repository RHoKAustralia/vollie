<?php

namespace Craft;

class Rhok_ProjectsService extends BaseApplicationComponent
{
    public function getProjectsRequiringStatusUpdate()
    {
        $now = new \DateTime();
        $rawProjects = craft()->elements->getCriteria(ElementType::Entry, [
            'type' => 'projects',
            'projectStatus' => ['pending', 'active'],
            'limit' => 0
        ])->find();

        $applicableProjects = array_filter($rawProjects, function ($project) use ($now) {
            return ($project->projectStatus == 'active') ||
                ($project->projectStatus == 'pending' && $project->datesApplicationsClose < $now);
        });

        return $applicableProjects;
    }

}