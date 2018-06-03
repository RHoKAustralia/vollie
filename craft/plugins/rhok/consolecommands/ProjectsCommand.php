<?php

namespace Craft;

class ProjectsCommand extends BaseCommand
{
    public function actionSendUpdateRequests()
    {
        $now = new \DateTime();
        $projects = (array)craft()->rhok_projects->getProjectsRequiringStatusUpdate();

        echo 'Delivering emails for ', count($projects), ' projects.', PHP_EOL;

        /** @var FieldModel $field */
        $field = craft()->fields->getFieldByHandle('projectStatus');

        foreach ($projects as $project) {
            $this->deliverStatusEmailForProject($project);
        }
    }

    /**
     * @param EntryModel $project
     */
    public function deliverStatusEmailForProject($project)
    {
        echo 'Delivering email for: "', $project->title, '""', PHP_EOL;
        $charity = craft()->elements->getCriteria(ElementType::Entry, [
            'relatedTo' => [
                'field' => 'projectOrganisation',
                'sourceElement' => $project
            ],
            'limit' => 1
        ])->first();

        if (!$charity) {
            return false;
        }

        $admins = craft()->elements->getCriteria(ElementType::User, [
            'relatedTo' => [
                'field' => 'organisation',
                'targetElement' => $charity
            ]
        ])->find();

        /** @var UserModel $admin */
        foreach ($admins as $admin) {
            $email = $admin->email;
            echo 'Sending email to ', $email, PHP_EOL;
            craft()->email->sendEmailByKey($admin, 'rhok_statusUpdate', [
                'project' => $project,
                'activeLink' => '#active',
                'completedLink' => '#completed',
                'relistLink' => '#relist'
            ]);
        }
    }
}