<?php

namespace Craft;

class Rhok_ProjectsController extends BaseController
{

    /**
     * Updates the status for a given project id.
     *
     * @param $projectId the id of the project to update
     * @param $status the project status to update to
     */
    public function actionUpdateStatus($projectId, $status)
    {
        $isProjectValid = craft()->rhok_projects->validateProjectById($projectId);
        if (!$isProjectValid) {
            throw new HttpException(400, 'Project was not valid');
        }

        $isStatusValid = craft()->rhok_projects->validateProjectById($status);
        if ($isStatusValid) {
            throw new HttpException(400, 'Status was not valid');
        }


        $success = craft()->rhok_projects->updateProjectStatus($projectId, $status);

        if ($success) {
            $project = craft()->entries->getEntryById($projectId);
            return $this->renderTemplate('rhok/projects/update-result', ['project' => $project, 'status' => $status]);
        } else {
            throw new HttpException(403, 'Forbidden');
        }
    }
}