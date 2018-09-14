<?php

use yii\db\Migration;

/**
 * Class m180914_192042_init_database
 */
class m180914_192042_init_database extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("users", [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string(),
            'created_at' => 'TIMESTAMP WITH TIME ZONE NOT NULL',
            'updated_at' => 'TIMESTAMP WITH TIME ZONE NOT NULL',
            'password_hash' => $this->string()->notNull()
        ]);
        $this->createTable("projects", [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'owner_user_id' => $this->integer()->notNull(),
            'created_at' => 'TIMESTAMP WITH TIME ZONE NOT NULL',
            'updated_at' => 'TIMESTAMP WITH TIME ZONE NOT NULL',
            'deleted_at' => 'TIMESTAMP WITH TIME ZONE'
        ]);

        $this->createTable("tasks", [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'status' => $this->integer(),
            'due_date' => $this->dateTime(),
            'priority' => $this->integer(),
            'project_id' => $this->integer()->notNull(),
            'created_at' => 'TIMESTAMP WITH TIME ZONE NOT NULL',
            'updated_at' => 'TIMESTAMP WITH TIME ZONE NOT NULL',
            'deleted_at' => 'TIMESTAMP WITH TIME ZONE'
        ]);

        $this->createIndex('idx-tasks-project_id','tasks','project_id');
        $this->addForeignKey('fk-tasks-project_id','tasks','project_id','projects','id','CASCADE', 'CASCADE');

        $this->createIndex('idx-projects-owner_user_id','projects','owner_user_id');
        $this->addForeignKey('fk-projects-owner_user_id','projects','owner_user_id','users','id','CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drop database.

        echo "m180914_192042_init_database cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180914_192042_init_database cannot be reverted.\n";

        return false;
    }
    */
}
