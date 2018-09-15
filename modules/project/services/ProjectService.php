<?php
/**
 * Date: 15.09.18
 * Time: 16:31
 */


namespace app\modules\project\services;


use app\modules\project\models\ProjectRecord;

/** todo remake errors throws
 * Class ProjectService
 * @package app\modules\project\services
 */
class ProjectService
{
    /**
     * @param int $ownerId
     * @param int|null $projectId
     * @return ProjectRecord[]
     */
    public function get(int $ownerId, int $projectId = null) : array
    {
        if(is_null($projectId)) {
            return ProjectRecord::find()->where(['owner_user_id' => $ownerId ])->all();
        }
        return ProjectRecord::find()->where(['owner_user_id' => $ownerId, 'id' => $projectId])->all(); //can be one();
    }

    /**
     * @param int $ownerUserId
     * @param string $title
     * @return ProjectRecord
     * @throws \Exception
     */
    public function create(int $ownerUserId, string $title) : ProjectRecord
    {
        $project = new ProjectRecord();
        $project->title = $title;
        $project->owner_user_id = $ownerUserId;
        if(!$project->save()) {
            throw new \Exception(json_encode($project->getErrors()));
        }
        return $project;

    }

    /**
     * @param int $ownerUserId
     * @param int $projectId
     * @param array $data
     * @return ProjectRecord
     * @throws \Exception
     */
    public function update(int $ownerUserId, int $projectId, array $data) : ProjectRecord
    {
        $projectRecord = ProjectRecord::find()->where(['owner_user_id' => $ownerUserId, 'id' => $projectId])->one();
        if(empty($projectRecord)) {
            throw new \Exception("Project not found");
        }

        $projectRecord->load($data, '');
        if(!$projectRecord->save()) {
            throw new \Exception(json_encode($projectRecord->getErrors()));
        }
        return $projectRecord;
    }

    /**
     * @param int $ownerUserId
     * @param int $projectId
     * @return int
     */
    public function drop(int $ownerUserId, int $projectId)
    {
        return ProjectRecord::deleteAll(['owner_user_id' => $ownerUserId, 'id' => $projectId]);
    }

}