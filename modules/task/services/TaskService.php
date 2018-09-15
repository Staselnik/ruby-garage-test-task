<?php
/**
 * Date: 15.09.18
 * Time: 16:31
 */


namespace app\modules\task\services;


use app\modules\task\models\TaskRecord;

class TaskService
{
    /**
     * @param int $ownerId
     * @param int|null $taskId
     * @return TaskRecord[]
     */
    public function get(int $ownerId, int $taskId = null) : array
    {
        if(is_null($taskId)) {
            return TaskRecord::find()->where(['owner_user_id' => $ownerId ])->all();
        }
        return TaskRecord::find()->where(['owner_user_id' => $ownerId, 'id' => $taskId])->all(); //can be one();
    }

    /**
     * @param int $ownerId
     * @param int|null $projectId
     * @return TaskRecord[]
     */
    public function getByProjectId(int $ownerId, int $projectId) : array
    {
        return ProjectRecord::find()->where(['owner_user_id' => $ownerId, 'project_id' => $projectId])->all(); //can be one();
    }

}