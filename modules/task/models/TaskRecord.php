<?php
/**
 * Date: 15.09.18
 * Time: 9:16
 */

namespace app\modules\task\models;

use app\modules\project\models\ProjectRecord;
use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property int $status
 * @property string $due_date
 * @property int $priority
 * @property int $project_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property ProjectRecord $project
 */
class TaskRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'priority', 'project_id'], 'default', 'value' => null],
            [['status', 'priority', 'project_id'], 'integer'],
            [['due_date', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['project_id', 'created_at', 'updated_at'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectRecord::class, 'targetAttribute' => ['project_id' => 'id']],
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
            'status' => 'Status',
            'due_date' => 'Due Date',
            'priority' => 'Priority',
            'project_id' => 'Project ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(ProjectRecord::class, ['id' => 'project_id']);
    }
}