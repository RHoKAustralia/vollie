<?php

namespace Craft;

class ProjectsCommand extends BaseCommand
{
    public function actionSendUpdateRequests()
    {
        $now = new \DateTime();
        $projects = (array)craft()->rhok_projects->getProjectsRequiringStatusUpdate();

    }
}