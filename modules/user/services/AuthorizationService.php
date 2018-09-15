<?php
/**
 * Date: 15.09.18
 * Time: 11:21
 */

namespace app\modules\user\services;


use app\modules\user\models\UserRecord;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\UnauthorizedHttpException;

class AuthorizationService
{

    /**
     * @param $authToken
     * @return UserRecord
     * @throws ForbiddenHttpException
     * @throws UnauthorizedHttpException
     */
    public function auth(string $authToken) : UserRecord
    {
        $customer = $this->getUserByAuthToken($authToken);
        return $customer;
    }


    /**
     * @param string $username
     * @param string $email
     * @param string $password
     * @return string auth-token
     */
    public function signup(string $username, string $email, string $password) : string
    {

    }


    /**
     * @param string $username
     * @param string $password
     * @return string auth-token
     */
    public function loginByUsername(string $username, string $password) : string
    {

    }

    /**
     * @param string $email
     * @param string $password
     * @return string auth-token
     */
    public function loginByEmail(string $email, string $password) : string
    {

    }

    /**
     * @param $authToken
     * @return UserRecord
     * @throws UnauthorizedHttpException
     */
    private function getUserByAuthToken(string $authToken) : UserRecord
    {
        if(!$authToken) {
            throw new UnauthorizedHttpException("You're not authorized");
        }
        $user = UserRecord::find()->where(['token' => $authToken])->one();
        if(!$user) {
            throw new UnauthorizedHttpException("You're not authorized");
        }
        return $user;
    }
}