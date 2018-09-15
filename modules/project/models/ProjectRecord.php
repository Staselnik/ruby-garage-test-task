<?php
/**
 * Date: 15.09.18
 * Time: 9:18
 */

namespace app\modules\project\models;

use app\modules\task\models\TaskRecord;
use app\modules\task\models\UserRecord;
use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property string $title
 * @property int $owner_user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property UserRecord $ownerUser
 * @property TaskRecord[] $tasks
 */
class ProjectRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['owner_user_id', 'created_at', 'updated_at'], 'required'],
            [['owner_user_id'], 'default', 'value' => null],
            [['owner_user_id'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['owner_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserRecord::class, 'targetAttribute' => ['owner_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'owner_user_id' => 'Owner User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwnerUser()
    {
        return $this->hasOne(UserRecord::className(), ['id' => 'owner_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(TaskRecord::className(), ['project_id' => 'id']);
    }
}