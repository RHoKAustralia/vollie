<?php

namespace Craft;

class Rhok_ProjectsService extends BaseApplicationComponent
{

    public function updateProjectStatus($projectId, $newStatus) {

        $existingProject = craft()->entries->getEntryById($projectId);

        $existingProject->getContent()->projectStatus = $newStatus;

        try {
            return craft()->entries->saveEntry($existingProject);

        } catch (\Exception $exception) {
            throw new HttpException(500);
        }

    }

    public function getProjectsRequiringStatusUpdate()
    {
        $now = new \DateTime();
        $rawProjects = craft()->elements->getCriteria(ElementType::Entry, [
            'type' => 'projects',
            'projectStatus' => ['pending', 'active'],
            'limit' => 0
        ])->find();

        $applicableProjects = array_filter($rawProjects, [$this, 'projectShouldBeUpdated']);

        return $applicableProjects;
    }

    public function projectShouldBeUpdated($project)
    {
        $now = new \DateTime();
        return ($project->projectStatus == 'active') ||
            ($project->projectStatus == 'pending' && $project->datesApplicationsClose < $now);

    }

    public function validateProjectById($projectId)
    {
        $project = craft()->entries->getEntryById($projectId);

        if (!($project instanceof EntryModel) || $project->getType()->handle !== 'projects') {
            return false;
        }

        $shouldProjectBeUpdated = $this->projectShouldBeUpdated($project);

        return $shouldProjectBeUpdated;
    }

    public function validateStatus($status) {
        return in_array($status, ['pending', 'active', 'submitted', 'completed', 'archived']);
    }
}