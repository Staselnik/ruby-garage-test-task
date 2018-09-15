<?php
/**
 * Date: 15.09.18
 * Time: 0:37
 */

namespace app\modules\user\controllers;


use app\modules\user\services\AuthorizationService;
use yii\base\Module;
use yii\web\Controller;
use yii\web\Response;

class ApiController extends Controller
{
    protected $authorizationService;

    public function __construct(string $id, Module $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        \Yii::$app->response->format = Response::FORMAT_JSON;
        /**
         * @var $authService AuthorizationService
         */
        $authService = \Yii::$container->get(AuthorizationService::class);
        $this->authorizationService = $authService;
    }

    public $enableCsrfValidation = false;


    public function actionLogin()
    {
        $login = \Yii::$app->request->post('login');
        $pass = \Yii::$app->request->post('password');
        $authService = \Yii::$container->get(AuthorizationService::class);
        $token = $authService->loginByUsername($login, $pass);
        return ['auth_token' => $token];
    }


    public function actionSignup()
    {
        $login = \Yii::$app->request->post('login');
        $pass = \Yii::$app->request->post('password');
        $email = \Yii::$app->request->post('email');
        /**
         * @var $authService AuthorizationService
         */
        $authService = \Yii::$container->get(AuthorizationService::class);
        $user = $authService->signup($login, $email, $pass);
        return ['auth_token' => $user->auth_token];
    }


}