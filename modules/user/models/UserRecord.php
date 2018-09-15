<?php
/**
 * Date: 15.09.18
 * Time: 9:16
 */

namespace app\modules\user\models;

use app\modules\project\models\ProjectRecord;
use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 * @property string $password_hash
 * @property string $auth_token
 *
 * @property ProjectRecord[] $projects
 */
class UserRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'email', 'password_hash'], 'string', 'max' => 255],
            ['auth_token', 'string', 'max' => 60],
            [['username'], 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'password_hash' => 'Password Hash',
            'auth_token' => 'Auth Token'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(ProjectRecord::className(), ['owner_user_id' => 'id']);
    }
}