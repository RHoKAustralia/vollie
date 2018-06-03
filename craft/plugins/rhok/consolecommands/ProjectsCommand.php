<?php

namespace Craft;

class ProjectsCommand extends BaseCommand
{
    public function actionSendUpdateRequests()
    {
        $now = new \DateTime();
        $projects = (array)craft()->rhok_projects->getProjectsRequiringStatusUpdate();

        echo count($projects);

        /** @var FieldModel $field */
        $field = craft()->fields->getFieldByHandle('projectStatus');


        print_r($field->settings['options']);

    }
}