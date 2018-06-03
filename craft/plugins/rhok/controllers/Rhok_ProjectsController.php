<?php

namespace Craft;

class Rhok_ProjectsController extends BaseController
{

    /**
     * @param $projectId
     * @param $status
     * @param $hash
     */
    public function actionUpdateStatus($projectId, $status, $hash)
    {
        $success = false;
        if ($success) {
            return $this->renderTemplate('rhok/projects/update-result', ['project' => $project, 'status' => 'STATUS']);
        } else {

            throw new HttpException(403, 'Forbidden');
        }
    }
}