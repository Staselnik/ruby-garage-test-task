<?php
/**
 * Date: 15.09.18
 * Time: 11:21
 */

namespace app\controllers;


use app\modules\user\models\UserRecord;
use app\modules\user\services\AuthorizationService;
use yii\base\Module;
use yii\web\Controller;
use yii\web\Response;

class BaseApiController extends Controller
{
    const HEADER_AUTH_TOKEN = 'auth-token';

    public $enableCsrfValidation = false;


    public function __construct(string $id, Module $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        \Yii::$app->response->format = Response::FORMAT_JSON;
    }

    /**
     * @var null|UserRecord
     */
    protected $currentUser = null;


    public function beforeAction($action)
    {
        $headers = \Yii::$app->request->getHeaders();
        $authToken = $headers->get(self::HEADER_AUTH_TOKEN);
        /**
         * @var $authorizationService AuthorizationService
         */
        $authorizationService = \Yii::$container->get(AuthorizationService::class);
        $authorizedUser = $authorizationService->auth($authToken);
        $this->currentUser = $authorizedUser;
        return parent::beforeAction($action);
    }

}