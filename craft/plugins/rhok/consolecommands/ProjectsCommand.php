<?php

namespace Craft;

class ProjectsCommand extends BaseCommand
{
    public function actionSendUpdateRequests()
    {
        $now = new \DateTime();
        $rawProjects = (array)craft()->rhok_projects->getProjectsByStatuses(['pending', 'active'])->find();

        $applicableProjects = array_filter($rawProjects, function ($project) use ($now) {
            return ($project->projectStatus == 'active') ||
                ($project->projectStatus == 'pending' && $project->datesApplicationsClose < $now);
        });

        array_map(function ($project) {
            // print_r([(string)$project->projectStatus, $project->datesApplicationsClose->format('r')]);
        }, $applicableProjects);

    }
}