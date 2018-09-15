<?php
/**
 * Date: 15.09.18
 * Time: 11:21
 */

namespace app\modules\user\services;


use app\modules\user\models\UserRecord;
use yii\base\Security;
use yii\web\ForbiddenHttpException;
use yii\web\UnauthorizedHttpException;

class AuthorizationService
{
    protected $securityService;

    public function __construct(Security $securityService)
    {
        $this->securityService = $securityService;
    }

    /**
     * @param $authToken
     * @return UserRecord
     * @throws ForbiddenHttpException
     * @throws UnauthorizedHttpException
     */
    public function auth(string $authToken) : UserRecord
    {
        $user = $this->getUserByAuthToken($authToken);
        return $user;
    }


    /**
     * @param string $username
     * @param string $email
     * @param string $password
     * @return UserRecord
     */
    public function signup(string $username, string $email, string $password) : UserRecord
    {
        $userRecord = new UserRecord();
        $userRecord->username = $username;
        $userRecord->email = $email;
        //todo use UserModel for checking password rules.
        $userRecord->password_hash = $this->hashPassword($password);
        $userRecord->auth_token = $this->securityService->generateRandomString();

        if(!$userRecord->save())
        {
            throw new \Exception(json_encode($userRecord->getErrors()));
        }

        return $userRecord;
    }


    /**
     * @param string $username
     * @param string $password
     * @return string
     * @throws \yii\base\Exception
     */
    public function loginByUsername(string $username, string $password) : string
    {
        $encryptedPassword = $this->hashPassword($password);
        $user = UserRecord::find()->where(['password_hash' => $encryptedPassword, 'username' => $username])->one();
        if(!$user instanceof UserRecord) {
            throw new UnauthorizedHttpException("Authorization failed");
        }
        return $user->auth_token;
    }

    /**
     * @param string $email
     * @param string $password
     * @return string
     * @throws \Exception
     */
    public function loginByEmail(string $email, string $password) : string
    {
        throw new \Exception('Not implemented yet');
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
        $user = UserRecord::find()->where(['auth_token' => $authToken])->one();
        if(!$user instanceof UserRecord) {
            throw new UnauthorizedHttpException("You're not authorized");
        }
        return $user;
    }

    private function hashPassword(string $password) : string
    {
        return $this->securityService->generatePasswordHash($password);

    }
}