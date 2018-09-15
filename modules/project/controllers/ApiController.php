<?php
/**
 * Date: 15.09.18
 * Time: 0:37
 */

namespace app\modules\project\controllers;


use app\controllers\BaseApiController;

use app\modules\project\models\ProjectRecord;
use app\modules\project\services\ProjectService;


class ApiController extends BaseApiController
{

    /**
     * @var ProjectService
     */
    protected $projectService;

    public function __construct(string $id, \yii\base\Module $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->projectService = \Yii::$container->get(ProjectService::class);
    }

    public function actionCreate()
    {
        $result = $this->projectService->create($this->currentUser->id, \Yii::$app->request->post('title'));

        return ['data' => $result->toArray()];
    }

    public function actionGet(int $id = null)
    {
        $result = $this->projectService->get($this->currentUser->id, $id);
        $result = array_map(function($item){
            /**
             * @var $item ProjectRecord
             */
            return $item->toArray();
        }, $result);
        return ['data' => $result];
    }


    public function actionUpdate(int $id)
    {
        $result = $this->projectService->update($this->currentUser->id, $id, \Yii::$app->request->post());
        return ['data' => $result];
    }

    public function actionDrop(int $id)
    {
        return [
            'data' => $this->projectService->drop($this->currentUser->id, $id)
        ];
    }

}