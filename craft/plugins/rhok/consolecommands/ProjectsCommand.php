<?php

namespace Craft;

class ProjectsCommand extends BaseCommand
{
    public function actionSendUpdateRequests()
    {
        $projects = craft()->rhok_projects->getProjectsByStatuses(['pending', 'active']);

        /** @var EntryModel $project */
        foreach ($projects as $project) {
            print_r($project->getContent()->projectStatus);
        }
    }
}