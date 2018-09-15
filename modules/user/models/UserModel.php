<?php
/**
 * Date: 15.09.18
 * Time: 12:05
 */

namespace app\modules\user\models;


use yii\base\Model;

class UserModel extends Model
{
    const SCENARIO_LOGIN = 'login';
    const SCENARIO_SIGNUP = 'signup';


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'email', 'password_hash'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }




    public function scenarios()
    {
        return [
            self::SCENARIO_LOGIN => ['username', 'password_hash'],
            self::SCENARIO_SIGNUP => ['username', 'email', 'password_hash'],
        ];
    }

}