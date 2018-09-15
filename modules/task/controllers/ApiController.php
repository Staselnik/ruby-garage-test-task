<?php
/**
 * Date: 15.09.18
 * Time: 0:37
 */

namespace app\modules\task\controllers;


use app\controllers\BaseApiController;
use app\modules\task\services\TaskService;

class ApiController extends BaseApiController
{
    /**
     * @var TaskService
     */
    protected $taskService;

    public function __construct(string $id, \yii\base\Module $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->taskService = \Yii::$container->get(TaskService::class);
    }


    /**
     * @param $id int projectId
     * @return array
     */
    public function actionCreate($id)
    {
        $data = \Yii::$app->request->post();
        $data['project_id'] = $id;
        $result = $this->taskService->create($this->currentUser->id, $data);
        return ['data' => $result->toArray()];
    }


    public function actionGetTasksByProjectId(int $id)
    {
        return [
            'data' => $this->taskService->getByProjectId($this->currentUser->id, $id)
        ];
    }

    public function actionUpdate(int $id)
    {
        $result = $this->taskService->update($this->currentUser->id, $id, \Yii::$app->request->post());
        return ['data' => $result];
    }

    public function actionDrop(int $id)
    {
        return [
            'data' => $this->taskService->drop($this->currentUser->id, $id)
        ];

    }

    public function actionGet(int $id)
    {
        $result = $this->taskService->get($this->currentUser->id, $id);
        $result = array_map(function($item){
            /**
             * @var $item ProjectRecord
             */
            return $item->toArray();
        }, $result);
        return ['data' => $result];
    }

}