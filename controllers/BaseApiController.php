<?php
/**
 * Date: 15.09.18
 * Time: 11:21
 */

namespace app\controllers;


use app\modules\user\models\UserRecord;
use app\modules\user\services\AuthorizationService;
use yii\web\Controller;

class BaseApiController extends Controller
{
    const HEADER_AUTH_TOKEN = 'auth-token';

    public $enableCsrfValidation = false;


    /**
     * @var null|UserRecord
     */
    protected $currentUser = null;

    public function beforeAction($action)
    {
        $headers = \Yii::$app->request->getHeaders();
        $authToken = $headers->get(self::HEADER_AUTH_TOKEN);
        //todo make DI
        $authorizedUser = (new AuthorizationService())->auth($authToken);
        $this->currentUser = $authorizedUser;
        return parent::beforeAction($action);
    }

}